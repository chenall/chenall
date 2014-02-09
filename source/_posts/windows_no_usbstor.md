title: "一个命令禁用U盘,USB硬盘设备"
id: 96
date: 2009-09-16 23:40:45
tags: 
- USBSTOR
- USB硬盘
- 禁用U盘
categories: 
- 实用文集
---

有时候为了安全着想,需要禁用U盘,USB硬盘等储存设备,一般可以通过以下两种方式.

1.  在BIOS中禁用
2.  使用软件禁用

在BIOS中禁用比较麻烦,而且一般情况下不能只禁用U盘,会连其它USB设备都用不了.用软件一般都比较强大(未用过).

其实一般情况下,可以通过禁止安装USB驱动来实现(网上的资料有许多,通过删除U盘驱动来实现具体删除的文件名USBSTOR.*)

为了方便我自己一般使用一个命令来实现,只要禁用一个驱动服务就可以了.

命令如下.

```
sc config usbstor start= demand
```

注意:`=`后面有一个空格.

功能:把usbstor的服务设为手工启动.这样系统重启后,如果没有启用这个服务之前插上U盘等都是不能使用的.

需要使用时可以使用以下命令开启服务就可以了.(开启了就不能再关闭,用完了就重启系统,这样就可以防止一般人使用U盘了)

临时开启的命令如下:
```
net start usbstor
```

说明:上面的<span style="color: #ff00ff">demand</span>如果改成<span style="color: #ff00ff">disabled</span>就是直接禁用了,不能直接使用net start usbstor来临时开启.</span>