title: "[记录] VPS 初步接触"
id: 901
date: 2013-03-17 14:28:36
tags: 
- amh
- pzea
- vps
- xen
categories: 
- 个人日记
---

最近从PzEA入手一个xen VPS，从网上搜到的优惠链接（[PzEa给力特价VPS 256M Xen VPS 2.5美元 洛杉矶和圣何塞机房](http://www.uuvps.com/vps/4919.html)）购买的，以下是购买时可以看到的配置信息。实际上硬盘是10G的。够用了

*   CPU：单核
*   内存：256M
*   硬盘：10G
*   流量：250G
*   IPs：1IPv4
*   架构：xen
*   可选系统：linux

用人民币购买1年是162.5元，用美元是$25,按照目前的汇率(太概是155人民币)用美元购买会便宜一些,如果有双币种信用卡可以用美元,否则还是老老实实用支付宝,这个价格比一般的虚拟主机还划算,付完款之后就立即开通了,

开通之后只安装了一个系统,其它的都需要自己配置.

为了方便先装一个管理面板,从网上搜了一下感觉[AMH](http://amysql.com/AMH.htm)挺不错的就它了.很方便,装上之后基本就可以使用了.

用SSH连接VPS的IP地址,然后按照[官方的安装方法](http://amysql.com/AMH/doc.htm)
```
wget http://amysql.com/file/AMH/3.1/amh.sh; chmod 775 amh.sh; ./amh.sh 2>&1 | tee amh.log;
```
然后就是漫长的等待了.太概20分钟左右的样子.完成之后再用

**http://ip:8888** 进入管理面板

里面可以管理虚拟主机,FTP/MYSQL等.挺方便的.

然后想怎么折腾就怎么折腾吧,别忘了VPS安全,使用iptables设置一下规则.(都可以从Google上找到)

这个比较适合有一定LINUX基础的人练手,有独立IP可以做很多事情....

申请了一个免费的tk域名先装一个typecho来测试一下.

[http://xvps.tk/](http://xvps.tk/)

嘿嘿,有了这个就相当于有了一台属于自己的永不断电的电脑了.以后又有得折腾了.^_^