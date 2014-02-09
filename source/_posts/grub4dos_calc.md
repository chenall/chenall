title: "[GRUB4DOS] 外部命令 calc 简单计算器"
id: 126
date: 2010-02-01 21:37:56
tags: 
- calc
- GRUB4DOS
- 外部命令
- 计算器
categories: 
- GRUB4DOS/扩展
---

## [程序说明]

   GRUB4DOS 下运行的简单双目计算器.

注: __最新版`GRUB4DOS`已经内置本功能__

## [下载地址]

   程序下载: [http://grub4dos-chenall.googlecode.com/files/calc.zip](http://grub4dos-chenall.googlecode.com/files/calc.zip)
   最新版grub4dos下载:  [http://grub4dos-chenall.googlecode.com/](http://grub4dos-chenall.googlecode.com/)

[使用说明]

![](http://d.chenall.net/upload/2010/2/E1FC915B87938DBE7AD7581D63D3837316CE9FD0.png)

GRUB4DOS 简单双目计算器.
 使用方式:
 
 1. calc 数值 [运算符] 数值
 2. calc 数值 = 数值 运算符 数值
 
     如果数值前面有前导`*`代表这是一个内存地址,
     计算时会从这个内存地址中读取32位整数进行计算.
     第一个参数如果有前导`*`,会将计算结果写入这个内存地址中.
     可使用运算符列表:
     递减 --
     递增 ++
     加法 +
     除法 /
     取余 %
     乘法 *
     减法 -
     按位与 &
     按位或 |
     按位异或 ^
     按位左移 <<
     按位右移 >>

注:本程序不考虑小数点还有负数等计算.

[使用截图]

![](http://d.chenall.net/upload/2010/2/4264B928F381C5B0FCA5FAB4E5043184716D0784.png)
![](http://d.chenall.net/upload/2010/2/C2746EFDBC33213B6C5A91296C5B831F7D36336D.png)
