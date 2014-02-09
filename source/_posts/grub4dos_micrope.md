title: "[Grub4dos] grub4dos高级应用菜单示范"
id: 110
date: 2009-11-12 00:08:01
tags: 
- GRUB4DOS
- 菜单
categories: 
- 个人日记
- GRUB4DOS
---

grub4dos是一个很强大的引导器，想学习使用Grub4dos的朋友不要错过了，马上订阅本文章吧，目前只加了一部份注释.

有看不懂的可以回复哦，我会尽快加上注释。欢迎有兴趣的朋友一起研究。

**2014-01-21**  **注:** *这个菜单使用到了大部份的GRUB4DOS常用功能,新版本的GRUB4DOS功能更加强大,下面很多复杂的功能,使用最新版GRUB4DOS,可能只需要两三个语句就可以实现了*

<!--more-->

以下菜单文件来源 [无限扩展,多功能PE_更新与下载(2009-05-01)最终版](/post/MINIPE_UPDATE.html)


```
terminal console
color white/blue blue/yellow light-red/blue light-green/black
default 0
timeout 3
debug off
# save darddrives_orig:当前磁盘数量保存到 0x6000B
dd if=(md)2+1 of=(md)0x300+1 bs=1 count=1 skip=0x75 seek=0xb
clear

# 一些变量参数信息
# 0x8280    boot_drive
# 0x82A4    0:auto gunzip,1:no auto gunzip
# 0x60100   0:local,1:PXE,2:ISCSI,3:ERROR
# 0x60008   4:/OEM_SCSI.IMG,3:/MINIPE/OEM_SRS.ZIP,2:/OEM_SRS.ZIP
# 0x60000   2,READ /SYSTEM.WIM
# 0x60004   2,READ /NET.WIM
# 0x60110   8bit,save root
# 0x6000B   harddrives_orig
# 0x603FB   MICROPE.ISO文件大小
# 0x603FF   MICROPE.ISO所在分区号
################################
#一些常用语句介绍
#   write 0x60100 3             写内存命令使得内存0x60100的值为3
#   cat --length=0 (disk)/file  cat --length=0 用于获取文件大小，也可以用于检测文件是否存在
#   fallback n  如果后面的语句中有一句执行失败就跳到菜单n
#   kernel  未加参数的kernel,这样扫许会出错，配合fallback n来实现转菜单。
#   fallback F同kernel也是一个固意出错的语句。
#   pause --wait=0 显示后面的信息，不等待，如果wait=2就是等待2秒，如果没有--wait参数就是一直等待。
#   checkrange xx command1 && command2    检测command1执行返回的值是否xx，如是是就执行command2
#   || 如果前面的命令返回了一个失败的值，就执行后面的语句。
#0
title [0] Micro Windows PE (autocheck)\n\r\n\t Micro Windows PE by chenall 2009.11.11 http://www.chenall.com
###########################################################
# GRUB4DOS 版本检测(通过一些新版的功能来检测),如果检测版本不符合就跳到第14个菜单。
fallback 14
# 关闭出错检测
errorcheck off
#(hd)是新版才有的功能，使用cat (hd)+1检测
cat (hd)+1
#如果返回值是23(Error while parsing number)就代表这个版本太低了，正常情况下应该返回21
checkrange 23 errnum && write 0x60100 3
#恢复
errorcheck on
#检测上面的结果，如果内存0x60100位置的值是3就说明版本不符合
#后面kernel不加参数，执行时会出错，配合前面的fall back（错误跳转）来实现菜单跳转
checkrange 3 read 0x60100 && kernel
###########################################################

###########################################################
#PXE启动检测
fallback 1
#判断启动磁盘号，如果是0X21代表它是从PXE启动的就跳。
checkrange 0x21 read 0x8280 && kernel
#
#iSCSI启动检测,在内存512K-1024K之间查找iSCSI启动标志
fallback 2
#\x69BFT=iBFT iBFT是ISCSI启动标志（并且按16字节对齐的）具体可以参考ISCSI启动规范。
cat --locate=\x69BFT --locate-align=16 (md)0x400+0x400 && kernel
#
fallback 3
#写一个值到内存位置0x60100
write 0x60100 0
pause --wait=0 Boot MicroPE From local by chenall 2009.11.11
#文件定位##############################
#检测当前root下是否有指定文件，有就跳到下一菜单
cat --length=0 /WXPE/WINPE.IMG && kernel
#如果上面没有找到就全盘查找，并设置为ROOT
find --set-root /WXPE/WINPE.IMG && kernel
#如果上面还是没有找到就找ISO文件
find --set-root /boot/MicroPE.ISO
#找到了ISO文件，加载这个ISO文件
pause --wait=0 Boot MicroPE With /boot/MicroPE.iso......
#先使用普通的方式映射（比较快），如果不行就加载到内存
map /BOOT/MICROPE.ISO (hd32) || map --mem /BOOT/MICROPE.ISO (hd32)
map --hook

#可选语句，保存ISO文件所在分区号(用于进入PE后确定使用的ISO文件磁盘,因为有可能有多处存在)
cat --length=0 /BOOT/MICROPE.ISO && dd if=(md) of=(md) bs=1 count=4 skip=0x8290 seek=0x603FB
root (hd32)
cat --length=0 /MINIPE/EXT.ZIP
dd if=(md) of=(md) bs=1 count=1 skip=0x829e seek=0x603FF
kernel

#1
title
pause --wait=0 Boot MicroPE From PXE by chenall 2009.11.11
pause --wait=0 Loading WINPE.IMG ......
#如果内存小于120MB，直接读取（需要读两次），否则只需要读一次
checkrange 0x1E000:-1 read 0x8298 && write 0x82a4 1
map --mem=0xB000 /WXPE/WINPE.IMG (rd) || map --mem=0xB000 /MicroPE_PXE.ISO (rd)
write 0x82a4 0
write 0x60100 1
map --mem (rd)/WINPE.IMG (hd0) || map --mem (rd)+1 (hd0)
fallback 3
fallback F

#2
title
pause --wait=0 Bootting MicroPE From iSCSI ......
write 0x60100 2
fallback 3
fallback F

#3
title
pause --wait=0 Loading WINPE.IMG and EXT.ZIP ......
checkrange 0,2 read 0x60100 && map --mem /WXPE/WINPE.IMG (hd0)
cat --length=0 /MINIPE/EXT.ZIP || map --unmap=0xa0
map (hd0) (hd1) && pause --wait=0
map (hd1) (hd) && pause --wait=0
map --hook
#定位外置程序路径/MINIPE/EXT.ZIP,如果没有找到就启动失败
cat --length=0 /MINIPE/EXT.ZIP || find --set-root --ignore-floppies /MINIPE/EXT.ZIP
#保存当前ROOT
dd if=(md) of=(md) bs=1 count=8 skip=0x829c seek=0x60110
#查找OEM_SCSI.IMG和OEM_SRS.ZIP
errorcheck off
find --set-root --ignore-floppies --ignore-cd /OEM_SRS.ZIP || find --set-root --ignore-floppies --ignore-cd /MINIPE/OEM_SRS.ZIP
checkrange 0 errnum || find --set-root --ignore-floppies --ignore-cd /OEM_SCSI.IMG
errorcheck on
cat --length=0 /OEM_SCSI.IMG && write 0x60008 4
cat --length=0 /MINIPE/OEM_SRS.ZIP && write 0x60008 3
cat --length=0 /OEM_SRS.ZIP && write 0x60008 2
checkrange 2,3 read 0x60008 && dd if=(md) of=(md) bs=1 count=4 skip=0x8290 seek=0x60010
checkrange 2 read 0x60008 && map --mem /OEM_SRS.ZIP (fd1)
checkrange 3 read 0x60008 && map --mem /MINIPE/OEM_SRS.ZIP (fd1)
checkrange 4 read 0x60008 && map --mem /OEM_SCSI.IMG (fd1)
#还原ROOT
dd if=(md) of=(md) bs=1 count=8 skip=0x60110 seek=0x829c && root ()/MINIPE
map --mem (hd0,0)/EXT.IMG (fd2)
##如果外置程序所在磁盘的BIOS号是0-3或0x80-0x90,就把这个磁盘映射为(hd1)备用.
##checkrange 0 read 0x82a0 && map ()+1 (hd)
##checkrange 2 read 0x60100 && map ()+1 (hd1)
map --hook
#准备EXT.ZIP
cat --length=0 /EXT.ZIP
dd if=(md)0x41+1 of=(fd2)/_EXT.ZIP bs=1 count=4 skip=0x90
map --mem=0xB000 /EXT.ZIP (rd)
dd if=(rd)+1 of=(fd2)/_EXT.ZIP bs=1 seek=4
pause --wait=0 Modify configuration information
#以下语句用于修改CONFIG.SYS让它加载UNDI_DRV.EXE.默认不加载,使用PXE启动时通过修改特定字符让它加载.
checkrange 1 read 0x60100 && write (fd2)/config.sys devi

#设置DOS变量(1.PXE;2.iSCSI;0.本地)
checkrange 2 read 0x60100 && write --offset=0x0 (hd0,0)/_SETENVI.BAT \r\nset boot=2\r\n
checkrange 1 read 0x60100 && write --offset=0x0 (hd0,0)/_SETENVI.BAT \r\nset boot=1\r\n
checkrange 0 read 0x60100 && write --offset=0x0 (hd0,0)/_SETENVI.BAT \r\nset boot=0\r\n

checkrange 4 read 0x60008 && write --offset=0x40 (hd0,0)/_SETENVI.BAT \r\nset srs=OEM1\r\n
#如果DEBUG开启显示DOS的启动菜单以方便错误处理
checkrange 2 debug && write --offset=0x14 (fd2)/msdos.sys 1
checkrange 2 debug && write --offset=0x10 (hd0,0)/_SETENVI.BAT \r\nset debug=1\r\n
checkrange 0 read 0x60100 && fallback 4
checkrange 0xa0:0xff read 0x82a0 && fallback 15
checkrange 0 read 0x60100 && kernel
#把PXE启动的IP地址信息传到DOS下
dd if=(md)0x41+1 of=(fd2)/IP.BIN bs=1 count=12 skip=0x84
cat --length=0 (hd0,0)/WXPE/SYSTEM/SYSTEM.WIM || write 0x60000 2
cat --length=0 (hd0,0)/WXPE/NET/NET.WIM  || write 0x60004 2
fallback 4
fallback F


#4 模块化跳转
title
fallback 5
checkrange 2 read 0x60000 && kernel
fallback 6
checkrange 2 read 0x60004 && kernel
fallback 13
checkrange 4 read 0x60008 && kernel
fallback 12
checkrange 2,3 read 0x60008 && kernel
fallback 7
map --mem=0xB000 /SRS.ZIP (rd) && kernel
fallback 11
map --mem=0xB000 /F6.ZIP (rd) && kernel
fallback 13
fallback F

#5 system.wim部份
title
write 0x60000 0
pause --wait=0 Loading SYSTEM.WIM......
map --mem=0xB000 /SYSTEM.WIM (rd)
cat --length=0 (rd)+1
pause --wait=0 Writing SYSTEM.WIM to (hd0,0)/system.bin ......
#写system.wim的长度信息到(hd0,0)/system.bin
dd if=(md)0x41+1 of=(hd0,0)/system.bin bs=1 count=4 skip=0x90
#写SYSTEM.WIM文件内容到(hd0,0)/system.bin(从第4个字节开始写),如果写入成功就设置一个变量
dd if=(rd)+1 of=(hd0,0)/system.bin bs=1 seek=4 && write --offset=0x20 (hd0,0)/_SETENVI.BAT \r\nset system=1\r\n
fallback 4
fallback F

#6 net.wim部份,语句功能请参考上面
title
write 0x60004 0
pause --wait=0 Loading @0#net.wim......
map --mem=0xB000 /AUTORUNS/@0#NET.WIM (rd)
cat --length=0 (rd)+1
pause --wait=0 Writing @0#net.wim to (hd0,0)/net.bin......
dd if=(md)0x41+1 of=(hd0,0)/net.bin bs=1 count=4 skip=0x90
dd if=(rd)+1 of=(hd0,0)/net.bin bs=1 seek=4 && write --offset=0x30 (hd0,0)/_SETENVI.BAT \r\nset net=1\r\n
fallback 4
fallback F

#7 检查是否存在外置驱动包,如果有的话自动加载.(SRS.ZIP)
title
fallback 8
pause --wait=0 Loading SRS.ZIP......
cat --length=0 (rd)+1
dd if=(md)0x41+1 of=(fd2)/_SRS.ZIP bs=1 count=4 skip=0x90
dd if=(rd)+1 of=(fd2)/_SRS.ZIP bs=1 seek=4
write --offset=0x40 (hd0,0)/_SETENVI.BAT \r\nset srs=SRS\r\n
fallback F

#8
title
#如果内存大于500MB就设置一个变量(用于自动把镜像转到128MB).需开启高级功能才生效
checkrange 512 read 0x60108 && write --offset=0x50 (hd0,0)/_SETENVI.BAT \r\nset to128=1\r\n
dd if=(md)0x300+2 of=(hd0,0)/_SETENVI.BAT bs=1 count=5 skip=0x3FB seek=0x7FB && pause --wait=0
map (fd2) (fd0)
map --unmap=2
map --rehook

checkrange 2 debug && pause Press any key to continue . . .
pause --wait=0 Booting... && chainloader (fd0)/io.sys

#9
title [9] SET DEBUG mode\n\r\n\tTrun on/off debug level
write 0x60104 0
checkrange 2 debug && write 0x60104 2
checkrange 2 read 0x60104 && debug off
checkrange 0 read 0x60104 && debug on
clear
checkrange 2 debug && pause Debug is now on ...
checkrange 0 debug && pause Debug is now off ...

#10
title [10] Enable advanced mode (test)
write 0x6010c 888
checkrange 0x7d000:-1 read 0x8298 && write 0x60108 512
pause Advanced Mode is enabled

#11
title
fallback 8
pause --wait=0 Loading F6.ZIP......
cat --length=0 (rd)+1
dd if=(md)0x41+1 of=(fd2)/_SRS.ZIP bs=1 count=4 skip=0x90
dd if=(rd)+1 of=(fd2)/_SRS.ZIP bs=1 seek=4
write --offset=0x40 (hd0,0)/_SETENVI.BAT \r\nset srs=F6\r\n
map --mem (fd2)/bat/F6.gz (fd1)
map --hook
fallback F

#12
title
fallback 8
pause --wait=0 Loading OEM_SRS.ZIP......
dd if=(md)0x300+2 of=(fd2)/_SRS.ZIP bs=1 count=4 skip=0x10
dd if=(fd1) of=(fd2)/_SRS.ZIP bs=1 seek=4
write --offset=0x40 (hd0,0)/_SETENVI.BAT \r\nset srs=OEM\r\n
map --mem (fd2)/bat/F6.gz (fd1)
map --hook
fallback F

#13
title
fallback 8
checkrange 1,2 read 0x60100 && kernel
map (fd2) (fd0)
map --unmap=2
map --rehook && configfile (fd0)/menu.lst
fallback F

#14
title
pause --wait=0 Error!
pause GRUB4DOS Version mismatched!

#15
title
#如果虚拟光驱中,设置一个变量,使得启动时优先使用光驱或ISO上的外置程序.
fallback 4
write --offset=0x60 (hd0,0)/_SETENVI.BAT \r\nset CDROMEX_=1\r\n
read 0x603fb && kernel
#获取虚拟ISO文件的大小.
map () (hd30)
map --hook
cat --length=0 (hd30)+1
checkrange 0xfb0400 read 0x82b0 && kernel
dd if=(md) of=(md) bs=1 count=4 skip=0x82b0 seek=0x60110
dd if=(md) of=(md) bs=1 count=4 skip=0x8290 seek=0x60114
dd if=(md)0x300+2 of=(hd0,0)/_SETENVI.BAT bs=1 count=8 skip=0x110 seek=0x7F0
map (hd30) (hd30)
map --hook
fallback F
```