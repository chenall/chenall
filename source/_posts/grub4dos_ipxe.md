title: "[grub4dos] grub4dos 0.4.6a ipxegrldr 功能介绍"
date: 2014-12-28
id: 20141228
tags:
- GRUB4DOS
- ipxe
categories:
- GRUB4DOS
description: grub4dos 0.4.6a ipxegrldr 支持ipxe完整功能调用,ipxe相关介绍
---

  [最新版本grub4dos](http://grub4dos.chenall.net/downloads/grub4dos-0.4.6a-2014-12-27/)的发行包里面有一个`ipxegrldr`文件,这个文件其实是整合了`undionly.kpxe`和`grldr`的文件,可以作为PXE的启动文件.

## 新的功能
  * 使用该文件启动可以完整支持`ipxe`的所有功能调用,通过它允许直接在`grub4dos`下访问`WEB`或`SAN`上面的文件.
  * 另外相对应的增加了一个命令`ipxe`,使用它可以调用各种[ipxe命令](http://ipxe.org/cmd)

   **ipxe 命令语法:  ipxe [cmd] [params]**
<!--more-->

## 相关用法介绍

1. 可以直接访问网络上的文件.
```
cat http://b.chenall.net/menu.ipxe
map --mem http://b.chenall.net/ntboot.iso (0xff)
map --hook
ls (0xff)
```
 ![](@@POST@@:01.png)

2. 利用`ipxe`命令来实现更多功能

  使用ipxe命令时需要注意一点,最好在文本模式下运行(terminal console)运行ipxe,特别是像`ipxe chain`或`ipxe boot`之类的,否则会看不到ipxe的回显.看起来就像是假死状态.

  * 可以直接调用ipxe的各种命令,例子
  ![](@@POST@@:02.png)

  * 直接调用ipxe菜单(注:在ipxe菜单中可以用exit命令返回)  
  ```
  ipxe chain http://b.chenall.net/menu.ipxe
  ```

  * 直接使用ipxe启动网络上的文件  
  ```
  ipxe chain http://b.chenall.net/grldr
  ```

  * 直接使用ipxe启动网络上的镜像文件例子  
  ```
  ipxe sanboot http://b.chenall.net/ntboot.img
  ipxe sanboot iscsi:10.0.4.1:::1:iqn.2010-04.org.ipxe.dolphin:storage
  ```

  * 高级用法,通过sanhook来直接把网络上的镜像映射为一个本地设备.   
  sanhook 可以把映射一个网络镜像相当于grub4dos的map,只是这个是直接映射,读写都是通过网络完成的.  
  sanunhook 删除一个映射.
  ```
  ipxe sanhook -d 0xff http://b.chenall.net/ntboot.iso
  ipxe sanunhook -d 0xff
  ```
  ![](@@POST@@:03.png)
  ![](@@POST@@:04.png)

##  iSCSI SAN URI
>The format of an iSCSI SAN URI is defined by [RFC 4173](http://tools.ietf.org/html/rfc4173). The general syntax is:
```
  iscsi:<servername>:<protocol>:<port>:<LUN>:<targetname>
```
For example:
```
  iscsi:10.0.4.1:::1:iqn.2010-04.org.ipxe.dolphin:storage
  iscsi:boot.ipxe.org::::iqn.2010-04.org.ipxe.boot:public
  iscsi:192.168.0.1::::iqn.1991-05.com.microsoft:msdos622-target
  iscsi:opensolaris.home::::iqn.1986-03.com.sun:02:e9abf4cd-714b-c6ec-d017-eea5a56252ed
```
* `<servername>` is the DNS name or IP address of the iSCSI target.
* `<protocol>` is ignored and can be left empty.1)
* `<port>` is the TCP port of the iSCSI target. It can be left empty, in which case the default port (3260) will be used.
* `<LUN>` is the SCSI LUN of the boot disk, in hexadecimal. It can be left empty, in which case the default LUN (0) will be used.
* `<targetname>` is the iSCSI target IQN.

>If you are using iSCSI authentication, then you will need to configure the username and password settings (and possibly also the reverse-username and reverse-password settings) before attempting to connect to the SAN target. There is no way to specify usernames and passwords directly within the iSCSI SAN URI.

后记: 使用`ipxegrldr`作为PXE启动文件还有另一个好处,就是如果网络正常的话,使用`ipxegrldr`总是会优先使用 http://b.chenall.net/grldr 来启动,也就是说总是使用最新的版本.当然了如果网络不通的话就使用内置的版本.如果你不需要这个功能的话可以直接使用undionly.kpxe自己写菜单来启动grldr