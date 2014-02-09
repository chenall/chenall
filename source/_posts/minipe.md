title: "[原创] 支持外置硬盘控制器驱动+最小巧最灵活的PE"
id: 6
date: 2008-05-05 23:15:40
tags: 
- GRUB
- MINIPE
- SCSI
- winpe
- WXPE
categories: 
- 软件推荐/原创分享
---

不再想写说明了，以下就只供参考。
 目前支持两种方式的外置驱动
具体请点击以下地址查看.
[外置硬盘控制器驱动](http://bbs.wuyou.com/viewthread.php?tid=121168&amp;page=14#pid1350015)使用添加方法

决定采用第二种方法。(利用无盘天使驱动）
已经上传了测试版本=080303=XXXX.RAR（两个文件，一个内核一个驱动）使用方法内详

这个内核除了具有
[[原创&amp;分享]新型PE内核(无限扩展,无限可能).](http://bbs.wuyou.com/viewthread.php?tid=118886&amp;highlight=%2Bchenall)

同样的功能外，另支持多种启动方式(首创)

具体:  [PE多功能内核](http://chenall.blog.163.com/blog/static/47400182200812735731923/)   ISO文件下载 [=080303=多启PE演示.rar](http://www.bibidu.com/fileview-400319.html)

 
{% blockquote chenall %}
PE内核多功能版演示

若只需使用其中一种方式WINPE.IMG可以压缩成相应格式.第1,2可以压缩成CAB格式(目前压缩后14MB左右)

第3,4可以压缩成GZIP格式(压缩后15.6MB).

多功能:

1. 可以使用RAMDISK方式启动(第1个.2个菜单)
   winnt.sif内容(注此ISO里面是WINNT.XPE)
```
  [SetupData]
  BootDevice="ramdisk(0)"
  BootPath="\WXPE\SYSTEM32\"
  OsLoadOptions="/minint /fastdetect /rdpath=WXPE\WinPE.IMG"
```

  启动例子:
```
title 1. Micro Windows PE Without Sata/Raid/SCSI (ramdisk)
chainloader ()/WXPE/SETUPLDR.BIN
title 2. Micro Windows PE With Universal ATA driver (ramdisk)
chainloader ()/WXPE/SETUPLDR.B2N
```
2. 可以直接独立启动,不依赖WINNT.SIF(第3,4个,只需一个WINPE.IMG)

  只需要一个WINPE.IMG即可,不需要其它文件(WINNT.SIF,SETUPLDR.BIN等都不需要)

  启动例子:
```
title 3. Micro Windows PE Without Sata/Raid/SCSI (WDSYS)
map --mem --unsafe-boot ()/WXPE/WINPE.IMG (hd0)
map --hook
chainloader (hd0,0)/setupldr.bin
title 4. Micro Windows PE With Universal ATA driver (WDSYS)
map --mem --unsafe-boot ()/WXPE/WINPE.IMG (hd0)
map --hook</font>
```
3. 非RAMDISK方式启动,测试方法

  直接将里面的文件复制到系统盘根目录下(不需要改名)

  直接启动里面的<font color="#ff8c00">setupldr.bin</font><font color="#333333">即可</font>

  注:这只是一个演示,更方便的用途在于使用PXE方式启动.可以有双重启动方式,一种不行就换另一种.而且不管使用哪种方式启动,使用的内存都是差不多的

所有使用RAMDISK启动的PE都可以改成这种方式

{% endblockquote %}

以下的内容可以不用看了.只供参考

 
### 方式1.
缺点: DOS部份可以全自动,但后期需要按F6进行手工加载. 
优点: 比较传统，可以保证正常加载 

利用GRUB虚拟一个内存盘A:(1.44MB的镜像足够),360KB的也应该够用了(硬盘控制器的驱动不会很大)
```
map --mem .../scsi.gz (fd0)  # (用内存盘的模式加载镜像里面只有启动文件还有几个必要的文件)
map .../scsi_ext.img (fd1)   #  (不使用内存盘加载这个镜像里面存放了硬盘控制器的驱动)(当然内存够大也可以内存加载)
.....
chainloader (fd0)+1
```
1. 首先启动到DOS模式 
2. 检测本机对应的硬盘控制器驱动.
3. 复制对应的TXTSETUP.OEM到A:根目录.

用GRUB启动PE,再按F6直接加载驱动.

当然了也可以将所有的驱动搞成一个TXTSETUP.OEM文件,启动时按F6选择相应的驱动(会有许多,需要选择正确的驱动不方便)

### 方式2:
缺点: 由于使用了全新的方式，可能会加载不了。测试中......
优点： 可以做到全自动化。其它的等待发掘....

利用无盘天使来启动.还是使用GRUB
1. 将PE做成无盘天使的镜像.再利用GRUB启动
map --mem ..../winpe.dsk (hd0)
map .../scsi_ext.img (fd0) 
..
启动到DOS.由于已经将PE的镜像加载到的(hd0)所以在DOS下可以直接通过访问C:就是PE镜像了(要求镜像要用FAT/FAT32格式的)

2. 检测硬盘控制器驱动,将找到的驱动的.SYS文件复制到DRIVERS目录下.
  再用INIFILE修改TXTSETUP.SIF

3. 启动GRUB加载SETUPLDR.BIN启动.

 