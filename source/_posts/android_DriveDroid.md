title: "DriveDroid 让安卓手机变成系统启动盘"
id: 2014101821
date: 2014-10-18 21:06
tags: 
- android
- 软件
categories:
- 实用文集
---

## 说明

  **This application requires root**(需要手机有Root权限)

  DriveDroid allows you to boot your PC from ISO/IMG files stored on your phone. This is ideal for trying Linux distributions or always having a rescue-system on the go... without the need to burn different CDs or USB pendrives.

  DriveDroid also includes a convenient download menu where you can download USB-images of a number of operating systems from your phone (like Mint, Ubuntu, Fedora, OpenSUSE and Arch Linux). Around 35 different systems are available at this moment.
  
  You can also create blank USB-images which allows you to have a blank USB-drive. From your PC you can store files onto the USB-drive, but also use tools on your PC to write images to the drive.
<!--more-->
### Notes
* This application uses features of the kernel that may or may not be available/stable on your phone. Tests have shown most phones work without problems, but please keep in mind yours might not (yet) work out-of-the-box.
* Most kernels support emulating USB drives, some support emulating CD-rom drives and kernels with the right patches support both.
* Most Linux-related ISOs can be booted from USB drives, but some ISOs can only be booted from CD-rom drives or require some kind of conversion.

### Paid version
* No ads.
* Resizing of images.
* Add your own download repositories. Nice for companies or groups that want to share custom or licensed images.

More info: http://softwarebakery.com/projects/drivedroid

以上是原文介绍,看不懂没有关系,简单来说,就是可以让Root的Android设备可以直接加载ISO/IMG等文件直接变身为一个启动盘(可以变成U盘/光盘/软盘),系统安装盘,等,也就是说一个手机加上一条数据线就可作为随身或应急维护U盘了.

## 使用简介

### 主界面截图

![](@@POST@@:01.png)

### 首次使用

  请先使用向导,根据界面提示获取ROOT权限,插入USB数据线
<table><tr><td>![](@@POST@@:001.png)</td><td>![](@@POST@@:002.png)</td></tr></table>

### 其它截图介绍

  可以直接创建一个空白的IMG文件(虚拟U盘),挂载这个镜像文件之后,连上电脑之后就可以看到一个"空白的U盘",你想怎么折腾就怎么折腾吧..

![](@@POST@@:02.png)

点击`+`号出现如上菜单,第一个是创建空白镜像,第二个,从镜像库下载,第三个,从系统中加载已经做好的镜像.

软件还内置了一个镜像库,提供一些可以启动的镜像(比如Linux系统发行版)等,直接下载就可以使用了.

![](@@POST@@:03.png)

除了可以挂载IMG/ISO文件之后,还可以挂载整个SD卡/某个SD卡分区,系统分区的哦..看截图(要挂载这些需要对ANDROID/linux系统有一定的了解)

![](@@POST@@:04.png)

本人的手机对这个支持的效果挺不错的，可以有三个LUN，可以同时支持软盘、光盘、U盘。效果图，lun0虚拟出一个软盘，lun1是光盘，lun2是可移动磁盘

![](@@POST@@:05.png)

注意看上图,左边有三个点,代表该设备支持三个LUN,你可以在每个LUN上都测试挂载一下 光盘,软盘等镜像,看看电脑上能不能正确显示出挂载内容,这样就可以知道是否有支持虚拟光盘,软盘了.

![](@@POST@@:06.png)

挂载之后卸载的方法见图示,通过状态栏可以方便卸载某个虚拟设备

![](@@POST@@:07.png)

### 挂载系统设备方法

  也可以直接使用该软件挂载系统设备比如系统的DATA分区/SYSTEM分区等.如上面的截图里面的设备,对Linux系统比较了解的朋友应该就懂得.在Android中每个设备在`/dev`目录中都有一个对应的设备文件名,比如SD卡(在很多ANDROID设备中使用`/dev/block/vold/179:27`),那我们是否可以在`DriveDroid`中直接加载该文件来实现挂载直接SD卡设备呢?答案是可行的,不过因为系统的限制你并不能直接在软件中的直接选择添加,需要手工填写文件名称才行.

  首先是要找到你想要添加的设备的文件名,一般情况下通过`mount`命令就可以看到对应设备的挂载点.*可以在`adb shell`或android终端软件中输入*如下图

  ![](@@POST@@:08.png)

  注意看上面红色框的内容,本手机`179:27`是`sdcard0`(内置sd卡),`179:65`是`sdcard1`(外置SD卡)

  好了找到了对应的设备文件名,现在就可以开始添加了.点软件右下角的`+`号,选择**Add image from file...**开始添加,出现如下图界面,输入对应的信息然后点右上角的**SAVE**保存就行了.

  ![](@@POST@@:09.png)

  具体效果可以看前面的介绍截图,另外挂载这设设备时,为了避免出现问题,最好使用只读挂载(Read Only),比如你可以只读挂载一下`SYSTEM`分区,然后在`Windows`下就可以备份这个分区的内容.

  附: 更多可挂载的设备.

  ![](@@POST@@:10.png)
  
  注: 除了使用`/dev/block/vold/179:27`之外也可以使用`/dev/block/mmcblk0p27`两个是一样的,具体可以看上面的图片

  1. `mmcblk0`   是系统内置的储存设备使用时需要小心,`mmcblk1`一般是外置的tf卡设备.
  2. `mmcblkXpY` 对应**X**储存的**Y**分区,比如`mmcblk1p1`就是外置tf卡的第一个分区

### 后记

   发现很多朋友认为使用软件会影响读写速度,如果你了解这个软件的原理就明白了,无非就是修改了android的默认宿主usb挂载点.

   比如系统自带的U盘模式其实效果和用这个软件挂载整个SD卡是一样的.

   用ISO之类的文件的话因为需要多一层读写,效率会低一点,但影响不是很大,关建是用ISO/IMG文件使用起来更方便.我觉得使用一点点的效率去换取这些更方便功能是值得的.

   在没有发现这个软件之前,我通过手工修改Android的默认的usb挂载点来实现这些功能,使用软件需要使用工具就加载什么,还可以使用只读模式,防病毒最有效的就是只读模式了,很方便不是吗?

从Google Play 下载安装:(https://play.google.com/store/apps/details?id=com.softwarebakery.drivedroid&feature=nav_result)

百度网盘下载： [com.softwarebakery.drivedroid.ver.0.9.15.build.46.apk](http://pan.baidu.com/s/1qWluroS)