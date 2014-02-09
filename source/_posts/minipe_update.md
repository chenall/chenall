title: "[原创] 无限扩展,多功能PE_更新与下载(2009-05-01)最终版"
id: 49
date: 2009-03-26 23:22:45
tags: 
- GRUB4DOS
- MINIPE
- SCSI
- WXPE
- 外置
- 原创
categories: 
- 系统相关
---

可以点击链接直接下载，或者进入网络硬盘下载。共享密码是:chenall

[外置驱动使用说明.txt](http://d.chenall.net/upload/2009/1/外置驱动说明.txt)

[请先读我.txt](http://d.chenall.net/upload/2009/1/请先读我.txt)

[更新历史.txt](http://d.chenall.net/upload/2009/1/更新历史.txt)

2009-05-01 修正版ISO下载[2009-05-03]

[http://chenall.liondrive.com/MicroPE/MicroPE.rar?action=download/download](http://chenall.liondrive.com/MicroPE/MicroPE.rar?action=download/download)

如果没有看到请

2009-05-01成品ISO下载测试

[http://dl.getdropbox.com/u/835279/MicroPE.ISO](http://dl.getdropbox.com/u/835279/MicroPE.ISO)


基本上不会再更新,除非有重大问题.

目前自用,一般也就更新一下驱动或解决一些小BUG,优化之类的.

目前本PE已经传到了我的live mesh网盘,和我的电脑上进行同步.如果有使用live mesh并且需要得到最新版的PE的朋友可以留下live id.

我将把这个共享给你,就可以同步更新了.关于live mesh的资料请上网查找.

### 2014-01-21 注: 本PE已经早就不更新了,本文只保留作为研究的记录.

### __类似的PE推荐使用 [pseudo](http://bbs.wuyou.com/viewpro.php?uid=195661)的[0PE](http://bbs.wuyou.com/forum.php?mod=forumdisplay&fid=82)__

### 本PE特色:

1. 首创支持直接使用ISO启动,而且不影响任何功能. 使用ISO启动可以自动找到ISO里面的外置程序
   需求: 启动ISO文件必须为 /BOOT/MICROPE.ISO
2. 首创支持外置硬盘控制器(S&R&S)驱动.遇到新的主板进入PE后没有找到硬盘可以方便的添加驱动而不需要重新修改启动镜像内容.
3. 首创支持多重启动,任意启动,想怎么启动都可以.启动加载的IMG只有15MB.
4. 启动核心最小并且保持功能完整.启动后如果缺什么功能都可以通过外置程序来添加.
5. 首创支持iSCSI启动,也是首个支持iSCSI客户端连接的XP PE
6. 首创充许把核心IMG里面的文件直接解开放在U盘或硬盘上进行启动.(不建议使用)
7. 外置程序模块化,傻瓜化添加,基本上只需复制粘贴就可以了.
8. 本地/光盘/iSCSI/网络PXE等,随意启动.


2009-01-19 ,具体请看更新历史.txt

PE090115出现失误,请自行修改[PE定制]目录下的批处理把以下语句后面的Micrope.lst改为menu.lst
```
grubmenu.exe import boot\grldr boot\MicroPE.lst
```

2009-01-16

不再整个ISO文件上传,使用了可定制的方式上传所有需要的文件,加了一些说明.

可根据需要自己生成ISO文件.

其它请查看更新历史页面.

下载地址:

[http://www.brsbox.com/chenall](http://www.brsbox.com/chenall)

PE090115.rar

这个版本已经支持ISCSI启动,只要手工内置SYSTEM.WIM和NET.WIM就可以了.

SYSTEM.WIM内置到WXPE\\SYSTEM\\SYSTEM.WIM

NET.WIM内置到WXPE\\NET\\NET.WIM.

说明书尚未添加ISCSI启动的资料,.有关ISCSI启动请查看无忧论坛相关贴子.

2009-01-08.

细微调整,整个ISO文件上传146MB.

[MicroPE.iso]

注意:

1. 如果要解开ISO请使用IsoBuster否则解开的文件不完整.

2. 硬盘控制器驱动直接使用了[pseudo](http://bbs.wuyou.com/viewpro.php?uid=195661) 的OPE 1230版本的驱动.

3. 因为我是维护用的,内置RADMIN服务端,启动网络后会自动运行.方便进行远程控制.

4. 此版核心支持ISCSI启动,


方法,把NET.WIM和SYSTEM.WIM内置到WINPE.IMG里面即可.

目录限制.内置NET.WIM放在WXPE\\NET目录下.SYSTEM.WIM放在WXPE\\SYSTEM目录下.否则无效.

然后在WINPE.IMG根目录下新建一个文件夹DRIVERS里面放网卡驱动.

2008-12-03.

由于我没有使用光盘测试而是直接用硬盘启动,所以一直没有发现一个问题.今天用光盘启动才发现.

当使用光盘启动时,驱动目录的设置可能会出错,造成驱动安装失败.

解决方法:

修改MINIPE\\AUTORUN.INF文件

把以下语句修改一下即可.

ENVI $Drivers=%curdrv%\\minipe\\Drivers

改成如下.

ENVI $Drivers=%curdir%\\Drivers

说明:虽然两句要表达的意思是一样的,但是用后面那一句通用性比较高..

因为%curdrv%无法识别\\\\?\\cdrom0,所以失败.

2008-11-24.

1. 添加了最新版的PECMD.EXE．　
2. 更新了UNIATA驱动到最新版．
3. 更新了启动文件GRLDR到最新版（调整了启动菜单MENU.LST）
3. 内置了EXFAT文件系统驱动．

还有一些细微修改，其中某些文件参考了[pseudo](http://bbs.wuyou.com/space.php?uid=195661) 

[【无忧首发】零体积全能可扩展PE(软盘装得下的PE，11.01)](http://bbs.wuyou.com/viewthread.php?tid=104242)的版本进行修改．

2008-05-14

1.新版[SCSI.IMG](/blog/getfile.asp?did=1&fid=1381864)测试 带完整驱动。从根据以下贴子的资料整理

[[4月12日]基于毛桃PE的SATA、RAID驱动补充优化1.3修正版(新内核测试4+新问题)](http://bbs.wuyou.com/viewthread.php?tid=107172)

[[待测]Intel、SIS、VIA、ULI/ALI、AMD、ATI、NV南桥磁盘驱动BETA版[5月13日]](http://bbs.wuyou.com/viewthread.php?tid=122156)

2008-05-11

1.添加了极点中文输入法(带86五笔)精简版(用于PE).[@1#FreeIme_.WIM](/blog/getfile.asp?did=1&fid=1381812) 极点6.2CCF专版

2008-05-10

1.[磁盘分区表医生 PTDD](/blog/getfile.asp?did=1&fid=1381799) 使用了无忧[玄天](http://bbs.wuyou.com/space.php?uid=124412)发表的汉化破解版,

[http://bbs.wuyou.com/viewthread.php?tid=120397&page=77#pid1390729](http://bbs.wuyou.com/viewthread.php?tid=120397&page=77#pid1390729)

2.[PE定制包](/blog/getfile.asp?did=1&fid=1381798), 更新

GRLDR更新到05-07版,修改了HIDE.TXT内容(隐藏所有启动相关的文件,使得光盘上的文件在WINDOWS下看起来比较整洁)

修改了默认的菜单,

2008-05-05

1.[SCSI.IMG](/blog/getfile.asp?did=1&fid=1381670)测试,使用了新的检测方式.

2008-05-04 

1.[WINPE.IMG](/blog/getfil
e.asp?did=1&fid=1381648)更新,自动挂载支持自动运行（挂载时运行，方便作一些前期设定文件WIM里面的+AutoRun.cmd）

2008-04-30

1.网络[@net.wim](/blog/getfile.asp?did=1&fid=1381652)更新.

 1).支持启动网络后自动运行脚本(启动网络自动运行.cmd,可使用其它批处理或程序来生成,如果文件存在启动网络后会自动运行).

 2).连接后在通知区域显示图标 by pseudo ([http://bbs.wuyou.com/viewthread.php?tid=123874](http://bbs.wuyou.com/viewthread.php?tid=123874))

2.[haneWIN DHCP](/blog/getfile.asp?did=1&fid=1381653)升级到3.0.20版

3.[DiskGenius](/blog/getfile.asp?did=1&fid=1381630)更新为3.0.418 b2版

2008-04-15

外置更新

1.外置驱动SCSI.IMG更新,使用了新版的GRUB.EXE.修改了里面的一些驱动.

注：目前的SCSI.IMG加载驱动时，在有些主板上会检测不到。暂时先用着，下次更新将使用新的检测方法。

2.外置[SYSTEM.WIM](/blog/getfile.asp?did=1&fid=1381732)更新:修改了SYSTEM_.CMD批处理的语法错误.

2008-04-14

WINPE.IMG更新

1.替换了XP_TOOLS.WIM为新版.

2.修改了PELOGON.EXE的托盘菜单.直接使用以下贴子文件替换(另修改了热键按CTRL+ALT+A的刷新率为60,原文件没有改这个)

原贴:http://bbs.wuyou.com/viewthread.php?tid=121168&page=48#pid1373269

3.加入了VIA PCI潜伏期补丁

原贴:http://bbs.wuyou.com/viewthread.php?tid=122156&page=2#pid1358101

4.批处理Bug修正.

2008-03-24

1.修改了PE定制包里面的MENU.LST菜单,加上容错语句.由无忧yiyaxuan发现并解决问题

2008-03-21

1.替换了SCSI.IMG里面的GRUB.EXE为最新版,解决有些电脑启动失败的问题.

2.修改了MENU.LST启动菜单,使用1,2都支持外置的OEM_SCSI.IMG驱动.

3.把WINPE.IMG分别压缩成WINPE.IM_和WINPE.GZ两个文件.

2008-03-19

1.替换内置的RAMDISK为IMDISK.在使用复制SYSTEM.WIM到内存盘时,所需的时间更少

2.加了一个外置SCSI驱动工具(目录SCSI),使用方法内详

 功能:可以把某个SCSI驱动由TXTSETUP.OEM格式转为txtsetup.sif格式,并生成对应的驱动信息文件(可直接复制添加到SCSI.MAP中)

 注:此为方便添加外置SCSI驱动而作,生成的文件不保证完全可靠.完成后请自行检查.

2008-03-18

1.修改了WINPE.IMG,加入了免按F6自动加载S&R&S驱动的支持.

2.修改了启动菜单,使之支持以上方法的外置SCSI驱动(镜像路径为/OEM_SCSI.IMG,有存在的话就自动加载驱动)

用途:

 只需制作一个文件名为OEM_SCSI.IMG(可以用GZIP压缩),放到U盘或硬盘的根目录(只要GRUB4DOS可以找到的都可以)

 启动PE时就会自动加载这个里面的驱动. 驱动文件和传统的按F6加载的软盘的文件一样.

2008-03-17

1.为外置SCSI.IMG加入了ryvius提供的Intel 和 Nvidia 驱动(本人未测试)

 具体请看由无忧ryvius发表的贴子

 NVIDIA nForce SATA RAID/AHCI解决方案

 [http://bbs.wuyou.com/viewthread.php?tid=11273](http://bbs.wuyou.com/viewthread.php?tid=11273)

 Intel芯片组IDE、RAID/AHCI解决方案

 [http://bbs.wuyou.com/viewthread.php?tid=116417](http://bbs.wuyou.com/viewthread.php?tid=116417)

2008-03-16

*修改了小错误,还是谢谢pz的提醒

*根据pseudo提供的资料,在IMG里面加入PORTCLS.SYS文件,解决声音问题.顺便修改了一下XP资源利用.

*添加了一些注释,以方便他人YY.

*为了防止恶意修改启动脚本造成启动失败,在AUTORUNS_.CMD内加了简单的校验

修改了这个文件就会进不了PE,启动到CMD后就直接重启.

当然了懂得批处理的人要修改自然是很简单的(知道了也请不要张扬).

如非特殊需要,不建议修改WINPE.IMG的内容,一般来说都可以通过外置的方式来解决.

.不带其它外置,请自备.以后会提供专门的外置程序下载.

2008-03-14,更新

*.修改了GRUB启动菜单,只保留一个RAMDISK启动菜单,默认不显示菜单.5秒后自动使用自动检测SCSI驱动的菜单.

*.SCSI.IMG的GRUB菜单也有相应的修改,同时GRUB换上了新版的0314版. SYSTEM.WIM改了一下,强制开启FBWF和一些文本错误.

*.加入了之前外置工具,完整上传,需要的可下载测试,在将来一段时间内可能不会再更新了.

2008-03-13,更新

*.加入了XP资源利用的NV网卡补丁，由pseudo提供（无忧）

*.再修改了一个自启动的批处理，影响不大

2008-03-12,更新

*去掉RAMDISK的启动菜单,使用单IMG文件来启动.

*修改IMG的启动批处理,之前的版本还是不可以直接使用非RAMDISK来启动(有问题)

*修改SCSI.IMG,改正了一些可能出现的错误.

*不论如何强制开启FBWF

*IMG改为28MB,虚拟机测试80MB可进桌面(用WDSYS)

以下根据pz(无忧)的建议修改.

*修改了一些界面显示的文本错误,

*启动时自动关闭小键盘(方便本本用户).

*改了一些文本错误(无优==>无忧)谢谢qdaijchf(无忧)的提醒

发现我的错别字挺多的,呵呵一直都没有注意这些细节.以后还是仔细一点好.

08-03-11,修改

*修改默认菜单为第5条(自动加载适配的SCSI/RAID驱动)

*修改第5条菜单的内容，如果找不到SCSI.IMG就自动转到第4菜单执行

*修改SCSI.IMG的GRUB启动菜单，启动之前删除多余的映射防止启动蓝屏．

*修改IMG的Autoruns_.cmd批处理,使得适合使用非RAMDISK启动(之前的版本,如果直接用非RAMDISK启动会删除一些启动文件,下次就不能启动了.)

*注:若修改了IMG,这个IMG的卷标必须为MICROPE,否则启动时就不删除像TXTSETUP.SI?之类的文件.(原因同上).

若要使用非RAMDISK启动,则该磁盘磁标不能为MICROPE,否则启动一次后就不能再使用了(因为启动必须的文件会被删).



08-03-10,修改

新增菜单0

 功能:和第2个菜单一样,但是不加载无盘天使驱动(测试,因为有些加了会蓝屏)

 其它:该项不能使用下面的第二种方法来启动,因为没有带天使驱动.只是作为备用菜单

删除了DRIVERS目录下的一些文件(参考无忧uepon 20Mb的Vista美化PE).

相关贴子:http://bbs.wuyou.com/viewthread.php?tid=121708&extra=page%3D2
