title: "遭遇DOS下extract.exe 内存不足的问题."
id: 33
date: 2008-12-10 17:18:35
tags: 
- extract
- DOS
categories: 
- 杂七杂八

---

今天在制作一个启动盘,时需要用EXTRACT来解压cab文件,却发现死活不行.
总是提示 *`out of memory while processing cabinet file`* 错误

查了相关文章 [http://support.microsoft.com/kb/261758](http://support.microsoft.com/kb/261758) 还是没有用.

已经加载了himem.sys的内存管理,并且内存达到512MB.郁闷了半天.研究了WIN98的启动盘才发现问题所在.

WIN98启动盘使用了XMSDSK内存盘.跟踪后发现,如果没有这个XMSDSK内存盘EXTRACT就会有上面的提示.
经过多次测试才发现
原来这个extract程序要求启动分区可用空间大于`2048KB`否则就会有上面的错误提示.
而这个启动分区是根据环境变量`comspec`的值来确定的.而WIN98启动盘使用了XMSDSK内存盘后把这个变量指定的内存盘(COMMAND.COM也复制过去了),所以没这个问题.

不得已只好也使用XMSDSK来虚拟一个大于2048KB的内存盘来临时使用下.