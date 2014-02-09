title: "wee install script for grub4dos"
id: 615
date: 2010-12-31 09:09:35
tags: 
- GRUB4DOS
- wee
- 批处理
categories: 
- GRUB4DOS/批处理
---

wee是由不点基于grub4dos开发的嵌入微型 grub,可以安装到硬盘MBR上代替原来的引导代码.

有什么用途呢?

得益于GRUB4DOS的灵活性,wee同样很灵活,可以启动任意支持的分区上的可启动文件.

比如你的系统引导文件损坏了,如果是默认的MBR,则这时整个系统就挂掉了.有安装了wee就不一样了.

可以利用它来启动备用的或其它的引导程序,然后进行修复工作.

英文好的可以看一下软件的说明和readme
>   This software initially aims to install on the MBR track of the hard drive,
   though also possible to write to ROM by someone who is interested.

>   WEE access disk sectors only using EBIOS(int13/AH=42h), and never using
   CHS mode BIOS call(int13/AH=02h). So, if the BIOS does not support EBIOS
   on a drive, then WEE will not be able to access that drive.

>   WEE supports FAT12/16/32, NTFS and ext2/3/4, and no other file systems are
   supported.

>   WEE can boot up IO.SYS(Win9x), KERNEL.SYS(FreeDOS), VMLINUZ(Linux), NTLDR/
   BOOTMGR(Windows), GRLDR(grub4dos). And GRUB.EXE(grub4dos) is also bootable
   because it is of a valid Linux kernel format.

>   Any single sector boot record file(with 55 AA at offset 0x1FE) can boot
   as well.

