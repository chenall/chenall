title: "[分享] 基于GRUB4DOS的硬盘工具箱[2012-06-27DP更新]"
id: 700
date: 2012-02-13 16:00:55
tags: 
- GRUB4DOS
- 工具箱
categories: 
- GRUB4DOS/实用
---

自用的硬盘工具箱，可以方便进行系统维护工作。

引导程序WEE+GRUB4DOS。

自带基于MODBOOT的一键恢复程序QGHO，可以随时进行备份恢复系统。

可以方便的进行功能扩展，一切皆有可能。

### 说明：
*   默认情况下不显示任何菜单，只有在需要的时候才会显示（按对应的按键，或使用了自定义的菜单接口）
*   自带MODBOOT和NTBOOT两个组件。
*   可以通过很简单的方法进行功能扩展。
*   恢复系统使用的是QGHO（基于MODBOOT）。
*   启动时如果不按任何按键或按了无效按键则使用默认的方式启动系统（启动第一激活的主分区上）

    如果有存在SYS_MENU.LST文件则会调用该菜单。
    可以通过按指定的按键进入对应的系统。

*   所以的东西都可以自己修改（当然了前提是你熟悉GRUB4DOS，知道要改的东西。）
*   因为是使用WEE作为主引导的，安装、修复都很方便，双击一下就搞定了。
*   一些文件目录说明。
    ADDONS　　　附加工具目录，下载附加的工具直接解压到该目录下就可以了。
    BIN　　　　　　一些应用程序，用于修复系统引导。
    MODBOOT　　MODBOOT模块程序
    NTBOOT　　　NTBOOT模块程序
    grub　　　　　GRUB4DOS程序目录。
    以上目录一般情况下你可以不必理会它里面的内容。
    PRELOAD.BAT　主引导界面还有快捷键的定义批处理（GRUB4DOS专用）
    preload.fnt　　主引导界面使用的字体库。
    SYS_MENU.LST　自定义的默认引导菜单（公开的菜单，自己创建，如果有的话默认就会显示这个菜单内容）

## 【更新历史】

### 2014-01-13
*  删作本页面的部份失效图片

### 2012-06-27

*   DPMS 驱动更新到1206版
*   GRUB4DOS更新到最新版本。
*   NTBOOT 的NT6启动文件改成WINDOWS 8的BOOTMGR。
*   绝对PE工具箱更新
*   更新的文件

### 2012-03-18
*   DPMS驱动更新

### 2012-02-28
*   GRUB4DOS更新到最新版本
*   NTBOOT更新（NT6使用了WINDOWS 8的BOOTMGR）
*   通用PE工具箱V3.0 （AbsolutePE），来源：http://hi.baidu.com/uepon/blog

### 2012-02-13
*   DPMS驱动更新到1201版。
*   GRUB4DOS版本更新到最新版。
*   NTBOOT更新。

### 2011-12-12
*   DPMS驱动更新。
*   NTBOOT更新。
*   GRUB4DOS版本升级。

### 2011-11-06
*   GRUB4DOS更新.
*   BUG修正.
*   新的启动界面,增加了从USB/CDROM/NET启动的功能.

### 2011-10-07

*   ﻿QGHO修正
*   GRUB4DOS更新
*   新增支持自动检测多操作系统功能
    按F8就可以显示支持的系统菜单
    按Ctrl+F8重新检测
    比如你硬盘第一个分区安装WINDOWS 2003,第二个分区安装WINDOWS XP
    第三分分区安装WINDOWS 7，启动时按F8可以自动检测到，按菜单选择启动。
    其它说明:
    1. 支持VBOOT启动的VHD/VMDK系统，把这些文件放在放在任意硬盘的VBOOT目录下就可以自动检测
    2. 支持NT6的VHD启动功能。把VHD文件放在任意硬盘的WIN_VHD目录中就可以自动检测.
    3. 以上两个系统的文件名必须以@开头才会自动检测。

### 2011-09-29
*   QGHO修正调整,
*   NTBOOT更新,支持调用DPMS生成驱动
*   DPMS更新.
*   GRUB4DOS更新到最新版本.

### 2011-09-19

*   修正QGHO备份失败的问题.

### 2011-09-18

1.  升级GRLDR到最新版,更新WEESETUP程序.
2.  修正上一个版本QGHO的BUG

### 2011-09-14

