title: "[Grub4DOS] 系统维护简单应用举例"
id: 112
date: 2009-11-15 20:46:08
tags: 
- GPXE
- GRUB
- GRUB4DOS
- maxdos
- 系统维护
categories: 
- GRUB4DOS/综合
---


以下需要先设置好GRUB4DOS作为引导。

1. 启动硬盘上的系统（不管硬盘上有没有NTLDR/BOOTMGR文件，只要启动配置文件BOOT.INI/BCD存在即可）.
    有时候系统的启动文件被删了就会出现如下提示
    _BOOTMGR is missing_或者_NTLDR is missing_
    这时下面的菜单就可以派上用场了，启动进入系统后再把文件复制过去就OK了，当然了也可以不复制这样你的U盘就是启动KEY了，不懂得的人就进不了你的系统了.

   先复制NTLDR(从XP系统中找）还有bootmgr（VISTA以上系统启动文件），到U盘上。
  ```
	title 1.启动硬盘上的xp/2k3系统(NTLDR)
	chainloader /NTLDR
	find --set-root --ignore-floppies --ignore-cd /boot.ini
	dd if=()+1 of=(md)0x3E+1

	title 2.启动硬盘上的VISTA/WIN7系列系统(BOOTMGR)
	chainloader /BOOTMGR
	find --set-root --ignore-floppies --ignore-cd /boot/bcd
	dd if=()+1 of=(md)0x3e+1
  ```
 
2. 备份恢复硬盘MBR（此功能不熟悉的最好不要用，否则后果自负）
  首先U盘上需要放一个文件比如MBR_BAK，（大小在512字节以上，内容可以随意）作为备份恢复的载体
  ```
	title 1.备份硬盘MBR
	checkrange 0x80 read 0x8280 && dd if=(hd1)+1 of=()/MBR_BAK
	checkrange 0x80 read 0x8280 || dd if=(hd0)+1 of=()/MBR_BAK

	title 2.恢复硬盘MBR
	checkrange 0x80 read 0x8280 || dd if=()/mbr_bak of=(hd0)+1 count=1
	checkrange 0x80 read 0x8280 && dd if=()/mbr_bak of=(hd1)+1 count=1
  ```
 
3. 加载启动一个IMG镜像，比如MAXDOS.IMG
   把MAXDOS.IMG放在U盘boot目录下
  ```
	title MaxDos
	map --mem /boot/maxdos.img (fd0)
	map --hook
	chainloader (fd0)+1
	rootnoverify
  ```

4. 从网络启动（PXE），代替网卡的PXE模块。
  首先从[http://rom-o-matic.net/](http://rom-o-matic.net/)下载GPXE或Etherboot的启动镜像
  选择对应的网卡，如果不清楚，可以找一下看有没有all的（所有网卡），或UNDI的
  到Choose ROM output format时选择GRUB KERNEL FORMAT (.zlilo)
  比如文件名为gpxe.zlilo或etherboot.zlilo把它们放到BOOT目录下
  ```
	title Gpxe 从网络启动
	kernel /boot/gpxe.zlilo

	title Etherboot 从网络启动
	kernel /boot/etherboot.zlilo
  ```
