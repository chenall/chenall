title: "金山快盘直链"
id: 848
date: 2012-07-25 14:42:04
tags: 
- 直链
- 金山快盘
categories: 
- 程序设计/PHP
- 程序设计/综合
---

使用快盘API写了一个直链的应用测试.. 以后可以把文件或图片直接上传到快盘中,然后直链. API有调用限制,好像是一天5000次,对于我等小站来说足够用了,

另外好像快盘的文件下载速度没有华为网盘的给力啊.速度相对比较慢,可以对比一下我的另一个文章关于华为网盘直链的测试,显示图片的速度更快.

2012-12-28:  因为快盘官方可能不太喜欢此类应用或其它原因,经常隔一段时间需要重审,所以这个目前只能自己使用.

2012-08-16:  发现昨天快盘服务器维护过后,稳定多了,速度也比较给力.

2012-08-29 更新  
现在的授权可以直接用于子域名.  
例: 授权域名 chenall.net  
则a.chenall.net或www.a.chenall.net等都可以直接使用.  
当然了也可以直接单独对a.chenall.net授权.  

有兴趣的话可以申请使用,申请比较简单,只要通过认证就可以了.根据域名进行认证的.方法

打开以下网址,把chenall.net换成你的域名,然后会跳出一个快盘的授权,确认了之后就可以使用了.

http://chenall.net/kuaipan/?ru=`chenall.net`

把你要直链的文件传到快盘的<我的应用\\直链>目录下,然后在你的网站上就可以直接使用了

http://chenall.net/kuaipan/?path=`FILEPATH`

比如:以下会直接下载你的帐号直链应用目录下的test.txt 文件.

http://chenall.net/kuaipan/?path=`test.txt`

注,网站域名要和你授权的域名一致,否则无法使用,如果需要访问中文的文件,需要用UTF-8编码.

因为这个应用未通过申核,目前只能自用.

今天去看了一下,发现已经通过了,只要你有快盘帐号,现在就可以开始使用了.

快盘直链效果测试

*   图片直链
   ![](http://d.chenall.net/kuaipan/3lightning3.jpg)

   子目录图片显示测试

   ![](http://d.chenall.net/kuaipan/imgs/Img222951204.jpg)
   
*   音乐直链播放
   <audio width="300" height="32" autoplay="autoplay" controls="controls" loop="loop"><source src="http://d.chenall.net/kuaipan/爱情总在幻灭时最美.mp3" type="audio/mpeg" /> 你的浏览器不给力呀，要支持html5的才行喔。建议试试chrome。 </audio>

*   文件直链下载

   [网盘自动签到2012-07-25](http://d.chenall.net/kuaipan/网盘自动签到2012-07-25.rar)
