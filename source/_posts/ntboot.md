title: "[分享] Windows NT 系列通用启动盘[204-08-31]"
id: 117
date: 2012-02-13 10:40:00
tags: 
- GRUB4DOS
- ntboot
- 原创
categories: 
- 系统相关
---


## 【说明】

* 本启动盘可以用于直接启动硬盘上的NT系统.可以从任意地方加载这个镜像文件进行启动。
* 可以通过本镜像启动硬盘上的Windows系统,不依赖硬盘上的系统引导文件.
* 也可以用于U盘或光盘启动时,直接启动硬盘上的其它系统.
* 一盘在手,启动无优.

<!--more-->

### 支持的系统32位/64位

*  Windows 2000
*  Windows xp
*  Windows 2003
*  Windows Vista
*  Windows 7
*  Windows 2008
*  ram xp IMG镜像
*  VHD WIN7/2008(不需要硬盘上的启动文件,只需要一个VHD文件)
*  WIM PE3.0(同上,只需要一个PE的WIM镜像文件即可)
*  PE1.X（只需要一个内核的镜像文件像WINPE.IMG/WINPE.IM_/WINPE.ISO/WINPE.IS_之类的）
*  新增支持直接使用ISO来安装系统（支持FIRADISK/WINVBLK/VBOOT三种驱动方式）
*  新增支持WIM格式的 PE1.X

### 支持的系统目录`WINNT`和`WINDOWS`.新版已更新，支持任意目录

### 当硬盘上的系统启动文件丢失或损坏时，可以直接使用本启动盘来启动系统应急。


## 【使用方法】

* 直接刻到光盘上启动（新版）。
* 使用GRUB4DOS或syslinux等工具调用启动。
	```
	title ntboot
	map --mem /ntboot.iso (0xff)
	map --hook
	chainloader (0xff)</span>
	```

### [其它用途]

删除并备份自己电脑上的引导文件,使之不能引导,这样别人就不能使用你的电脑了.

自己要用时直接使用U盘或其它启动工具启动该镜像进行启动.


### [其它说明]

欢迎有兴趣的朋友一起研究,讨论.
无忧启动论坛专贴: [http://bbs.wuyou.com/viewthread.php?tid=190203](http://bbs.wuyou.com/viewthread.php?tid=190203)

###【截图&介绍】

* 帮助信息(见后面详细介绍)  
  ![]([CDN_URL]:/post/ntboot_help.png)
  1.  NT5|NT6=root|file 
      启动`NT5`或`NT6`系统.可以指定系统分区`root`,如果没有指定则自动查找.  
      `file` 指定一个文件来启动.  
      `NT5`可以指定一个IMG文件(使用NTLDR调用这个IMG镜像启动)  
      `NT6`可以指定一个WIM文件或VHD文件.直接从这个文件启动.  
  2. PE1=file [PDIR=pdir] [OPTIONS=options]  
       启动`PE1.X`系统,`PDIR`参数替换默认的系统`WXPE`目录(原版的PE是`I386`)  
       `OPTIONS`指定其它要附加的参数.**注意参数中的"/"要换成"#"**

  3. VBOOT=file [options...]  
	  调用VBOOT来启动系统,file指定要启动的文件VHD/VMDK之类的.

  4. ISO_INST  
	  使用硬盘上的ISO文件来安装系统.支持`firadisk`/`vboot`/`winvblk`三种驱动.

  5. 如果你的内存足够大则在安装系统时可以使用@cdrom代替cdrom,这时会把镜像加载到内存,默认是直接映射,加载到内存安装的速度会比较快.  
      若是使用#cdrom可以把镜像加载到高位内存。一些参数用法可以看NTBOOT.LST里面的菜单演示.
  6. 启动菜单演示
      ![]([CDN_URL]:/post/ntboot_menu.png)
* 合盘调用方法
  1. 直接把NTBOOT整个目录放到某个位置,比如放到BOOT目录下.
  2. 在你的菜单中直接调用NTBOOT例子:  
	```
	title 启动硬盘上的WIN7PE
	/BOOT/NTBOOT/NTBOOT nt6=/boot/imgs/win7pe.wim
	boot
	```
  3. 注必须使用全路径,像上面的样子或带盘符的路径如*(cd)/BOOT/NTBOOT/NTBOOT ...*  
  4. 为了方便你可以在使用NTBOOT之前执行一次NTBOOT设置一个参数NTBOOT,或下面的命令
	```
    /BOOT/NTBOOT/NTBOOT eof
	```
	执行之后会设置一个变量NTBOOT以后就可以直接使用%NTBOOT%来调用比如用下面的命令启动硬盘上/boot/win7/win7.vhd中的系统.
	```
	%NTBOOT% nt6=/boot/win7/win7.vhd
	```
	注:请使用2011-04以后的GRUB4DOS来调用.

  5. 有什么不解的地方或建议可以直接留言或上无忧启动论坛进行讨论.
 
* PE1 可以启动CD,FD,HD上面的文件,默认情况下只会查找硬盘,指定完整路径参数时就可以使用CD,FD上的文件了.比如在光盘上使用时可以直接使用NTBOOT来启动光盘上的PE,路径直接使用*()/path/file*即可.
* 关于 [options...]
	这个目前支持的参数例表如下:
	* cdrom=iso_file         指定虚拟光驱的ISO文件
	* harddisk=hdd_img   指定虚拟磁盘的镜像文件
	* floppy=fdd_img       指定要加载的软盘镜像（自动加载到fd0）
	* boot=cdrom|harddisk|floppy 指定从什么地方启动。  
	其中：cdrom固定是(0xff),harddisk固定是(hd0),floppy固定是(fd0).
	     opt="other options"  其它要附加的参数。 
	比如：
	使VBOOT在启动的时候暂停。
    ```
	/BOOT/NTBOOT/NTBOOT vboot=/vboot/winxp/winxp-s1.vhd opt="pause"  
	```
	以下例子，将会调用VBOOT的自动还原模式。
	```
	/BOOT/NTBOOT/NTBOOT vboot=/vboot/winxp/winxp-s1.vhd opt="immutable"
	```
	关于VBOOT的参数，请参阅VBOOT的使用说明。

*  2011-09-27 新增addons=cmd参数(PE1和ISO_INST)  
   addons=cmd  运行一个指定的命令

###【下载地址】

[NTBOOT-2014-08-31](http://c-dl.qiniudn.com/dl/NTBOOT.rar)

最新版请关注我的GRUB4DOS硬盘工具箱.将会随工具箱一起更新.

{% iLink source:_posts/g4d_hd_tools.md %}

### 【部份更新历史】

#### 2014-08-31
* 支持VHDX
* 支持WIN8
* 支持GPT分区(NT6)
* 新增参数NTLDR可以指定启动文件

    ntboot nt6=/test.vhd NTLDR=(hd0,4)/boot/bootmgr

#### 2011-12-14
* 使用新的GRUB4DOS。
* 自动检测支持的系统。（菜单1）

#### 2011-10-11
* 重新设计模块化文件。
* 启动WINDOWS 7时可以正常显示启动画面

#### 2011-09-27
新增addons参数

例子:  
用于系统安装.
```
ntboot iso_inst=firadisk cdrom=/winxp.iso addons="dpms 0"
```
说明: 自动调用dpms命令(在NTBOOT.MOD目录下),当然了也可以是其它命令比如:
```
ntboot iso_inst=firadisk cdrom=/winxp.iso addons="/boot/addons/dpms/dpms.bat 0"
```

用于pe1的例子:

```
ntboot pe1=/boot/addons/tangope/tangope.is_ addons="dpms"
```
