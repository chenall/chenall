title: "[GRUB4DOS] 外部命令FAT（在FAT分区上复制创建文件）"
id: 124
date: 2010-01-29 20:23:05
tags: 
- fat
- GRUB
- GRUB4DOS
- 外部命令
categories: 
- GRUB4DOS/扩展
---


## [使用方法]

下载后解压得到FAT文件复制到[GRUB4DOS]启动盘的/BOOT/GRUB目录下。

或直接使用全路径比如这个文件放在(hd0,1)/boot目录下。

则(hd0,1)/boot/fat xxxx

## [命令参数]

![]([CDN_URL]:/upload/2010/01/fat_help.png)


FAT命令的目标对象必须是FAT12/16/32分区的目录和文件,目前只支持8.3格式

1.  FAT mkdir <directory>

    创建一个目录，只能一级一级建立目录，不可以同时建立多级目录；

    例子：FAT mkdir (hd1,0)/SRS

2.  FAT copy [/o] <source file> <Destination file>

    从源文件拷贝到目标文件，/o  参数用于覆盖操作。

    来源文件可以是任意GRUB4DOS可以访问的路径；

    目标文件必须是FAT分区;并且目标目录必须存在否则会提示错误；

    如果不指定目标文件名，自动使用源文件名；

    例子: fat copy (hd0,0)/file.ext (hd1,0)/file.ext
 
3.  FAT ren <file/directory> <new>

    文件或目录更名/移动

    例子：

    1、修改当前ROOT分区下的abc.txt文件为abc.ini

    fat ren /abc.txt abc.ini

    2、移动文件，把abc.txt移到test目录下（test目录必须已经存在）

    fat ren /abc.txt /test/abc.txt
   
4.  FAT del <file/directory>

    删除文件或目录（只能删除空目录同DOS）

    例子：
    删除一个文件
    fat del /abc.txt

    删除一个目录同删除文件一样，但要求这个目录是空目录，你必须先删除这个目录下的文件才能删除这个目录
 
    注意：不要删除根目录

5.  FAT mkfile size=SIZE|* file

    创建新文件

    SIZE是文件大小，可以直接用*代替，大小等于上一个cat --length=0命令的结果。

    注:`cat --length=0 file`命令在`GRUB4DOS`中用于获取指定文件的大小。

6.  FAT mkfs [/A:unit-size] <drive>

    格式化磁盘
 
7.  FAT dir [/a*] <PATH>

    列出路径下所有文件及目录。

    dir加了按属性显示的参数（同DOS的dir)

    d 目录

    s 系统属性

    r 只性属性

    h 隐藏属性

    \- 表示`否`的前辍

    例子：

    dir /ad #只显示目录

    dir /as #只显示有带系统属性的文件或目录

    dir /ads #只显示带系统属性的目录

    dir /a-d #不显示目录。


* 2012-03-15

  新的版本介绍。

* 2010-02-09

  1. BUG修正,修改文件复制方式,加快复制的速度.

  2. 修正当内存低于128MB时不能正常使用的问题.

* 2010-02-05

  1. 修正写文件分配表的BUG(会导致文件读取失败).

* 2010-01-30

  1.  修正FAT dir命令显示的问题。

  2.  添加了一些帮助信息。fat 或 fat help都可以显示帮助信息。

  3.  优化的创建文件分配表的代码。

* 2010-01-29

  1. 支持FAT32。

* 2010-01-13

  修正一个可用簇数计算方法的错误，导致写FAT表错误。

* 2010-01-12

  预览版。

## [下载地址]

源码和程序下载:

[http://code.google.com/p/grubutils/](http://code.google.com/p/grubutils)

[GRUB4DOS]: http://chenall.cn:82/categories/GRUB4DOS/
