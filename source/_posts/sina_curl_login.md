title: "[分享] 使用 PHP CURL 模拟登录新浪微博"
id: 854
date: 2012-08-13 15:20:14
tags: 
- curl
- 新浪
- 登录
- PHP
categories: 
- 程序设计/PHP
---

有时候我们获取一些新浪微博的数据,但又不想使用API,只好使用模拟登录了.

发现以前可以使用的CURL模拟登录代码失效了,Google一下,发现有很多人碰到这个问题.但是没有找到解决方法,所以就自己研究了一下,发现了原因.

可能是因为新浪限制了不允许模拟登录,同样的登录参数,用网页登录一切正常,用CURL登录,返回的<span style="color:#800000;">COOKIES</span>竟然是<span style="color:#ff0000;">临时</span>的.

所以看起来是登录成功了,并且获取到了用户信息,但是再次访问还是未登录状态.我的解决方法比较简单,直接修改COOKIES的时效这样就行了.

附上我自己测试通过的PHP代码如下,希望有对有同样问题的朋友有用,如果你有更好的方案欢迎分享一下.

2012-08-18 更新: 发现只要不设置CURLOPT_COOKIESESSION参数就行了,不需要修改COOKIE_FILE.

```
<?php
class sina
{
/*
	一个简单的新浪微搏curl模拟登录类. 来源: http://chenall.net/post/sina_curl_login/
	使用方法:

	http函数是一个简单的curl封装函数,需要自己去实现,
	http函数原型如下:
		http($url,$post_data = null)
		返回网页内容.
	第一个参数$url,就是要访问的url地址,$post_data是post数据,如果为空,则代表GET访问.

	1.使用加密后密码登录 加密方法: sha1(sha1($pass))
		$sina = new sina($username,$sha1pass)
	2.直接使用原始密码登录
		$sina = new sina($username,$sha1pass,0)
	执行之后如果$sina->status非空,则登录成功,否则登录失败.
	登录成功之后,你就可以直接继续使用http函数来访问其它内容.
	使用 unset($sina) 会自动注销登录.
*/
	public $status;
	function __construct($su,$sp,$flags = 1) {
		$this->status = $this->login($su,$sp,$flags);
	}

	function __destruct()
	{
		//注销登录
		$this->logout();
	}

	function logout()
	{
		http("http://weibo.com/logout.php");
		unset($this->status);
	}
	/*不需要了,只要不设置HTTP函数中不设置CURLOPT_COOKIESESSION参数就行了,要设可以设为false.
	function ResetCookie()//重置相关cookie
	{
		global $cookie_file;
		$str = file_get_contents($cookie_file);
		$t = time()+3600;//设置cookie有效时间一个小时
		$str = preg_replace("/\t0\t/", "\t".$t."\t", $str);
		$f = fopen($cookie_file,"w");
		fwrite($f,$str);
		fclose($f);
	}
	*/

	function login($su,$sp,$flags = 0)
	{
		$su = urlencode(base64_encode($su));
		$data = http("http://login.sina.com.cn/sso/prelogin.php?entry=miniblog&client=ssologin.js&user=".$su);
		if (empty($data))
			return null;
		//$data = substr($data,35,-1);
		$data = json_decode($data);
		if ($data->retcode != 0)
			return null;
		if ($flags == 0)
			$sp = sha1(sha1($sp));
		$sp .= strval($data->servertime).$data->nonce;
		$sp = sha1($sp);
		$data = "url=http%3A%2F%2Fweibo.com%2Fajaxlogin.php%3F&returntype=META&ssosimplelogin=1&su=".$su.'&service=miniblog&servertime='.$data->servertime."&nonce=".$data->nonce.'&pwencode=wsse&sp='.$sp;
		$data = http("http://login.sina.com.cn/sso/login.php?client=ssologin.js",$data);
		//$this->ResetCookie();
		if (preg_match("/location\.replace\('(.*)'\)/",$data,$url))
		{
			$data = http($url[1]);
			//$this->ResetCookie();
			$data = json_decode(substr($data,1,-2));
			if ($data->result == true)
				return $data->userinfo;
		}
		return null;
	}
}
?>
```