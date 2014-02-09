title: "[记录] 创建不区分大小写的ZFS卷方便使用FreeNas的TFTP服务器"
id: 840
date: 2012-07-04 16:51:34
tags: 
- case
- freenas
- TFTP
- zfs
categories: 
- 系统相关/FreeNas
---

如题，因为默认情况下创建的卷都是有区分大小写的，这样一来使用TFTP服务就不太方便。而Windows下的TFTP服务器就没有这样的问题，因为WINDOWS都是不区分大小写的，为了方便需要想办法TFTP服务不区分大小写。

查一了些资料，刚开始本来以为TFTP服务有什么参数还是什么的可以不区分大小写的，找了挺久了，没有发现任何有用的信息。

后来仔细看了一下ZFS文件系统部份，发现ZFS上面是可以创建不区分大小写的卷的。相关资料链接如下：

<http://docs.oracle.com/cd/E26926_01/html/E25826/gazss.html>

以下就是所需要的信息：

>`casesensitivity`  字符串  *mixed*

>此属性指示文件系统使用的文件名匹配算法应当是`casesensitive`、`caseinsensitive`，还是允许这两种匹配风格的组合 (mixed)。传统上，UNIX 和 POSIX 文件系统的文件名区分大小写。
此属性的值为 mixed 时表示文件系统对区分大小写和不区分大小写的匹配行为要求均可支持。当前，在支持混合行为的文件系统上，不区分大小写的匹配行为仅限于 Oracle Solaris SMB 服务器产品。有关使用 mixed 值的更多信息，请参见casesensitivity 属性。
不管 casesensitivity 属性设置如何，在创建文件时，文件系统都会保留指定的名称的大小写。在创建文件系统后无法更改此属性。

试着直接`zfs set` 来改变该属性发现是只读的，不可修改。所以只能重新创建一个卷了。

因为使用WEB图形界面创建的ZFS卷不能设置这个属性，所以必须到SHELL下创建，命令举例：
```
zfs create -o casesensitivity=insensitive zfs0/tftproot
```
在zfs0上创建一个新的卷tftproot不区分大小写。我们简单一点只需要上面的命令就可以了，其它的容量限制什么的可以直接在图形界面下修改。

然后只要把TFTP服务的根目录设为上面新创建的卷就行了。不区分大小写用着就是比较方便。