>   Besides, WEE can run 32-bit programs written for it.

 [wee readme](https://grubutils.googlecode.com/svn/grubutils/wee/README.txt)

相关贴子:

无忧启动论坛:   [http://bbs.wuyou.com/viewthread.php?tid=167593](http://bbs.wuyou.com/viewthread.php?tid=167593)
时空论坛:  [http://bbs.znpc.net/viewthread.php?tid=5838](http://bbs.znpc.net/viewthread.php?tid=5838)

`本代码只是为了测试还有示范一下GRUB4DOS的批处理功能`
安装会比较麻烦,可以参考无忧启动论坛的贴子进行图形界面安装.

我利用最新版GRUB4DOS的功能写了一个脚本,用于安装wee到硬盘上.可以把脚本和wee63.mbr放在u盘或光盘上用grub4dos启动来进行安装修复.

使用方法:
  1. instwee NUM
    NUM是0-9的数字,代表着要安装到哪个磁盘.

    比如安装到第一个硬盘

    instwee 0

  2. instwee menu NUM
    显示指定硬盘已经安装wee的内置菜单

  3. instwee menu NUm weemenufile
     导入菜单
     例子: 导入/boot/grub/menu.wee菜单文件到第一硬盘已经安装的wee中.
     instwee menu 0 /boot/grub/menu.wee

[2010-12-30更新下载] (http://dl.dbank.com/c0at23wlxf)

1.  添加简易的GPT磁盘判断，如果是GPT磁盘，拒绝安装。
2.  其它小调整。 


![](https://www.sugarsync.com/pf/D601052_6893493_13501)

安装界面截图: 按Y键确认安装,其它键退出.

![](https://www.sugarsync.com/pf/D601052_6893493_13560)

如果之前已经安装过了,提示按R键重新安装.

![](https://www.sugarsync.com/pf/D601052_6893493_13562)

安装成功,现在的MBR就是WEE引导代码了.

![](https://www.sugarsync.com/pf/D601052_6893493_13564)

显示菜单截图.instwee menu 0

![](https://www.sugarsync.com/pf/D601052_6893493_13503)

附上GRUB4DOS的批处理代码:

```
!BAT wee install script for grub4dos by chenall http://chenall.net/post/grub4dos_instwee/
debug off
checkrange 20101230:-1 read 0x8278 || goto :help
::对临时变量所使用的内存0x60000进行初始化(置0操作)
echo -n > (md)0x300+2
clear
write (md)0x300+1 %1 || goto :help
::检测第一个参数，如果是menu则跳到menu块执行．
checkrange 0x756e656d read 0x60000 && goto :menu
:0x30:0x39 是 0-9的ASCII码
checkrange 0x30:0x39 read 0x60000 || goto :help
cat (md)0x300+1,1 | call :confirm hd
exit

:menu
write (md)0x301+1 %2 || goto :Error
checkrange 0x30:0x39 read 0x60200 || goto :help
cat --locate=wee (hd%2)+1,0x1b0 || goto :failed
map --mem=0xf000 (hd%2)50+13 (rd)
:::自动检测菜单位置,注以下内容比较复杂,没有弄懂不要乱改,否则可能导致写盘出错.
debug 1
cat --locate=\xB0\x02\x1A\xCE --number=1 (rd)+1 > (md)0x300+1,8
debug off
cat (md)0x300+1,8 | echo -n | calc *0x60010=16+0x
calc *0x82d8=13<<9-*0x60010
calc *0x82d0=0x1E00000+*0x60010
::没有指定菜单文件参数显示当前菜单内容.
cat --length=0 %3 || goto :show_menu
echo Importing wee menu..
calc *0x82d8=*0x8290+0x1f&0xff0
cat %3 > (rd)+1
calc *0x82d0=0x1E00000+*0x60010-16
cat (md)0x300+1,5 | echo -n | dd if=(rd)+1 of=(hd%2)50+13 bs=1 seek=0x
echo succeeded!
exit

:show_menu
debug 1
cat --locate=\0 --number=1 (rd)+1 > (md)0x301+1,4
debug off
cat (md)0x301+1,4 | echo -n | calc *0x82d8=0x
clear
echo -P:0715 $[0104]wee menu export
echo -e -P:0408 $[0104]wee $[0003]install script for $[0106]grub4dos $[0105]by chenall
echo -P:0535 $[0003]http://chenall.net/post/grub4dos_instwee/
cat (rd)+1
exit

:confirm
checkrange 0xEE parttype (%1,0) && call :Err_msg Not support GPT DISK!
echo -e -P:0810 $[1104]Warning: $[0004]Will install wee63.mbr to %1 \n\n\n\t$[0003]Please press $[0002]'Y' $[0003]to confirm, any other keys to exit...
echo -e -P:0408 $[0104]wee $[0003]install script for $[0106]grub4dos $[0105]by chenall
echo -P:0535 $[0003]http://chenall.net/post/grub4dos_instwee/
checkrange 0x59,0x79 pause || call :Err_msg Cancelled.
:install
echo checking...
map --mem=0xF000 /boot/grub/wee63.mbr (rd) || call :Err_msg /boot/grub/wee63.mbr not found.
cat --locate=wee (rd)+1,0x1b8 || call :Err_msg wee63.mbr file.
::检测WEE63.MBR是否正确
dd if=(rd)+1 of=(md)0x300+1 bs=1 count=4 skip=0x86
checkrange 0xCE1A02B0 read 0x60000 || call :Err_msg wee63.mbr file.
call :check_installed %1
echo Installing...
::备份原来的MBR到第二扇区如果已经安装则直接备份第二扇区
checkrange 840202 read 0x60004 && dd if=(%1)1+1 of=(rd)1+1 ! dd if=(%1)+1 of=(rd)1+1
::复制分区表到第1扇区
dd if=(%1)+1 of=(rd)+1 skip=0x1b8 seek=0x1b8 bs=1
::检测是否有menu.wee文件
cat --length=0 /BOOT/GRUB/MENU.WEE && call :inst_menu
::写入硬盘前63扇区
dd if=(rd)+1 of=(%1) count=63
echo Good luck! succeeded!
exit

:inst_menu
::debug 1是必须的，因为我们要提取结果．
debug 1
::定位菜单开始位置
cat --locate=\xB0\x02\x1A\xCE --number=1 (rd)50+10 > (md)0x300+1,8
debug off
cat (md)0x300+1,5 | echo -n | calc *0x60010=50<<9+16+0x
::设置rd-base在菜单开始位置这样可以就直接用(rd)+1的方式来访问菜单内容．
calc *0x82D0=0x1E00000+*0x60010
::菜单长度，menu.wee文件长度,16字节对齐．最长不超过4KB
calc *0x82D8=*0x8290+0x1f&0xff0
::写入菜单
cat /BOOT/GRUB/MENU.WEE > (rd)+1
::重新计算rd-base和rd-size.
calc *0x82D8=*0x8290+0xf&0xff0+*0x60010
calc *0x82D0=0x1E00000
exit

:check_installed 
cat --locate=wee (%1)+1,0x1b8 || exit
echo wee already installed,Press 'R' to reinstall.
checkrange 0x52,0x72 pause || exit 5
write 0x60004 840202
exit

:failed
echo failed!
exit 3

:Err_msg
echo
echo Error: %1 %2 %3 %4 %5 %6 %7 %8 %9
pause Press any key to continue . . .
exit 1

:Error
:help
echo -e Usage:\n Install wee\t instwee NUM\n show menu\t instwee menu NUM\n import menu\t instwee menu NUM weemenufile\ne.g.:\tinstall wee to (hd0)\n\tinstwee 0
echo Notes: You must use grub4dos-0.4.5b-2010-12-30 or later!
exit 1
```