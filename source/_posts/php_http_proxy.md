title: "使用PHP+CURL搭建一个简易的HTTP代理服务端[2012-12-17]"
id: 884
date: 2012-11-27 12:03:49
tags:
- PHP
- 原创
- 代理 
categories: 
- 程序设计/PHP
---

使用PHP做的一个简易HTTP代理服务端,没有多少技术含量.有时可以利用一下.嘿嘿.比如在公司内部可以用它来偷偷上网,当然了要求了内部网站,并且支持PHP而且该服务器可以上网,你还要有办法访问到这个电脑.

最初我是利用它来抓取数据包用的,通过代理可以在代理服务器上抓取到所有发送和接收的数据包,所以使用别人的代理时需要注意,因为别人可以截获/修改你发送的数据包,

要求: 有独立IP,支持PHP+CURL.

使用方法,把代码直接上传到PHP服务器上,并设置好URL重写规则.就可以开始使用了,
一个简单的URL重写规则(比较适用于服务端和客户端是网一网络的情况比如内网，只是简单的判断一下如果是通过代理访问就设为代理服务器)
```
RewriteCond %{HTTP_PROXY_CONNECTION} !^$
RewriteRule !^proxy.php proxy.php [NE,NC,L]
```
比如你的服务器IP是 192.168.0.88

在浏览器客户端设置HTTP代理192.168.0.88 端口 80就可以开始上网了.

注：最新版本源码请从以下地址查看、下载。
[https://github.com/chenall/chenall/tree/master/php/php_proxy](https://github.com/chenall/chenall/tree/master/php/php_proxy)

```php
<?php
/*
	使用PHP服务端来做简易的HTTP代理
	不支持需要证书的网站或使用"multipart/form-data"加密的POST类型(一般上传文件或发贴使用这个加密).
	用途: ......
	编写: chenall
	时间: 2012-11-27
	版本: 1.1
	网址: http://chenall.net/post/php_http_proxy/
	修订:
		 
		 2012-11-28 v1.1
		   1.添加write_function,分段输出(可以在线视频).
		   2.预置调试,可以开启记录模式,记录所有访问和返回的内容.
*/
$chunked = 0;
$gziped = 0;
function header_function($ch, $header){
	global $debug;
	if (stripos($header,'chunked') !== false)//如果碰到分断好像会出错,所以过滤一下.若你有好的方案烦告之.
		$GLOBALS['chunked'] = 1;
	if (stripos($header,'Content-Encoding: gzip') === 0)
		$GLOBALS['gziped'] = 1;
	header($header);
	empty($debug) || fwrite($debug,$header);
	return strlen($header);
}

function write_function($ch, $body){
	global $debug;
    if ($GLOBALS['chunked']){
        printf("%x\r\n%s\r\n", strlen($body), $body);
    }else{
        echo $body;
    }
	if ($debug)
	{
		//if ($GLOBALS['gziped'])
		//	fwrite($debug,gzinflate(substr($body,10,-4)));
		//else
			fwrite($debug,$body);
	}
	return strlen($body);
}

function proxy()
{
	global $debug;
	$hearer = array();
	//获取HTTP相关的HEADER信息
	if (function_exists('getallheaders'))
	{
		$allheader = getallheaders();
		foreach($allheader as $h=>$key)
		{
			$header[] = $h.': '.$key;
		}
	}
	else
	{
		foreach($_SERVER as $key=>$value)
		{
			if (strcasecmp(substr($key,0,4),'HTTP') == 0)
			{
				$header[] = substr($key,5).': '.$value;
			}
		}
		if (isset($_SERVER['PHP_AUTH_DIGEST'])) { 
			$header[] = 'AUTHORIZATION: '.$_SERVER['PHP_AUTH_DIGEST']; 
		} else if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
			$header[] = 'AUTHORIZATION: '.base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']); 
		}
		if (isset($_SERVER['CONTENT_LENGTH'])) { 
			$header[] = 'CONTENT-LENGTH: '.$_SERVER['CONTENT_LENGTH']; 
		}
		if (isset($_SERVER['CONTENT_TYPE'])) { 
			$header[] = 'CONTENT_TYPE: '.$_SERVER['CONTENT_TYPE']; 
		}
	}
	$url = $_SERVER['REQUEST_URI'];
	$curl_opts = array(
		CURLOPT_URL => $url,
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_TIMEOUT => 10,
		CURLOPT_AUTOREFERER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_BINARYTRANSFER => true,
		CURLOPT_HEADERFUNCTION => 'header_function',
		CURLOPT_WRITEFUNCTION => 'write_function',
		CURLOPT_CUSTOMREQUEST =>$_SERVER['REQUEST_METHOD'],
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_HTTPHEADER => $header,
		CURLOPT_SSL_VERIFYHOST => false
	);

	if ($_SERVER['REQUEST_METHOD']=='POST')//如果是POST就读取POST信息,不支持
	{
		$curl_opts[CURLOPT_POST] = true; 
		$curl_opts[CURLOPT_POSTFIELDS] = file_get_contents('php://input'); 
	}
	$curl = curl_init();
	curl_setopt_array ($curl, $curl_opts);
	empty($debug) || fwrite($debug,"\r\n".date('Y-m-d H:i:s',time())." URL: ".$curl_opts[CURLOPT_URL]."\r\n".$curl_opts[CURLOPT_POSTFIELDS]."\r\n".implode("\r\n",$header)."\r\n\r\n");
	$ret = curl_exec ($curl);
	if ($GLOBALS['chunked']){
		echo "0\r\n\r\n";
	}
	curl_close($curl);
	unset($curl);
}
$debug = 1;//设为1开启记录.
if ($debug)
{
	if (!file_exists('debug/'))
		mkdir('debug');
	$debug = fopen("debug/".$_SERVER['REMOTE_ADDR'].date('_ymdHis_',time()).'__'.$_SERVER['SERVER_NAME'].".log",'a');
	fwrite($debug,print_r($_SERVER,true));
	fwrite($debug,"===========php://input===========\r\n".@file_get_contents('php://input')."\r\n======================\r\n");
}
proxy();
empty($debug) || fclose($debug);
```