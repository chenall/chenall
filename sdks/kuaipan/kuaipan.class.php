<?php
/*
  金山快盘开放平台 PHP SDK
  编写：chenall
  主页: http://chenall.net
  时间: 2012-12-12
  2012-12-13 
   FetchURL修改。
   为了方便使用，$data参数可以是POST数据，也可以是CURLOPT参数。
   如果$data['file']存在认为是POST数据，否则作为CURLOPT参数。
  使用方法：
   $kp = new KuaiPan(consumer_key,consumer_secret)
   $kp->api(参数）
   例子
   $kp->account_info();//获取用户信息
   $kp->create_folder('root=app_folder&path=PATH');
   或数组的方式
   $kp->create_folder(array('root'=>app_folder,'path'=>PATH));
   参数自己看官方的文档
   部份需要加路径的API像获取文件夹信息
   http://openapi.kuaipan.cn/1/metadata/<root>/<path>
   直接把<path>放在第二个参数就行了。
   例子:
   $kp->metadata($params,'/myfolder')
   默认的root是app_folder,如果不是请自己修改
   $kp->root = 'kuanpan';
   其它的见README
*/

class KuaiPan
{
	private $errstr = '';
	private $consumer_key;
	private $consumer_secret;
	private $oauth_token = '';
	private $oauth_token_secret = '';
	private $root = 'app_folder';//默认的根目录。只能是app_folder或kuanpan
	private $path = '/';
	private $upload_url;
	protected $api_uri = array(//可以调用的API列表
				'account_info'  =>'http://openapi.kuaipan.cn/1/account_info',
				'metadata'      =>'http://openapi.kuaipan.cn/1/metadata',
				'history'       =>'http://openapi.kuaipan.cn/1/history',
				'shares'        =>'http://openapi.kuaipan.cn/1/shares',
				'create_folder' =>'http://openapi.kuaipan.cn/1/fileops/create_folder',
				'delete'        =>'http://openapi.kuaipan.cn/1/fileops/delete',
				'move'          =>'http://openapi.kuaipan.cn/1/fileops/move',
				'copy'          =>'http://openapi.kuaipan.cn/1/fileops/copy',
				'copy_ref'      =>'http://openapi.kuaipan.cn/1/copy_ref',
				'upload_locate' =>'http://api-content.dfs.kuaipan.cn/1/fileops/upload_locate',
				'download_file' =>'http://api-content.dfs.kuaipan.cn/1/fileops/download_file',
				'upload_file'        =>'',
				'upload_file_by_id'  =>'',
				'download_file_by_id'=>'http://api-content.dfs.kuaipan.cn/1/fileops/download_file_by_id',
				'thumbnail'     =>'http://conv.kuaipan.cn/1/fileops/thumbnail',
				'documentView'  =>'http://conv.kuaipan.cn/1/fileops/documentView',
				'requestToken'  =>'https://openapi.kuaipan.cn/open/requestToken',
				'accessToken'   =>'https://openapi.kuaipan.cn/open/accessToken',
				);
	protected $curl_opts = array(
				CURLOPT_CONNECTTIMEOUT => 5,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => false
				);
	private $api_with_path = array('metadata','shares','history','copy_ref');//这些API调用后面需要带路径信息
	private $api_not_fetch = array('thumbnail','download_file');//这些API调用不需要取数据，直接返回一个地址。

	function __construct($consumer_key = '', $consumer_secret = '') {
		$this->consumer_key = $consumer_key;
		$this->consumer_secret = $consumer_secret;
	}

	function __set($key,$value)
	{
		$this->$key = $value;
	}

	function __get($key)
	{
		return isset($this->$key)?$this->$key:null;
	}

	function __call($api,$args)//API调用处理中心
	{
		if (!isset($this->api_uri[$api]))
			return false;
		$uri = $this->api_uri[$api];
		$post = null;
		if (stripos($api,'upload_file') !== false)
		{
			if (empty($uri))//上传文件API，需要先获取上传的URL.
			{
				$uri = self::upload_locate();
				if (empty($uri->url))
					return false;
				$uri =$uri->url.'/1/fileops/';
				$this->api_uri['upload_file'] = $uri.'upload_file';
				$this->api_uri['upload_file_by_id'] = $uri.'upload_file_by_id';
				$uri .= $api;
			}
			if (empty($args[1]))//上传文件API，必须附加上传的数据
			{
				$this->errstr = 'bad parameters';
				return false;
			}
			$post = $args[1];
		}
		elseif (in_array($api,$this->api_with_path))//API需要带路径的需要处理一下路径信息
		{
			$uri .= '/'.$this->root;
			if (empty($args[1]))
				$uri .= $this->path;
			elseif (substr($args[1],0,1) == '/')
				$uri .= $args[1];
			else
				$uri .=$this->path.$args[1];
		}

		/*
			参数处理，使用字符串或者数组，最终全部转换成带KEY的数组
		*/
		if (empty($args[0]))
			$params = array();
		elseif (is_array($args[0]))
			$params = $args[0];
		else
			parse_str($args[0],$params);

		$http_method = empty($post)?"GET":"POST";
		$uri = self::get_api_uri($uri,$http_method,$params);
		if (in_array($api,$this->api_not_fetch))//不需要取数据的直接返回URL地址。
			return $uri;
		return self::FetchURL($uri,$post);
	}

	/*
		获取经过签名的API调用URL
	*/
	function get_api_uri($uri, $http_method = "GET", $params = array())
	{
		$params["oauth_consumer_key"] = $this->consumer_key;
		$params["oauth_nonce"]=uniqid('');
		$params["oauth_signature_method"]="HMAC-SHA1";
		$params["oauth_timestamp"]= time();
		empty($this->oauth_token) || $params["oauth_token"]= $this->oauth_token;
		$params["oauth_version"]="1.0";
		/*
		下面是oauth_signature 值的计算方法
		参考: http://www.kuaipan.cn/developers/document_signature.htm
		*/
		$base_string = $http_method."&".rawurlencode($uri)."&";
		ksort($params);
		$data = array();
		foreach ($params as $k=>$v)
		{
			$data[] = $k."=".rawurlencode($v);
		}
		$base_string .= rawurlencode(implode('&', $data));
		$key = $this->consumer_secret."&".$this->oauth_token_secret;
		$sign = rawurlencode(base64_encode(hash_hmac("sha1",$base_string , $key, true)));
		return $uri."?".http_build_query($params)."&oauth_signature=".$sign;
	}

	/*
		简单的取数据函数，正常的话返回一个object
		$data必须是一个数组
		如果存在$data['file']则把它作为POST数据。否则认为是CURLOPT参数，方便使用自定义的CURLOPT参数。
	*/
	function FetchURL($url,$data = null)
	{
		$curl = curl_init($url);
		curl_setopt_array($curl,$this->curl_opts);
		if (is_array($data))
		{
			curl_setopt($curl,CURLOPT_POST,true);
			if (isset($data['file']))
				curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
			else
				curl_setopt_array($curl,$data);
		}
		$res = curl_exec($curl);
		$http_code = curl_getinfo($curl,CURLINFO_HTTP_CODE);
		curl_close($curl);
		$ret = json_decode($res);
		if ($http_code != 200)
			$this->errstr = isset($ret->msg)?$ret->msg:$res;
		else
			$this->errstr = '';
		return $ret;
	}
}
