title: "[分享] 自己动手，在WINDOWS系统中搭建GRUB4DOS编译环境[2013-02-03]"
id: 804
date: 2012-01-19 08:00:35
tags: 
- colinux
- debian
- GRUB4DOS
categories: 
- 程序设计/综合
- GRUB4DOS/实用
---

因为经常使用WINDOWS系统，为了方便直接在WINDOWS下搭建。

使用Colinux可以很方便的在WINDOWS中运行一直真实的Linux环境。

好了，废话不多说了，直接开始了。如果想偷懒的话，有提供了可以直接使用的成品下载。

说明: __内容比较乱,只是记录一下整这个的过程(从文件大小也从最初的几个G到整最后的`50MB`,偷懒的直接下载最新版本就行了,想自己折腾的可以继续看下去(按日期顺序从后往前看)__

===========2013-03-02=============

由于gcc4.7编译出来的和版本启动memtest86有问题,
gcc换成4.8版.
git 换成1.6版.
下载地址1:  [grub4dos_dev-gcc-4.8](http://code.google.com/p/grub4dos-chenall/downloads/detail?name=grub4dos_dev_2013-02-03.zip)

===========2013-01-14=============
更新了一下,使用最新的tinycolinux内核 4.7.3
svn 1.7.5
git 1.8.0
gcc 4.7.2

下载地址1:  [grub4dos_dev](http://code.google.com/p/grub4dos-chenall/downloads/detail?name=grub4dos_dev_2013-01-14.zip)
MD5: F41AF644B3DA6C133A35C45278047C24
===========2012-02-27 ====================
今天roy修正了gcc4.6下编译的问题 ，重新做了一个gcc4.6的版本。
linux核心tinycore4.3
gcc4.6+git1.6+svn1.6+7z+grub4dos-dev
[Colinux_TinyCoreLinux_grub4dos_dev.7z](http://www.ctdisk.com/file/4946481)
MD5: FA11D60B45FEF4282DD9E0B640F39CF0

## ===========2012-02-13 ====================

With the new version, you only need three steps to get started.
(1) Download file [Colinux_tinyslat_grub4dos_Dev.7z](http://www.ctdisk.com/file/4551969)
(2) use 7-ZIP  extract to the location you want to install.
(3) after decompression files run quick start.cmd in TinyDev directory

Node: /mnt/cofs ----> e:\colinux

1. Default cofs directory is e:\colinux so you must create this directory first for use cofs.

   To use a different location you can modifying the file TinyDev\tinyslat\tinyslat.ini and then restart `quick start.cmd`

2. You can add a virtual disk for colinux use below steps
  ```
  ::create new file sda_1g.fs with 1Gb

  fsutil file createnew sda_1g.fs 1073741824

  modify tinyslat.ini file add line

  sda=tinyslat\sda_1g.fs

  and change home=ram0 to home=sda
  ```

  Restart Colinux and enter

    mke2fs -j /dev/sda

  Restart Colinux again

  Now
    /mnt/sda --> sda_1g.fs

==================2012-02-07==================
结合Tinycore和slatiz优点的版本。使用了tinycore的核心+slatiz软件包管理器。相对完美版本，有以下优点

*   小巧（解开后才70MB不到，使用MSYS/CYGWIN等至少也得100MB以上吧）。
*   方便，移动性，直接解压到电脑上就可以运行了（不要放在中文目录下）。
*   默认开启多终端支持（可以按Alt+Fn切换）。
*   可以自由添加安装软件（基于tinycore的软件包可自动保存）。使用slatiz的软件包目前不能保存。但是有提供了一个工具可以把tazpkg转为tcz。
*   可选保存用户配置（默认不保存）
*   自带的软件包gcc 4.5+svn1.6+git1.7+7z+……。总之下载后就可以直接编译GRUB4DOS相关程序。当然了也可以作为一个桌面linux来使用。

使用方法：

只要三步就可以开始启动 下载－〉解压->执行。
  下载 
  2012-02-08更新cofs权限问题
  2012-02-09因为git新的版本不可以在COFS上用git下载源码,所以GIT换成1.6版.
  [Colinux_tinyslat_grub4dos_Dev.7z](http://www.ctdisk.com/file/4551969)
  增加软件方法：
  1. tinycore方案（推荐）
       tce-load -wi packname
       默认使用了163的镜像，可以通过修改opt目录下的tcemirror文件改成使用其它镜像。
  2. slatiz方案（备用）
       tczpkg get-install packname
       这个只是作为备用。下载安装的软件不会被保存。
  3. slatiz方案+tinycore
  为了解决有时tinycore的软件源没有提供相应软件，而slatiz有提供时，可以使用该方法。
  首先通过taz2tcz下载slatiz软件并转换为tcz格式。
  taz2tcz packname
  软件安装
  tce-load -i packname
  注意：
 
    1. 你需要自己处理软件包的依赖关系（depends），可以使用tazpkg depends packname 查看。然后依次下载并转换所有包。
    2. 执行tce-load 时请注意查看上一步最终的软件包名。比如以下是下载xz程序的输出,注意看我们要安装的是xz，最终的名字是xz-4.999.9beta

    ```
    tc@box:~$ taz2tcz xz
    xz-4.999.9beta
    Connecting to mirror.slitaz.org (94.23.209.91:80)
    xz-4.999.9beta.tazpk 100% |*******************************| 21096   0:00:00 ETA
    tazpkg(slatiz) to tcz (tinycorelinux) packages convert by chenall
    Please wait....
    42 blocks
    91 blocks
    xz-4.999.9beta converted. you can type tce-load -i xz-4.999.9beta to install.
    tc@box:~$ tce-load -i xz-4.999.9beta
    /etc/sysconfig/tcedir/optional/xz-4.999.9beta.tcz: OK
    ```
 
==================2012-02-05==================
因为目前用GCC4.6编译出来的GRLDR无法启动，所以重新整了一个GCC4.4的。

相关下载：

Colinux 主程序 ：[colinux_mini.7z](http://www.ctdisk.com/file/4499842)

系统镜像包： [tinycore_colinux_60M_GCC4.4.7z](http://www.ctdisk.com/file/4499927)

## ==================2012-02-04==================

整合了02-03版tinycore的两个版本优点，完善了一下。新的版本有以下优点

*   占用空间小。
*   需要的内存也小。
*   配置灵活，可以选择保存数据。

   目前提供了以下配置文件

1.  tinydev.ini  相当于之前的60M版本，不保存数据。
2.  tinydev_tce_cofs.ini  用户数据保存到tinycore.gz同目录的home目录下使用该配置文件需要先把grubdev.iso解开到同目录下。把配置文件名改为tinydev.ini 之后再启动，会自动建立HOME目录。需要的文件列表如下：tce 目录

    tinycore.gz 文件

    tinydev.ini 配置文件

    启动之后可以使用tce-load命令下载新的软件并且可以保存。如果你对tinycore比较了解，直接添加软件到TCE目录就行了。
下载地址： tinycore_colinux_60M.7z

==================2012-02-03==================

之前的版本使用了比较完整的Linux来搭建，占用空间比较大，我用[tinycorelinux](http://distro.ibiblio.org)重新定制了一个比较小巧的版本，有兴趣的可以下载试用

使用方法：

1. 先下载Colinux主程序和系统包。

2. 在E:新建一个Colinux目录，用于和Linux共享，或方便存放文件。

3. Colinux解压到非中文目录下，系统包直接解压到Colinux目录中。

4. 使用Colinux目录下的“快速启动.cmd”来直接启动。

5. 你也可以安装为服务使用“安装服务.cmd”就行了。

# 相关文件下载：

1.  Colinux 主程序  [colinux_mini](http://code.google.com/p/grubutils/downloads/detail?name=colinux_mini.7z&amp;can=1&amp;q=)直接解压到非中文的目录即可使用
2.  定制好的系统包（选择其中一个就行了），解压到Colinux安装目录下。1.最小巧只需要60MB空间，缺点：不可保存用户配置完全在内存中运行。tinycore_colinux_dev.7z2.中等，需要160MB，缺点：占用空间比较大，但是可以保存用户配置。

    tinycore_colinux_fs.7z

    3.之前的版本重新打包的文件需要2G+128MB空间

    [Debian_colinux.7](http://code.google.com/p/grubutils/downloads/detail?name=Debian_colinux.7z&amp;can=1&amp;q=)

    基于tinycore的两个版本所安装的程序都是一样的包含以下主要和相关联的程序。

    GCC 4.6 + GIT + SVN

    区别是，一个是RAM版本，一个非RAM版本。

    建议使用非RAM版本，这样可以保存你的配置文件。默认的COFS目录是E:\COLINUX，你需要先在WINDOWS中建立以上目录。然后就开始操作了

   在linux中使用以下命令就可以编译一个GRUB4DOS
  ```
   cd /mnt/cofs

  svn co http://grub4dos-chenall.googlecode.com/svn/trunk grub4dos-src

  cd grub4dos-src

  make
  ```

  如果你习惯用git也可以用git来下载源码
  ``
  git clone git://github.com/chenall/GRUB4DOS.git
  cd GRUB4DOS
  make
  ```
其它说明：tinycore默认是超级用户，可以用exit命令退出。用sudo su进入超级用户模式。要增加软件可以使用tce-load命令比如以下命令就可以下载并安装xterm

tce-load -wi xterm

另外已经重定向X的显示到主机。只要主机有安装X SERVER在LINUX下启动X程序就会在主机上显示。

## 2012-01-19

首先要准备的文件列表

以下软件都在这里[http://sourceforge.net/projects/colinux/files/](http://sourceforge.net/projects/colinux/files/) 可以自己选择其它版本下载

1.  Colinux我选用最新的版本  [devel-coLinux-20110807.exe](http://sourceforge.net/projects/colinux/files/Snapshots/devel-20110807-Snapshot/devel-coLinux-20110807.exe/download)
2.  用于colinux的linux镜像     [Debian-6.0.1-squeeze](http://sourceforge.net/projects/colinux/files/Images%202.6.x%20Debian/Debian%206.0%20Squeeze/Debian-6.0.1-squeeze.7z/download)
安装Colinux，直接默认安装就行了。

安装完之后，解压Debian-6.0.1的压缩包到Colinux安装目录下。会多出几个文件。

直接运行解压出来的squeeze.bat就可以启动一个debian了。

启动后直接输入用户名root登录

wee需要在gcc 4.5的环境中编译，否则生成的文件太大超过了32KB。如果你不需要编译wee可以略过以下内容。

目前debian的gcc 4.5软件包需要用测试版才能直接安装。所以需要修改软件源，增加一个测试版的源。

============分隔线，增加debian软件源开始======================

修改源列表文件

vi /etc/apt/sources.list

看看里面有没有包含 testing的行，如果有就不用改了。

像这个只有一行

deb [http://ftp.debian.org/debian](http://ftp.debian.org/debian) squeeze main

要增加一个testing的源。

懂得VI的可以略过以下内容.开始修改。

首先复制当前行（直输入'yy'即连按两次'y'）

然后直接粘贴（直接按'p'键）现在有两行了

修改其中一行的"squeeze"为"testing"（光标移到's'处输入'dw'，再按'I'输入"testing "。)

最终就是

deb [http://ftp.debian.org/debian](http://ftp.debian.org/debian) squeeze main

deb [http://ftp.debian.org/debian](http://ftp.debian.org/debian) testing main

保存并退出（先按一下"Esc"键再输入":x"回车即可）

好了现在更新一下源信息。

apt-get update

============分隔线，增加debian软件源完成======================

安装GRUB4DOS编译需要的软件包。

注：如果不需要编译wee可以安装gcc-4.3或gcc-4.4会比较稳定。

apt-get install gcc-4.5 autoconf automake make patch git subversion

注：git和subversion是源码管理工具，用于下载源码的，可以安装其中一个就行了。

所有的提示直接按'Y'或回车确认。坐着泡一杯茶再过来，差不多装好了。

如果网络环境很给力的话，几分钟就行了。否则可能得等上半个小时吧。

电脑：俺正在努力下载安装软件，没空陪你了，你自己玩去吧。

...............................................

半个小时后。

好像差不多了。。继续工作。

等等，还少了压缩软件，如果你只是玩玩，不要也罢。

apt-get install p7zip-full zip

现在已经万事具备，只欠东风了。

只要下载源码然后就可以编译了。新手请最好看完后面内容再下载编译测试。

下载源码方法:

svn co [http://grub4dos-chenall.googlecode.com/svn/trunk](http://grub4dos-chenall.googlecode.com/svn/trunk) grub4dos-src

或

git clone git://github.com/chenall/grub4dos.git grub4dos-src

编译：

cd grub4dos-src

make

如果你对linux的操作不熟悉，你可以在WINDOWS中修改源码，改完之后再进入LINUX去编译。

colinux支持cofs文件系统，可以和WINDOWS进行文件夹共享。

添加cofs文件系统方法.

在d:新建一个文件夹名字就叫做cofs,用记事本打开squeeze.conf

添加一行

cofs0=d:\cofs

先关闭linux，输入halt就行了。

再次双击squeeze.bat启动debian，登录

输入以下命令挂载cofs

mkdir /mnt/cofs

mount -t cofs cofs0 /mnt/cofs

cd /mnt/cofs

mkdir test

要让它启动时自动挂载可以添加一行内容到/etc/fstab文件中

/dev/cofs0 /mnt/cofs cofs

直接用echo添加就行了，也可以用VI修改

echo /dev/cofs0 /mnt/cofs cofs >> /etc/fstab

如果电脑d:\cofs目录下有生成一个test文件夹，则证明成功挂载

cd /mnt/cofs

svn co [http://grub4dos-chenall.googlecode.com/svn/trunk](http://grub4dos-chenall.googlecode.com/svn/trunk) grub4dos-src

cd grub4dos-src

make

以后你就可以在WINDOWS中打开d:\cofs这个目录，修改里面的源码，然后再到linux里面去编译就行了。

懒人可以直接下载绿色包，解压后就可以直接使用。

[grub4dos_colinux_debian.7z](http://grubutils.googlecode.com/files/grub4dos_colinux_debian.7z)