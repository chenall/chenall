title: "[转载] 从网络启动安装Windows"
id: 5
date: 2008-05-05 14:57:29
tags: 
- PXE
- 网络
- RIS
categories: 
- 系统相关/综合
- 转载文章
---

### Windows网络安装简介

作者：Rinrin

顾名思义，Windows网络安装表示从局域网内部引导Windows安装，核心技术基于微软的RIS(Remote Installation Services)。RIS有一个缺点，即需要在域环境下才能配置运行RIS。不过这个限制已经被国外的高手破解了，现在可以从任何一台Windows（甚至是Linux）机器上配置网络安装所需要的服务。本文将简单说明实现Windows网络安装的技术要点。

实现Windows网络安装需要四个服务：BOOTP,TFTP,BINL,Windows Share. 其中BOOTP和TFTP是实现PXE启动的基础，关于PXE启动的详细信息，可以参考本文后的引用2。

BINL服务，微软称之为启动信息协商层(Boot Information Negotiation Layer)，其作用是网卡查询、身份验证、启动镜像选择等功能。实现Windows网络安装只需要其中一项功能，即网卡查询。Sherpya逆向分析了BINL协议，并写了一个开源的Binl服务程序。要了解详细信息，可以参考本文后的引用1。

Windows共享服务提供了安装文件的来源，并且在文本模式安装阶段作为启动分区(Boot Partition)，因此也是必不可少的。

Windows网络安装的大致步骤如下：

1. 目标计算机从网卡PXE Boot ROM启动（当然，你也可以用PXELinux或PXEGrub来实现类似的启动功能）。
2. 目标计算机从DHCP/BOOTP服务器获得网络地址，并获得TFTP服务器的IP地址和启动文件信息。
3. 目标计算机向TFTP服务器获得启动文件startrom.com/startrom.n12
4. startrom.com获取ntldr(由setupldr.exe改名而来)，并将控制权传递给它。
5. setupldr.exe获取ntdetect.com和winnt.sif，winnt.sif应该包含启动相关信息。
   从这个时候起，有两种启动方法，即ramdisk和网络启动，对于Ramdisk，启动分区为\Device\Ramdisk{xxxx...}，你可以参考本文后的引用2。对于网络启动，你需要在winnt.sif中设定SetupSourceDevice参数。
6. setupldr.exe通过ntdetect.com获得网卡的Vendor ID和Device ID, 并将它发送到Binl服务端口(4011)。
7. Binl服务查找&ldquo;数据库&rdquo;，获得需要加载的驱动名称和服务名，返回给setupldr.exe
8. Setupldr.exe按照正常顺序加载驱动，不过在最后，它会试着去加载前面给出网卡驱动和网络设备相关驱动，你可以从TFTP服务器的log里看到这些。有意思的是，txtsetup.sif并没有网络设备相关驱动的信息，我想可能是直接写在setupldr.exe里了。
9. 控制权移交给kernel，kernel会试着去mount启动分区，要注意的是，你建好的共享必须提供匿名访问，否则会停住不动。
10. 开始文本模式安装，setupdd复制文件到硬盘。完成后重新启动。
11. 开始GUI阶段安装，要注意的是，之前应该在Winnt.sif中指定OriSrc和OriTyp，至于是不是必须的，我不好说，因为并没有试验过。
12. 安装结束。实际上，你可以在winnt.sif中加入相关信息，以便实现无人值守安装。

接下来，看一个实际的例子：

1. 准备好DHCP/TFTP服务器，可以用tftpd32，也可以用性能较好的haneWin，看你的选择了。
2. 设定好DHCP/TFTP服务器，指定TFTP根目录和启动文件名(startrom.n12或其他)。
3. TFTP目录结构如下：
```
  TFTP
  │ntdetect.com
  │ntldr
  │startrom.n12
  │winnt.sif
  │
  └─boot
    └─I386
```
其中ntldr由setupldr.exe改名而来，I386目录可以直接从安装光盘中复制。

4. winnt.sif内容如下：
```
  [Data]
  floppyless = "1"
  msdosinitiated = "1"
  OriSrc = "\\Angel\TFTP\boot\i386"
  OriTyp = "4"
  LocalSourceOnCD = 1
  DisableAdminAccountOnDomainJoin = 1
  
  [SetupData]
  OsLoadOptions = "/fastdetect"
  SetupSourceDevice = "\Device\LanmanRedirector\Angel\TFTP\boot"
  
  [UserData]
  ComputerName = *
```
  Angel为当前计算机主机名，TFTP为共享名。

5. 编译Binl服务程序binlsrv.c，可以在本文后的引用1找到。如果你装了VC，可以用cl binlsrv.c ws2_32.lib来编译。
6. 编写文件nics.txt，和binlsrv.exe放在同一目录下：
```
  1022 2000 vmxnet.sys vmxnet
  1186 1300 RTL8139.sys rtl8139
```
  从左到右分别为**PCI Vendor ID**, **Device ID**, **驱动名**, **服务名**

7. 把网卡驱动（如**vmxnet.sys,RTL8139.sys**）放到**TFTP\boot\I386**目录下
8. 将TFTP目录共享，注意匿名访问。如何设置就不说了，网络上有很多文章，重点是启用Guest、允许网络访问、允许空会话、NTFS权限等等，完了别忘了重启一下Server服务。
9. 启动目标计算机，开始网络安装！


###  后记：

  Windows网络安装并不复杂，国外的高手几年前就开始研究了。希望大家能多到Boot land, 911CD这样的论坛逛一逛，开阔眼界吧。

  引用：
  1. Sherpya. RIS for Linux, <http://oss.netfarm.it/guides/>
  2. Climbing. PXE服务器架设指南及PXE启动WinPE（含PE2.0）解决方案总结, <http://www.znpc.net/bbs/viewthread.php?tid=3662&amp;extra=page%3D1>
