<?php
/*
  金山快盘开放平台 PHP SDK 简化版，必须和kuaipan.class.php同目录
  编写：chenall
  主页: http://chenall.net
  时间: 2012-12-12
  使用方法例子：
   require_once('libs/kp.class.php');
   $kp = new kp(CONSUMER_KEY,CONSUMER_SECRET)
   $oauth = $kp->OAuth();
*/
require_once(dirname(__FILE__).'/kuaipan.class.php');
session_start();
class kp extends kuaipan
{

	function __construct($consumer_key = '', $consumer_secret = '') {
		$this->consumer_key = $consumer_key;
		$this->consumer_secret = $consumer_secret;
	}

	/*
		OAuth 验证：
		 可以自己指定回调地址，你需要处理好回调过程。一般情况下直接使用默认的即可
	*/
	function OAuth($call_back = null)
	{
		if (isset($_GET['ac']) && $_GET['ac']=='oauth_authorize')//OAuth 第三步
		{
			$this->oauth_token = $_SESSION['oauth_token'];
			$this->oauth_token_secret = $_SESSION['oauth_token_secret'];
			$_SESSION['oauth_authorise'] = null;
			$data = parent::accessToken();
			if (!empty($this->errstr))
				return false;
			$_SESSION['oauth_token_secret'] = $this->oauth_token = $data->oauth_token;
			$_SESSION['oauth_token_secret'] = $this->oauth_token_secret = $data->oauth_token_secret;
			return $data;
		}
		empty($call_back) && $call_back = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].(empty($_SERVER['QUERY_STRING'])?'?':'&').'ac=oauth_authorize';
		$data = parent::requestToken(array('oauth_callback'=>$call_back));//OAuth 第一步
		if (!empty($this->errstr))
			return false;
		$_SESSION['oauth_token'] = $data->oauth_token;
		$_SESSION['oauth_token_secret'] = $data->oauth_token_secret;
		$_SESSION['oauth_authorise'] = 1;
		header('Location: https://www.kuaipan.cn/api.php?ac=open&op=authorise&oauth_token='.$data->oauth_token);//OAuth 第二步
	}

	function ls($path = '',$params = array())
	{
		return parent::metadata($params,$path);
	}

	function cp($from_path,$to_path)
	{
		$params = array(
			'root' => $this->root,
			'from_path' =>self::realpath($from_path),
			'to_path'=>self::realpath($to_path)
			);
		return parent::copy($params);
	}

	function mv($from_path,$to_path)
	{
		$params = array(
			'root' => $this->root,
			'from_path' =>self::realpath($from_path),
			'to_path'=> self::realpath($to_path)
			);
		return parent::move($params);
	}

	function md($path)
	{
		$path = self::realpath($path);
		$params = array(
			'root'=>$this->root,
			'path'=>$path);
		return parent::create_folder($params);
	}

	function rm($path,$to_recycle = "true")
	{
		$params = array(
			'to_recycle'=>$to_recycle,
			'root'=>$this->root,
			'path'=>self::realpath($path));
		return parent::delete($params);
	}

	function download($path)
	{
		$params = array(
			'root'=>$this->root,
			'path'=>self::realpath($path));
		return parent::download_file($params);
	}

	function upload($path,$data)
	{
		$params = array(
			'overwrite'=>"true",
			'root'=>$this->root,
			'path'=>self::realpath($path));
		return parent::upload_file($params,$data);
	}

	function realpath($path)//根据path变量返回实际路径。
	{
		return (substr($path,0,1) == '/')?$path:$this->path.$path;
	}
}