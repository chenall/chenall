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
		if ($GLOBALS['gziped'])
			fwrite($debug,gzinflate(substr($body,10,-4)));
		else
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
	if ($_SERVER['SERVER_PORT'] == 443)
	    $url = "https://".$_SERVER['SERVER_NAME'];
	else
	    $url = $_SERVER['REQUEST_URI'];
	$header[] = 'X_FORWARDED_FOR: 127.0.0.1';
	$header[] = 'CLIENT_IP: 127.0.0.1';
	$header[] = 'connection: close';

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
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_HTTPHEADER => $header,
//		CURLOPT_PROXY => '127.0.0.1:8086',
		CURLOPT_SSL_VERIFYHOST => false
	);

	switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
	    case 'HEAD':
		$curl_opts[CURLOPT_NOBODY] = true;
		break;
	    case 'GET':
		break;
	    case 'POST':
		$curl_opts[CURLOPT_POST] = true;
		$curl_opts[CURLOPT_POSTFIELDS] = file_get_contents('php://input');
		break;
	    case 'PUT':
		break;
	    case 'DELETE':
		$curl_opts[CURLOPT_CUSTOMREQUEST] = $method;
		$curl_opts[CURLOPT_POSTFIELDS] = file_get_contents('php://input');
		break;
	    case 'CONNECT':
		exit;
	    default:
		echo 'Invalid Method: '. $method;
		exit(-1);
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
	$debug = fopen("debug/".$_SERVER['SERVER_NAME'].'__'.date('_ymdHis_',time()).'__'.$_SERVER['REMOTE_ADDR'].".log",'a');
	fwrite($debug,print_r($_SERVER,true));
	fwrite($debug,"===========php://input===========\r\n".@file_get_contents('php://input')."\r\n======================\r\n");
}
proxy();
empty($debug) || fclose($debug);
