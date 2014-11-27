title: "[grub4dos] grub4dos 最新版本initrdfs功能介绍"
date: 2014-11-27 08:14:58
id: 20141127
tags:
- GRUB4DOS
- initrdfs
categories:
- GRUB4DOS
description: grub4dos 最新版本initrdfs功能介绍,主要介绍多个程序整合成单个程序
---

在[最新版本grub4dos](http://grub4dos.chenall.net/downloads/grub4dos-0.4.6a-2014-11-26.cc7664c0/)中,支持读写`linux initramfs`,另外为了方便使用还支持了自定义的批处理续尾格式.这些在grub4dos被识别为`initrdfs`,都是在内存中使用的.

目前grub4dos initrdfs文件系统仅支持`cpio new`格式和grub4dos自定义格式,

批处理续尾格式支持整合多个批处理和一块非批处理的数据块.

 主批处理*[+批处理1][+批处理2][+批处理N][+数据块1]*

除了主批处理程序之后其它附加的内容都可以在主批处理中直接访问.访问方法 `%~m0/N` N是顺序号(注:当有附加了多个批处理时才可以这样子访问),详见后面更多介绍.

<!--more-->

以下摘抄一些资料

>## initrd与initramfs
>Linux 的 `initrd` 技术是一个非常普遍使用的机制，linux2.6 内核的 initrd 的文件格式由原来的文件系统镜像文件转变成了 cpio 格式，变化不仅反映在文件格式上， linux 内核对这两种格式的 initrd 的处理有着截然的不同。
>###initrd:
>ram disk是一个基于ram的块设备，因此它占据了一块固定的内存，而且事先要使用特定的工具比如mke2fs格式化，还需要一个文件系统驱动来读写其上的文件。
>如果这个disk上的空间没有用完，这些未用的内存就浪费掉了，并且这个disk的空间固定导致容量有限，要想装入更多的文件就需要重新格式化。
>由于Linux的块设备缓冲特性, ram disk上的数据被拷贝到page cache(对于文件数据)和dentry cache(对于目录项), 这个也导致内存浪费.
>###initramfs:
>最初的想法是Linus提出的: 把cache当作文件系统装载。
>
>他在一个叫ramfs的cache实现上加了一层很薄的封装，其他内核开发人员编写了一个改进版tmpfs，这个文件系统上的数据可以写出到交换分区，而且可以设定一个tmpfs装载点的最大尺寸以免耗尽内存。initramfs就是tmpfs的一个应用。
>
>优点：  
>  * tmpfs随着其中数据的增减自动增减容量.  
>  * 在tmpfs和*page cache/dentry cache*之间没有重复数据.  
>  * tmpfs重复利用了Linux caching的代码, 因此几乎没有增加内核尺寸, 而caching的代码已经经过良好测试, 所以tmpfs的代码质量也有保证.  
>  * 不需要额外的文件系统驱动.  
>
>另外, `initrd`机制被设计为旧的"root="机制的前端，而非其替代物，它假设真正的根设备是一个块设备， 而且也假设了自己不是真正的根设备，这样不便将NFS等作为根文件系统。最后`/linuxrc`不是以`PID=1`执行的, 因为`1`这个进程`ID`是给`/sbin/init`保留的。 `initrd`机制找到真正的根设备后将其设备号写入*/proc/sys/kernel/real-root-dev*， 然后控制转移到内核由其装载根文件系统并启动*/sbin/init*。
>`initramfs`则去掉了上述假设， 而且`/init`以`PID=1`执行， 由`init`装载根文件系统并用`exec`转到真正的*/sbin/init*， 这样也导致一个更为干净漂亮的设计。
>
>###生成initramfs镜像命令
>
>若镜像根目录为/initrd，执行下面命令在当前用户主文件夹中生成myinitramfs.gz镜像。
>```bat
>cd /initrd 
>find .|cpio -o -H newc|gzip>~/myinitramfs.gz 
>```
>注1: 以上生成的镜像文件是gzip压缩过的。如果不加`|gzip`则就是原始的cpio档.
>注2: windows下可以使用以下命令行成
>    dir /b | cpio -o -H newc > myinitramfs.cpio

## GRUB4DOS initrdfs介绍

### 格式限制  
1. 多个批处理附加时,使用`NULL`字符分隔每个批处理(必须的,而且只能有一个`NULL`字符),并且附加的批处理文件不能压缩(暂不支持压缩).  
2. 如果是只附加一个数据文件,建议不要压缩,这样才可以直接访问.  

## 其它说明

### 只附加一个数据文件

如果这个数据文件没有压缩,而且是GRUB4DOS可以识别的格式那可以直接用设备`%~m0`来访问里面的文件.

建议只附加一个CPIO/ISO格式,这样子使用起来最方便,也最节省空间(附加的文件同样不要压缩). 

批处理加附一个CPIO文件(CPIO里面的文件可以压缩)
则在批处理中可以直接使用`%~m0/FILE`访问`File`就是CPIO包里面对应的文件.

ISO/IMG等格式也是一样的.

### 如果单纯附加了批处理文件

 访问方式: `%~m0/1`是第一个文件,`%~m0/2`是第二个文件,以此类推.并且可以直接运行

### 如果附加了批处理和数据文件

 根据附加顺序`%~m0/1` `%~m0/2`来访问/
   
 若附加的数据文件是CPIO等GRUB4DOS可识别的格式,而且没有压缩的话,那可以通过以下方法访问里面的文件

 ```bat
 set rdev=
 blocklist %~m0/1 | call :get_dev=
 ls %rdev%/
 cat %rdev%/file
 goto :eof
 :get_dev
 set rdev=%~d1
 goto :eof
 ```

