title: "UMBR 通用于MBR引导程序"
id: 20160118
date: 2016-01-18 10:25:28
tags: 
- umbr
- GRUB4DOS
- 原创
categories: 
- GRUB4DOS/扩展
---


### [功能说明]

  UMBR(Universal Master Boot Record),是一个简单的通用型的MBR引导程序,只支持LBA模式(BIOS不支持LBA的无法使用,目前除了很老的机子,大部份都有支持).

使用创新的方案,和磁盘分区格式无关,所以可以安装到MBR或GPT磁盘格式下,目前GPT磁盘一般都是配合EFI来启动,有了它就可以在BIOS模式下直接启动GPT磁盘上的系统(需要系统有支持)了.

<!--more-->

## [使用方法]

  目前该程序只能在[GRUB4DOS](http://grub4dos.chenall.net)环境下运行,请在最新版本GRUB4DOS环境下使用.

参数介绍:

```
umbr [-d=D] [-p=P] [--test] [file1] [file2] [file3]
	-d=D			指定要安装的磁盘默认是当前ROOT磁盘
	-p=D			启动失败后要启动的分区默认是第一个分区.
	--test			测试模式,不写入磁盘,加这个参数会进入安装效果测试.
	file1-3			可以指定三个启动文件位置以防止启动失败.

注: 这个filex	可以是任意GRUB4DOS可以识别的文件格式(必须连续存放).比如(hdx,y)/path/file或(hdx)xxxx+yyyy/(hdx,y)xxx+yyy之类的.

file1是主启动文件,如果检验失败了会再尝试file2...
```

说明:

1. 由于是直接使用绝对扇区位置来启动的,所以和文件系统无关.
2. 使用指定文件也会被转换为绝对扇区位置,正常情况下改名不影响启动,删除了如果文件内容没有被覆盖之前也是可以启动的.
3. 启动失败时会暂停并等待按键,这时按任意键可以尝试下一个.

一个实用的例子:

磁盘使用的是GPT格式,GRLDR有两个备份分别是ESP(hd0,0)/grldr和普通分区(hd0,3)/boot/grub/grldr,并且在分区间隙(hd0)6554433+63处是WEE63.

装有系统的分区是(hd0,1).

这时就可以通过UMBR默认加载ESP分区的GRLDR或普通分区上的GRLDR,失败了再尝试WEE63,还是失败就直接启动(hd0,1)分区.

进入GRUB4DOS执行以下命令就可以了

```
umbr -d=0 -p=1 (hd0,3)/boot/grub/grldr (hd0,0)/grldr (hd0)6554433+63
```
也可以默认wee63,通过wee63来控制启动过程,因为本例wee63是写到分区间隙的,出问题的几率比较小

```
umbr -d=0 -p=1 (hd0)6554433+63 (hd0,3)/boot/grub/grldr (hd0,0)/grldr 
```

当然了也可以直接启动指定分区而不通过其它引导程序当分区,如下默认直接启动(hd0,1)上的系统,如果该分区被分区软件调整过启动失败了,会尝试启动wee,最后尝试启动grldr

```
umbr -d=0 -p=1 (hd0,1)+1 (hd0)6554433+63 (hd0,0)/grldr 
```

## [其它参考]

UMBR 相关说明

```
0x8			4个字节		UMBR标志
0xC			1个字节		UMBR版本号
0x10-0X3F	48个字节	用户定义的启动区
0x40-0X4F	16个字节	保留的启动区(当用户定义的启动都失败时启动的分区)
0x40-0x1B7				启动代码.
```

启动区说明,目前0x10-0x4F,每一个启动项占用16个字节,为了编程方便使用的是和DiskAddressPacket一样的格式.

```
    WORD CRC;			//启动项校验
　　WORD BlockCount;　　// 启动代码块数(以扇区为单位)
　　DWORD BufferAddr;　　// 传输缓冲地址(segment:offset),也是该代码的启动地址
　　QWORD BlockNum;　　　// 启动代码在磁盘上的位置(LBA)
```

校验方法: 使用的是简单的XOR校验,最多校验127个扇区,按4个字节依次XOR得到的最后结果,再把低16位和高16位进行一次XOR得到最后的结果作为检验值.

具体的校验代码可以参考源码有ASM/C语言两个版本.

## [源码下载]

源代码: https://github.com/chenall/grubutils

应用下载: http://b.chenall.net/boot/grub/umbr 

