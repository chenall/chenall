title: Cameyo PackageEditor 简体中文版(增强版)
date: 2014-03-08 16:41:55
id: 1403081642
tags:
- cameyo
- 虚拟化
categories: 
- 程序设计/C#
- 软件推荐/系统相关
description: Cameyo 是一款完全免费的应用程序虚拟化 (Application Virtualization) 工具或者说单文件软件制作工具,PackageEditor 是 Cameyo 的虚拟化程序包修改编辑器,这是基于原版进行细微修改的简体中文版.
---

### Cameyo 简介：

Cameyo 是一款完全免费的应用程序虚拟化 (Application Virtualization) 工具或者说单文件软件制作工具，支持 XP、Vista 、 Windows7、Windows8，支持32位和64位系统。应用程序虚拟化技术就是将完整的程序资源打包为一个单一的可执行文件，从而无需安装即可运行。以前，要制作绿色软件需要学习很多技术，一般用户难以入门，而 Cameyo 则将此绿化过程变得简单且傻瓜。

Cameyo 的原理是利用沙盒（Sandbox）的虚拟化技术，先把所有相关资源打包成单个绿色文件，当执行这个“绿色软件”时，它会产生一个虚拟环境来执行，类似影子系统一样，一切涉及的操作都是在这个虚拟环境中完成，并不会去动原本的系统。所以使用 Cameyo 制作的绿色软件还有一个好处就是几乎不会对系统有害。

### PackageEditor

由于官方原版的翻译一直有问题,为了方便就自己修改编译一个,这个 PackageEditor 是基于[官方源码](https://code.google.com/p/cameyo/)，修改中文资源之后重新编译的，使用2.1版的源码主是要因为这个版本是个过渡版本，同时支持旧版和新的版本的编辑（**只需要把不同版本的dll文件放进去就行了**）。

2.1版修改内容:
  * 把修改图标功能移到扩展属性中,和最新版一样.
  * 修改部份中文资源文件,若有发现翻译错误,还请指出.
  * 修正原版 启动命令 显示的BUG,这个版本可以正常显示.
  * 添加应用版本信息(这个功能其实用处不大,原版把这个功能隐藏了),我只是它显示出来,并且添加部份代码.
<!--more--> 

#### 2014-03-30 更新 **最新2.6增强版**
  
  修改SDK API实现二合一,新的编辑器同时支持编辑新旧两种虚拟化包格式,会可以自动判断,若是打开旧版格式,会提示是否升级,不升级就保留旧版格式.另外使用这个编辑器创建新的虚拟化包时只能创建为旧版格式.需要用新格式的可以保存之后重新打开在提示转换是选择是就行了.

顺便说一下新旧格式的区别: 新版主要是支持**内存运行模式**,还有支持用户数据分离等特性,因为使用了新的压缩格式,速度会快一些,缺点就是产生的虚拟化程序会比较大.另外旧版可以直接用7Z打开看到里面的文件,新版的不行.

![2.1版设置界面]([CDN_URL]:/post/Cameyo_PackageEditor2.1_base.png)

![2.1版高级设置界面]([CDN_URL]:/post/Cameyo_PackageEditor2.1_adv.png)

2.6版只是修改了简体中文资源文件.

![2.6版设置界面]([CDN_URL]:/post/Cameyo_PackageEditor2.6_base.png)

![2.6版高级设置界面]([CDN_URL]:/post/Cameyo_PackageEditor2.6_adv.png)

普通用户的设置界面和前面的一样的,下图有多一些设置界面,这些是需要授权的

授权申请网址: <http://www.cameyo.com/upgrade>

里面有版本对比和升级申请,有需要的可以自己去申请,不一定能通过.

![高级版本设置界面]([CDN_URL]:/post/Cameyo_PackageEditor_Plus_adv.png)

### 相关下载

2.1编辑器+2.0版核心: [PackageEditor2.1简体中文版(内置2.0版组件)](http://d.chenall.net/1/虚拟化绿软/PackageEditor2.1.rar)

2.6编辑器(内存模式运行): [PackageEditor2.6简体中文版](http://d.chenall.net/1/虚拟化绿软/PackageEditor2.6.rar)

最新2.6增强版(推荐使用): [PackageEditor 2.6增强版](http://d.chenall.net/1/虚拟化绿软/PackageEditor.zip)

原版: [Cameyo 2.6.1191 官方原版](http://d.chenall.net/1/虚拟化绿软/Cameyo-2.6.1191.rar)

### 相关资料

cameyo 官方文档（英文）: <http://www.cameyo.com/doc/index.html>

本站 Cameyo相关文章: {%iLink tag:cameyo%}