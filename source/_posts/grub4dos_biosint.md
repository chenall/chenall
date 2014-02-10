title: "可以在GRUB4DOS下调用BIOS中断的外部命令"
id: 785
date: 2011-10-17 23:36:28
tags: 
- chkpci
- GRUB4DOS
- 原创
categories: 
- GRUB4DOS/扩展
---


本程序可以在GRUB4DOS中直接调用BIOS中断和读写指定端口，从而获取一些功能和需要的数据。

可以方便开发人员临时调试某个功能时使用。

当然你对中断资料比较熟悉的话，就可以利用GRUB4DOS配合本程序作出非常酷的效果（比如移动的文字）

 

使用方法，直接下载程序在GRUB4DOS中执行

## 参数

* 写数据到指定端口
    bios outb/outw/outl PORT VALUE
* 从指定端口读数据
    bios inb/inw/inl 
* 中断调用
    bios int=INT eax=EAX ebx=EBX [...]
 

可使用的所以参数在下面的列表中

```
unsigned long edi; // as input and output
unsigned long esi; // as input and output
unsigned long ebp; // as input and output
unsigned long esp; // stack pointer, as input
unsigned long ebx; // as input and output
unsigned long edx; // as input and output
unsigned long ecx; // as input and output
unsigned long eax;// as input and output
unsigned long gs; // as input and output
unsigned long fs; // as input and output
unsigned long es; // as input and output
unsigned long ds; // as input and output
unsigned long ss; // stack segment, as input
unsigned long eip; // instruction pointer, as input, 
unsigned long cs; // code segment, as input
unsigned long eflags; // as input and output
```

效果图在这里(之前的图片放在盛大的服务器上,已经失效)

1. 直接读写端口演示，分别使用`outl`和`inl`  

   说明：chkpci就是主要使用`outl`和`inl`获取PCI信息的（具体的在本站文章上面的搜索中输入CHKPCI查看更多介绍）
   结果自己看，后面使用bios调用得到的是第一条PCI的记录。。

  ![获取pci信息]([CDN_URL]:/post/grub4dos_biosint_01.png)

2. 调用BIOS中断演示

  ![未执行前的界面]([CDN_URL]:/post/grub4dos_biosint_02.png)

  ```
    这是调用了`INT 10`后的界面，这里稍微介绍一下这个语句的作用
    调用`BIOS`的`int10`中断第6号功能。`AX=0X0601` 即AH=06H,AL=01
    CX=0x050d 即CH=5,CL=0xD(13)
    DX=0X0E20 CH=0xe(14),cl=0x20(32)
    意思就是把屏幕从第5行第13个字符开始到第14行第32个字符结尾的柜形上移一行。
    功能号：06H和07H
    功能：初始化屏幕或滚屏
    入口参数：AH＝06H—向上滚屏，07H—向下滚屏
             AL＝滚动行数(0—清窗口)
             BH＝空白区域的缺省属性
            (CH、CL)＝窗口的左上角位置(Y坐标，X坐标)
            (DH、DL)＝窗口的右下角位置(Y坐标，X坐标)
    出口参数： 无
  ```

  ![调用结果]([CDN_URL]:/post/grub4dos_biosint_03.png)


这个程序只是为了方便测试而编写,使用者需自己注意。

下载地址（带源码）：

[http://code.google.com/p/grubutils/downloads/list](http://code.google.com/p/grubutils/downloads/list)
