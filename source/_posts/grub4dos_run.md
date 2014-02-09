title: "[GRUB4DOS] GRUB4DOS 批处理脚本示范"
id: 612
date: 2010-12-14 23:46:26
tags: 
- batch
- GRUB4DOS
- 原创
categories: 
- GRUB4DOS/批处理
---

GRUB4DOS是什么东西,我这里就不解释了.

本脚本可以简化GRUB4DOS菜单编写的难度.

适用在合盘或需要选择启动多种镜像的情况.

使用方法非常简单. 具体见里面的例子:

附上两个增强的版本：

zxw版： [自动列表.数字启动](http://bbs.wuyou.com/viewthread.php?tid=183722&amp;extra=page%3D1)

sratlf版: [198#新版测试;简单菜单,实现grub加载任意ISO/IMG/RAMOS/引导文件等](http://bbs.wuyou.com/viewthread.php?tid=182793&amp;extra=page%3D1)

```bat
!BAT
::GRUB4DOS 简易批处理脚本.
::用途: 在合盘时省去写大量菜单的麻烦.
::用法:
::     1.直接启动.
::        例子:
::            default 0
::            timeout 5
::            title 1.Windows NT/2k/XP/Vista Change Password / Registry Editor
::            RUN NT-PASS.ISO
::            boot
::             tile 2.MAXDOS Tools Box
::             RUN MAXDOS.IMG
::             boot
::  注意: 1. 扩展名为gz/img/ima 默认都当成软盘来启动.ISO作为一个光盘镜像来启动.
::        2. 本脚本默认镜像文件路径是(bd)/BOOT/IMGS/,可以自己修改成其它路径.
::     2.自动根据/BOOT/IMGS/目录下的文件生成菜单.(固定用法)
::           title auto make menu for /BOOT/IMGS/
::                 RUN .automenu
::                 configfile (md)0x3000+0x10
::  本脚本需要GRUB4DOS 2010-12-14 以上的版本.
::  需要的文件WENV:(使用动态菜单才需要)
::  下载地址: http://bbs.wuyou.com/viewthread.php?tid=182254
::  更多信息访问 http://chenall.net/post/grub4dos_run/
::==============================================================================
debug off
checkrange 20101214:-1 read 0x8278 || echo Err.version && exit 1
goto %~x1
exit

:.img
:.ima
:.gz
map --mem (bd)/BOOT/IMGS/%1 (fd0)
map --hook
rootnoverify (fd0)
chainloader +1
exit

:.iso
map --mem (bd)/BOOT/IMGS/%1 (0xff)
map --hook
chainloader (0xff)
exit

:.automenu
delmod -l wenv || insmod WENV
delmod -l %~nx0 || insmod %0
WENV dir (bd)/BOOT/IMGS/ > (md)0x3800+0x80
echo -e default 0\ntimeout 10\n > (md)0x3000+0x10
WENV for /f %i in ( (md)0x3800+0x80 ) do exec %~nx0 .makemenu %i
echo -e \ntitle Back to main menu(configfile (md)4+8)\nconfigfile (md)4+8 >> (md)0x3000+0x10
goto :eof

:.makemenu
WENV check "#.txt#"=="#%~x2#" && goto :eof
cat --length=0 (bd)/BOOT/IMGS/%~n2.TXT && cat (bd)/BOOT/IMGS/%~n2.TXT >> (md)0x3000+0x10 ! echo title %2 >> (md)0x3000+0x10
echo -e \n%~nx0 %2\nboot >> (md)0x3000+0x10
```
效果截图.

![](https://www.sugarsync.com/pf/D601052_6893493_11560)

以下菜单为自动生成,

其中Windows NT/2k/Xp/V....菜单对应的文件是NT-PASS.ISO

同目录下NT-PASS.TXT的内容如下.

title Windows NT/2k/XP/Vista Change Password / Registry Editor\nhttp://pogostick.net/~pnh/ntpasswd/

![](https://www.sugarsync.com/pf/D601052_6893493_11568)
