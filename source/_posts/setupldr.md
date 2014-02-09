title: "【WINPE】WinPE 1.x 启动文件SETUPLDR.BIN研究"
id: 111
date: 2009-11-14 19:37:05
tags: 
- GRUB4DOS
- winpe
- WXPE
- 原创文章
categories: 
- 个人日记
- 系统相关
---

一般的PE光盘必须的文件列表如下

```
 WINNT.SIF
 I386\WINPE.IM_
 I386\SETUPLDR.BIN
 I386\NTDETECT.COM
```

 WINNT.SIF文件内容例子
 
```
 [SetupData]
 BootDevice="ramdisk(0)"
 BootPath="\I386\SYSTEM32\"
 OsLoadOptions="/minint /fastdetect /rdpath=I386\WINPE.IMG"
```

`SETUPLDR.BIN`是启动文件，`WINNT.SIF`指定启动参数信息比如`WINPE.IMG`文件位置等
`SETUPLDR.BIN`加载时会根据`WINNT.SIF`里面的内容来启动，`WINNT.SIF`文件必须放在根目录下

启动文件加载过程

```
SETUPLDR.BIN -> NTDETECT.COM -> WINNT.SIF -> 根据OsLoadOptions 加载WINPE.IMG-->读取WINPE.IMG里面I386\TXTSETUP.SIF.....
```

现在的PE一般都把`WINNT.SIF`改名了是`WINNT.XPE`，还有`I386`目录改成`WXPE`,而`SETUPLDR.BIN`名字改的就比较多了，一般情况下可以根据文件大小看得出来。

其中`WINNT.SIF`位置还有`I386`目录都是通过`SETUPLDR.BIN`来指定的，`SETUPLDR.BIN`可以任意位置任意文件名。比如`BOOT\MTLDR.BIN`
修改`WINNT.SIF`和`I386`名字的方法网上有许多介绍，只需要直接查找替换就行了（用十六进制编辑器打开`SETUPLDR.BIN`查找替换，长度要一样）。如果要改的比以前短，就在替换的字符后面再加十六进制0就可以了。
 
 这里介绍的是另一个比较特殊的修改方法，直接定位修改。
<!--more-->


### 首先了解一下SETUPLDR.BIN的一些结构，
-----------------------------------------
已知:

*0X2A432* 处的winnt.sif就是启动后读取的文件名
*0x2A43E* 处的OsLoadOptions对应了winnt.sif里面的OsloadOptions

![](http://d.chenall.net/upload/2009/11/FC8601F9C5800FCC38E5E6588DBBBF77FB2D8082.png)


`WINNT.SIF`可以随意改成其它字符（据我所知在以前还没有人改超过原来的字符数9）


这里介绍改超过9个字符的方法如下图有11个字符了。*0x2a43d*位置的00不能改（要修改请继续看后面）
 修改后对应的文件是<font color="#FF0000">BOOT\PE.SIF</font>

![](http://d.chenall.net/upload/2009/11/E0291F639D16DF47718C78035F4858C7AC49E391.png)

我还需要更长的路径可以吗？当然了，接着往下看.看下图`WINNT.SIF`文件的位置被改成了`CSPE/KERNEL/OsLoadOptions`
这样子不需要修改其它东西了。只需把WINNT.SIF放在CSPE/KERNEL目录中里面改名为OsLoadOptions就可以了

![](http://d.chenall.net/upload/2009/11/2F1DD1A230CAD09ACF3B7942EF1635C4F0B7BA9E.png)

聪明的人可能就已经发现了，没错借用了OsLoadOptions这个字符串了。上面由于没有改到这个字符串的内容，所以还是可以启动的，接着看下图。改到了OsLoadOptions字符串了

![](http://d.chenall.net/upload/2009/11/CE90367AE94E968A0EA2B4995BFBFD9FCC46B4DF.png)

这时如果使用CSPE/KERNEL/WINNT.SIF来启动会失败的，因为字符串变了，解决方法也很简单，只要把WINNT.SIF里面的OsLoadOptions改成修改后的WINNT.SIF就可以了，WINNT.SIF内容修改后如

```
[SetupData]
 BootDevice="ramdisk(0)"
 BootPath="\I386\SYSTEM32\"
 WINNT.SIF="/minint /fastdetect /rdpath=I386\WINPE.IMG"
```
注意:上面的WINNT.SIF后面有一个00是截断字符，后面的字符就不要了，这个路径最长可以28个字符也就是写到0x2A44C位置例子如下图

![](http://d.chenall.net/upload/2009/11/F25249493A12A9B4C3DB7E611F8EEBA43BEAF773.png)

上图WINNT.SIF位置是BOOT\CSPE1\KERNEL\WINNT.SIF
 OsLoadOptions从`0X2A43E`开始到00结束
 所以WINNT.SIF内容要相应的改成如下。

```
[SetupData]
 BootDevice="ramdisk(0)"
 BootPath="\I386\SYSTEM32\"
 ERNEL\WINNT.SIF="/minint /fastdetect /rdpath=I386\WINPE.IMG"
```

不知大家有没有看明白？还有像其它地方基本上也是一样的，这些就是变通.的办法.