1.  [全新的QGHO一键恢复程序.](http://chenall.net/post/modboot_qgho/)
2.  升级GRLDR
3.  更新DPMS驱动包到最新版本

### 2011-09-05

1.  QGHO更新,全新设计的QGHO,测试版.
2.  GRLDR升级到最新版本.
3.  addons内置DPMS.BAT脚本.

### 2011-08-30

1.  **﻿此版本内置的QGHO有问题,不能正常使用,请更新或使用旧版本**
    更新NTBOOT/MODBOOT脚本.
	更新GRUB4DOS到最新版本.


### 2011-08-11

1.  主程序更新,修正PRELOAD.BAT一个BUG.

### 2011-08-09

1.  DPMS更新.**修正了一个小错误.**
2.  GRUB4DOS更新到2011-08-09版.
3.  NTBOOT更新.**PE1添加了一个ntpath参数,具体用法请查看tangope.rar里面的#TangoPE.txt**.
4.  MODBOOT更新.**批处理脚本修改优化.**
5.  QGHO一键恢复程序更新.
    重新设计了自定义恢复过程,初次启动时自动查找所有硬盘分区根目录下的GHO文件并列在菜单上.

    可以选择指定分区再次查找(默认找2级目录) ,可以修改支持查找N级目录

    打开MODBOOT\LEVEL3\QGHO.BAT查找Q.S.SUB=2,要找几级就改成2,建议不要太大,否则查找的过程很慢.
6.  添加了一个新的下载地址.Dbank下载.
7.  其它小调整 .

### 2011-08-02

1. 添加[DPMS模块](http://bbs.wuyou.com/viewthread.php?tid=197550)(动态生成SRS驱动),供PE1.X调用.

2. 更新GRLDR到最新版本.

3. 添加[SRSF6N](http://bbs.wuyou.com/viewthread.php?tid=179738)模块.

4. 添加模块 [MINI TangoPE 2011 Native](http://hi.baidu.com/nictense/blog/item/d833fe26f6b64414918f9dc4.html).

5. 重新设计了模块菜单加载方法,新的方案只要在第一次使用或删改了模块时才需要重新生成菜单.

不需要每次启动都动态生成菜单,加快了启动速度.

注: 因为使用了新的菜单方案,所以必须更新所有的ADDONS菜单脚本.请重新下载所有模块进行更新.

### 2011-07-29

1. 更新GRUB4DOS和WEESETUP.其它小更新.

### 2011-07-13

1. 修正一些小问题。

2. 使用最新版GRUB4DOS。

3. NTXPPE模块更新。

### 2011-07-09

1. 更新NTBOOT到最新版。

2. 更新MODBOOT到最新版.

3. QGHO（快速恢复）增强。


支持简单快速恢复。

使用方法：&nbsp;创建一个QGHO.###到你要恢复到的分区根目录下（必须是激活的主分区）

QGHO.###文件内容指定了GHO文件的路径。

4.GRUB4DOS升级到最新版。

5.支持修改默认的一键恢复密码。

安装方法：

下载SYS_TOOLS.RAR并解压到你电脑的任意磁盘根目录下。注： 解压完成后会多出一个BOOT目录（隐藏的）。
进入BOOT\BIN目录，双击setup_hd0.cmd就行了。

注：如果有杀毒软件可能会有警报，否则不会有什么提示，重启系统即可。如果安装失败可以尝试使用BOOTICE进行安装

BOOTICE 下载地址: [http://bbs.wuyou.com/viewthread.php?tid=57675](http://bbs.wuyou.com/viewthread.php?tid=57675)

用BOOTICE进行第二步的安装方法

![]([CDN_URL]:/upload/2011/05/31AAE4E9668FEC052E0BF3DB7B4FD8FD4A46CA6A.png)

![]([CDN_URL]:/upload/2011/05/8112D8AD5D88D0D09C2F16C21C5C6A8EDDDC6301.png)

![]([CDN_URL]:/upload/2011/05/57DFB415C94B3DCBFB4DFB69843744865EB8742A.png)

基本模块 ： 直接解压到任意磁盘的根目录下，然后运行BOOT\BIN\setup_hd0.cmd就可以了（也可以自己使用BOOTICE安装WEE引导，使用WEE的默认菜单就行）

SYSTOOLS.RAR是主模块,必须的,其它的是附加模块,解压到ADDONS目录下就行了.

ADDONS目录是存放其它模块的，该目录下的#xxxxx.txt是对应模块的菜单内容。

第一行固定为菜单标题，不需要title，后面的是该菜单要执行的命令。

可以自己参考以上模块自己添加其它模块，也欢迎共享你的模块。

默认是启动第一个激活分区上面的系统，你可以自己写一个菜单文件改名为SYS_MENU.LST放到BOOT目录下，默认就会调用该菜单。

进入一键恢复的密码默认是qgho，在启动时按F9输入正确的密码之后可以修改.


## 【下载地址】之前的链接已失效,如若需要可以留言我再抽空整理下重新上传.
