title: "[分享]FiraDisk Grub4dos虚拟磁盘的WIN驱动"
id: 88
date: 2009-09-02 21:16:28
tags: 
- FiraDisk
- GRUB4DOS
- SCSI
- 驱动
categories: 
- 软件推荐/驱动
---


Windows 下 Grub4dos仿真盘的驱动.

可以支持grub4dos map--mem出来的光驱，软驱，硬盘，支持多个虚拟驱动器。

另外，也支持直接在boot.ini加载各种镜像，无488M限制。

感谢_zw2312914_的推荐: [http://bbs.znpc.net/viewthread.php?tid=5742](http://bbs.znpc.net/viewthread.php?tid=5742),感谢软件作者karyonix的分享.

以下内容摘自上面时空论坛的一些原文.

{% blockquote zw2312914 http://bbs.znpc.net/viewthread.php?tid=5742 时空论坛 %} 
 谢谢 karyonix 。此驱动类似 windrv 大的wdsys。即可以在windows环境使用grub4dos（--mem方式）仿真的镜像（包括iso)。
 
 详见：<http://www.boot-land.net/forums/index.php?showtopic=8804>
 
 参考：<http://www.boot-land.net/forums/index.php?showtopic=8168>
 
 希望有更多的朋友能测试下。
 
 原帖由 _fujianabc_ 于 2009-9-2 16:19 发表 <http://bbs.znpc.net/redirect.php?goto=findpost&amp;pid=41794&amp;ptid=5742>
 
 看了一下，名叫firadisk。
 
 貌似已经超级强大了，可以支持grub4dos map--mem出来的光驱，软驱，硬盘，支持多个虚拟驱动器。
 
 另外，也支持直接在boot.ini加载各种镜像，无488M限制。
 
 支持x86/x64系统，但对于64位系统，尚无法使用4GB以上的内存，grub4dos似乎也不行。内存盘上限大概是3.25GB
{% endblockquote %} 

我已经测试过了,很强大,0pe或Micrope直接用这个驱动替换里面的wdsys.sys驱动,可以正常使用.

其它PE只需要在内核中加入这个驱动,就可以直接整体ISO来启动,再也不用担心ISO启动找不到外置的问题了.

在PE中添加该驱动只需在TXTSETUP.SIF中添加以下语句,然后把firadisk.sys文件放到system32\drivers目录下就可以了
```
[scsi.load]
Firadisk=Firadisk.sys,4
```
整体ISO启动方法例子.
```
 title pe from iso
 map --mem /xxxxpe.iso (0xff)
 map --hook
 chainloader (0xff)
```
还有一些想法,我还没有条件测试,

1. 把这个驱动加入到WINDOWS的安装盘中,这样是不是就可以直接以
```
map --mem /winxp.iso (0xff)
map --hook
chainloader (0xff)
```
的方式来安装XP或其它系统了

2. 制作Ram系统,应该是支持的了.只需要在WINDOWS系统中加入这个驱动,然后把系统打包成一个镜像,用GRUB4DOS的map --mem来加载启动.

也可以到这个贴子看看由无忧论坛 [天风](http://bbs.wuyou.com/space.php?uid=40023) 制作的 [RAM WINDOWS 7](http://bbs.wuyou.com/viewthread.php?tid=148670)

后注:这个驱动还是持续更新中,希望越来越强大,~~不知是否以后会支持非mem的磁盘,如果可以的话就更强大了~~(新版已支持).....让我们一起期待吧.

上面的已经测试过,可以直接用于ISO启动安装WIN XP/2003系统,或PE.

具体情况: [http://bbs.wuyou.com/viewthread.php?tid=148686&amp;extra=page%3D1](http://bbs.wuyou.com/viewthread.php?tid=148686&amp;extra=page%3D1)