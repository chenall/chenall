title: "GRUB4DOS一个比较变态的用法(利用GRUB4DOS作为文件中转站)"
id: 40
date: 2009-01-15 12:56:42
tags: 
- GRUB4DOS
categories: 
- GRUB4DOS/综合
- 实用文集
---

利用GRUB4DOS的map功能来中转文件.使得DOS下可以访问 
例子:  
```
map --mem /minipe/system.wim (hd1)
map --hook
```
说明: 把/MINIPE.SYSTEM.WIM文件映射为(hd1)硬盘.`GRUB4DOS`会把这个文件的内容作为一个磁盘分区(hd1,0).

也就是把一个文件虚拟成一个分区.

然后进到入DOS后,利用一个磁盘工具把上面的(hd1,0)分区保存为一个文件. 
例子:用todisk
```
todisk 2:1=q to (c:\system.wim)
```
把第二磁盘的第一分区保存为system.wim(即还原过程).

这个方法在某些情况下很有用处.由于1个磁盘扇区是512字节,所以最后得到的文件会是512字节的倍数(不足补00),所以只适用于对文件内容长度要求不是很严格的地方.