title: "[分享] ALMRun–小巧的快速启动工具"
id: 906
date: 2013-03-31 10:32:00
tags: 
- altrun
- merry
- 快速启动
- 编程
- C++
- wxWidgets
categories: 
- 程序设计/C++
description: ALMRun 是一个实用绿色的快速启动软件,类似于ALTRUN等同类软件,集成了ALTRUN的优点.绿色实用,支持管理热键/程序,支持模拟输入,支持LUA扩展,通过LUA扩展.无所不能.
keywords: ALMRun,Launchy,Executor,FindAndRunRobot,altrun,merry,启动,VC,程序,软件,便捷,快速,高效,实用,开源,扩展,lua,c++
---

ALMRun 修改自[Merry] 是一个软件便捷启动工具,类似于[ALTRUN]等软件,功能更强,也是我所经手的第一个VC程序,同样是开源的.感谢原作者[Name5566]

之前一直在使用[ALTRun],只是这个好久没有更新了,有一些问题无法实现,所以我就在找同类的软件,  

使用过像Launchy,Executor,FindAndRunRobot等软件,但各有各的缺点都不太顺手,直到有一天在GoogleCode上无意中发现了这个软件Merry,看了软件介绍,基本上就是我理想中的样子,很感兴趣就下载来测试了.

<!--more-->

以下文字来源于原版介绍.
=======================

>Merry 是一个 Merry 命令执行工具。部分功能相似的软件有 Linux 下的[gmrun](http://directory.fsf.org/wiki/Gmrun)，Windows 下的[AutoHotkey](http://www.autohotkey.com/)或[ALTRun]等，跨平台软件[Launchy](http://www.launchy.net/)（不过 Merry 和它们在定位上有差别）。

>### 为什么开发 Merry

>最初使用 Linux 系统非常喜欢 gmrun + openbox 的组合，gmrun 能够弹出一个命令输入窗口，输入程序的名称就可以执行对应的程序，而 openbox 则可以非常方便的进行快捷键的绑定。后来使用 Windows 系统时，一直没有找到类似的替代软件，从而萌发了自己开发一个的想法。简单的制作之后，我开始使用 Merry，经过长时间的使用发现确实带来了很多的便利，致使之后使用没有安装 Merry 的机器时感觉很不习惯，这时候我发现它应该是一个有用的软件，于是有了今天的开源软件 Merry。随着时间的流逝 Merry 已经越来越丰富，而不仅仅只有上述这么简单的功能而已，只要你有想法，Merry 能尽量帮助你实现。

>### Merry 的目标

>在基于窗口的操作系统中，简化一切重复、繁琐的操作并提供一些实用的功能。

>### Merry 的特点和功能

> *   跨平台的支持，让你在所有平台下保持一致的操作方式（目前仅仅实现了 Windows 版本，相信不久之后 Linux 和 MacOS 版就会完成）
> *   可以定义 Merry 命令（快捷键）来完成一些常用的操作，例如：打开目录、启动程序、打开网页等
> *   通过 Merry 命令可以模拟用户的输入，例如：模拟键盘和鼠标输入
> *   通过 Merry 可以轻松的管理窗口，例如：关闭窗口、最大化和还原窗口、移动窗口、隐藏窗口等
> *   通过 Merry 命令可以来进行自动化的操作，例如：打开某应用程序，自动输入用户密码进行登录等
> *   Merry 采用完全开放的体系，可以使用 [Lua](http://www.lua.org/) 的扩展库或者外部程序来扩展 Merry 的功能

其它介绍请移步下面的网址,我就偷懒不写了.

https://code.google.com/p/name5566-merry/

由于原版的功能还不是很完善,而我之前也是习惯使用ALTRun的,所以就尝试修改了一下,之前使用ALTRUN的也可以快速转过来.

修改增强版最主要特点(其它的请看软件目录下的[README.MD](https://github.com/chenall/Merry))

*   支持调用ALTRUN的命令列表.
*   支持自动扫描指定目录下指定扩展名的文件,并添加到列表中,并且可以指定子目录级别
*   简化添加命令方法.
*   像ALTRUN一样允许按ALT+N直接启动.
*   选中命令之后可以按Ctrl+D定位程序位置(打开程序文件夹).
*   支持命令排序功能.
*   支持拼音首字母识别(当下比较流行的)
*   新增易于维护的NI格式配置文件.
*   支持右键发送到或拖放快速添加命令(支持批量添加)
*   图形化命令管理器.
*   许多实用性功能改进

另外这个也是可以作为WIN+R来使用的,比如你并没有添加services.msc命令,这时输入services.msc列表当然是不会有任何显示的,不过按回车之后还是会执行到services.msc的,并且会自动添加到列表中,以后再输入就可以看到了.同样支持按TAB输入参数

因为我是初次接触VC,对VC不熟,修改过程中遇到问题都是从Google找的答案,程序可能会有一些BUG.

我目前已经使用这个替换了ALTRUN,因为ALTRUN能实现的,这个基本上实现了,没实现了我也会根据需求,尽量去实现.

其它的不多说了,不管我觉得如何,<span style="color: #800000;">适合自己的</span>,<span style="color: #800000;">用得顺手的</span>才是最好的,各有所好.

有兴趣的可以下载测试,有问题或建议同样欢迎反馈...

截图

![软件界面截图]([CDN_URL]:/img/ALMRunMain.png "软件界面截图")

选定命令之后按TAB键可以添加参数

![直接输入参数]([CDN_URL]:/img/merry_args.png "可以直接输入参数")

在命令列表按Insert键添加新命令

![按Insert键添加新命令]([CDN_URL]:/img/ALMRun_AddCmd.png "按Insert键添加新命令")

支持拼音首字母识别,比如:列表中有"宽带连接",可以输入 "`kdlj`"  
这是根据区位表匹配的,比较节省代码,只支持GB2312字符,也没有处理多音字,碰到多音字,一个不行可以换另一个.如果有兴趣帮助我一起开发的可以联系我,或者直接提交补丁文件给我.

主页地址： [http://almrun.chenall.net](http://almrun.chenall.net)  
更新记录: [http://almrun.chenall.net/update_log.html](http://almrun.chenall.net/update_log.html)  
修改版源码: [https://github.com/chenall/ALMRun](https://github.com/chenall/ALMRun)  
更多功能介绍: [http://almrun.chenall.net/](http://almrun.chenall.net/)  
扩展功能介绍: [https://github.com/chenall/ALMRun/blob/master/doc/config_api.md](https://github.com/chenall/ALMRun/blob/master/doc/config_api.md)  

**注：ALMRun独立主页已经上线，以后请关注[ALMRUN主页](http://almrun.chenall.net)获取更新。**

软件下载:
 * [稳定版下载](https://github.com/chenall/ALMRun/archive/v1.2.0.55_BIN.zip)  
 * [最新编译版本下载](https://github.com/chenall/ALMRun/archive/Build.zip)  
 * [历史版本下载](http://almrun.chenall.net/update_log.html)  

[Merry]: http://code.google.com/p/name5566-merry/
[Name5566]: http://name5566.com/ "ALMRun 的前身Merry作者"
[ALTRun]: https://code.google.com/p/altrun/
