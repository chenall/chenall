title: "MODBOOT DOS程序最后的辉煌[2011-05-03更新]"
id: 637
date: 2011-05-04 01:04:59
tags: 
- GRUB4DOS
- DOS
categories: 
- 软件推荐/DOS
- GRUB4DOS
---

MODBOOT是何物？

MODBOOT是一个模块化的DOS启动控制中心。

基于以下网站的MODBOOT改进而成的，配合GRUB4DOS启动，实现真正的模块化

[http://nu2.nu/bootdisk/modboot/](http://nu2.nu/bootdisk/modboot/)

优点：快速，方便，小巧、可扩展。

1.  快速：以最快速的方式启动。
2.  方便：添加修改模块非常的方便，更新也很很便，省去了回来打包成IMG镜像的麻烦，只需要用ZIP打包就成了。
3.  小巧：也不能说多小巧，只是相对于目前动不动就1XMB的DOS启动盘来说是很小的。
4.  扩展：扩展性非常强，可以随意进行扩展。
5.  只有你想不到的，没有做不到的。

后面有演示用的ISO文件下载，你可以测试一下启动效果。特别是U盘上使用。因为启动时只加载需要的文件，所以可以使用最快速的方式来启动。

我们不再需要制作启动盘，需要什么DOS程序直接打包成ZIP文档作为MODBOOT的一个模块就可以了。

启动时会自动列出来。

另外也可以直接使用上面网站提供的模块（需要转换成ZIP格式）

如果不想转换，那需要设置同时复制BIN\\EXTRACT.EXE文件。

必须配合新版的GRUB4DOS使用，否则会提示GRUB4DOS版本错误。启动方法很简单在你原来的GRUB4DOS菜单上添加一个菜单项就可以了

```
title ModBoot
command /BOOT/MODBOOT/MODBOOT.BAT

或

title ModBoot
/BOOT/MODBOOT/MODBOOT.BAT
boot
```

注：/BOOT/MODBOOT/是你放置MODBOOT的目录，MODBOOT支持放到任意目录下使用。  
fb文件系统可能会无法正常使用。若是pxe启动则你需要每个目录都有一个dir.txt文件（用于显示文件列表）  

让我们先来看看效果图吧。

首先是主界面（注：所有内容都是自动生成的）

![]([CDN_URL]:/post/modboot/main.png)

自定义启动界面。

![]([CDN_URL]:/post/modboot/custom.png)

DOS启动菜单

![]([CDN_URL]:/post/modboot/dos.png)

注：使用LEVEL3里面的模块直接启动时，默认不显示这个菜单，可以在启动时快速按F8显示。


本工具的最新版本不再单独上传,请关注我的[GRUB4DOS硬盘工具箱](/post/g4d\_hd\_tools/ "[分享] 基于GRUB4DOS的硬盘工具箱[2011-08-02更新]"). 将会随工具箱一起更新. 


演示版下载：(2011-05-03 更新）  
文件名称: modboot.iso  
文件大小: 13.42 MB (14,075,904 字节)  
修改时间: 2011年05月25日，19:52:41  
MD5: 73D2905E2E00F8EC4F0336AAAF58F6FB  
SHA1: F54FC61E074B0960FB85A5705EF8163398EB03B8  

下载：[modboot.iso](http://yunfile.com/file/chenall/e95e35f4/)

演示用的ISO里面有带一个[QGHO](/post/qgho/)（快速备份还原工具），这是一个比较复杂的模块。 
如果要自己制作一个可以用于MODBOOT的模块，请查看里面的使用说明。或以下站点（英文）

[http://nu2.nu/bootdisk/modboot/](http://nu2.nu/bootdisk/modboot/)

无忧启动论坛相关贴子：

[http://bbs.wuyou.com/viewthread.php?tid=184842&amp;extra=page%3D1](http://bbs.wuyou.com/viewthread.php?tid=184842&amp;extra=page%3D1)

有什么疑问可以直接论坛回复或本文章后面评论。
