title: "[推荐]MSDOS 网络启动软盘镜像"
id: 36
date: 2008-12-21 13:53:35
tags: 
- DOSRDP
- GRUB4DOS
- MSNET
- NETWORK
- TFTP
- UNDI
- DOS
categories: 
- 软件推荐/DOS
---

使用[Barts Network modboot disk](http://www.nu2.nu/bootdisk/network/)修改的镜像. 

适用于PXE启动,因为里面只带一个网卡驱动PXE UNDI NDIS.DOS

非PXE启动也可以使用,要求网卡有带启动功能,建议使用PXE启动.

### 使用方法
1. 用于PXE启动(可使用GRUB或SYSLINUX之类的软件来启动)
   GRUB菜单例子
   ```
   title Network1(GRUB4DOS内置的MAP)
   map --mem (pd)/undi.img (fd0)
   map --hook
   rootnoverify (fd0)
   chainloader (fd0)+1

   title Network2(类SYSLINUX的启动方式)
   kernel (pd)/memdisk
   initrd (pd)/undi.img
   ```
2. 用于光盘启动.(可使用ULTRAISO来制作启动ISO,直接把镜像作为启动文件)
3. 软盘启动,直接用WINIMAGE写入软盘.
4. ...

### 其它说明:

1. 只带一个驱动,所以镜像很小适用范围广,没有网卡限制,一般只要支持PXE启动的网卡都可以使用.避免了新碰到新机器的网卡不能识别问题.
2. 内置ODI_PKT驱动,可以使用WATTCP程序,内置了几个DOS下的程序.

   TFTP DOS下的TFTP客户端.

   DOSRDP DOS下的远程桌面连接程序(未经测试不一定可用)   
   VC DOS下著名的文件管理器. 可以输入HELP查看来帮助..  

3. 访问网络方式:
   * net use X: \\服务器名\共享名
   
     把指定服务器上的一个共享映射为一个指定的盘符X:
 
   * TFTP GET 文件名 服务器IP
   
     从TFTP服务器上下载文件,例子:(从192.168.0.253服务器上下载GHOST.EXE)
     
     tftp get ghost.exe 192.168.0.253

另:这个网络启动后也可以用于GHOST的网络克隆. 有兴趣的可以下载试用,觉得好用就支持一下....

下载地址: [http://chenall.ys168.com/](http://chenall.ys168.com/)

目录 SOFT\\network_UNDI.rar 1,020KB
