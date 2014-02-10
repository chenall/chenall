title: "网盘外链的简单破解"
id: 846
date: 2012-07-21 15:44:03
tags: 
- 直链
- 破解
categories: 
- 程序设计/综合
- 程序设计/PHP
---

目前国内有许多网盘,大都是禁止外链的,即使支持也需要钱的.

一般网盘的下载链接只能从网盘所属域上链接下载,或直接输入地址下载.如果你把这个链接放到你的网站上是不可以用的.

像这种一般情况下<span style="line-height: 16px;">是根据来源地址(Referer)判断的,如果来源地址是合法的域则可以下载,否则提示错误.</span>

这种只要伪造一个来源地址就可以突破了.伪造的方法有很多,从Google上找了一下有很多种.

这里介绍一种相对比较简单的,一般的PHP服务器都有支持.相关代码如下.伪造一个referer地址发送过去,请求下载,获取返回的头信息,里面包含了真正的地址.

```
$curl = curl_init();//curl模块初始化
curl_setopt ($curl, CURLOPT_URL, $url);//$url 目标地址
curl_setopt ($curl, CURLOPT_REFERER, $referer_url);//$referer_url 要伪造的地址
curl_setopt($curl,CURLOPT_HEADER,1);//只获取http头信息,如果不使用这个设置,则相当在服务器上下载该文件了.这样会占用服务器的资源.
curl_setopt($curl,CURLOPT_NOBODY,1);//不返回html的body信息  
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);//返回数据流，不直接输出  
curl_setopt($curl,CURLOPT_TIMEOUT,30); //超时时长，单位秒
$r = curl_exec ($curl);
curl_close ($curl);
if (preg_match('/Location: (.*)/',$r, $matches))//获取Location地址即最终的地址,发送给客户端,由客户端去下载.
{
	header("Location: ".$matches[1]);
}
```

注: 需要注意的是尽量不要通过服务器下载再中转,这样很浪费服务器资源.目前网上有很多方法都是直接通过服务器下载再发送给客户端的.这个方法只有通过服务器获取一下头信息,然后直接返回给客户端浏览器了.

附: 利用以上方法实现的直链效果,以下全部是使用网盘的直链,因为我做了封装,看起来就像是本站上的文件.

*   图片直链(如果图片不显示可能是失效了)  
    经典视觉欺骗,以下图片有几个黑点?  
    ![](http://d.chenall.net/0/c05l7vhroi/几个黑点.jpg)  
    ![](http://d.chenall.net/0/c05l7vhroi/左右脑冲突.jpg)  

*   MP3音乐在线播放(使用的是HTML5的代码,需要浏览器支持)  
    <audio autoplay="autoplay" controls="controls" loop="loop"><source src="http://d.chenall.net/0/c05l7vhroi/05我的快乐.mp3" type="audio/mpeg"/><source src="http://d.chenall.net/0/c05l7vhroi/爱情总在幻灭时最美.mp3" type="audio/mpeg"/> 你的浏览器不给力呀，要支持html5的才行喔。建议试试chrome。 </audio>

*   文件直链下载

   [Chrome Dev 22.0.1201.0](http://d.chenall.net/0/c08k4wpqad/1/)
