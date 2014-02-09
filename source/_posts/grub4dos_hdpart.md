title: "[GRUB4DOS] 通用模块之分区选择"
id: 738
date: 2011-08-09 16:07:36
tags: 
- GRUB4DOS
- 批处理
- 模块
- 原创
categories: 
- GRUB4DOS/批处理
---


通用Grub4dos硬盘分区选择接口模块,

供有需要的朋友使用.

可以在你的菜单中简单的加入一个分区选择模块.

要求:  必须使用2011-08-09以后发布的GRUB4DOS

使用方法:

首先复制代码另存为hd_part.lst
然后在你的批处理或菜单中直接调用.调用的方法有两种.

1.简单调用,直接在执行模块的时候加参数例子:
![](http://photo.staticsdo.com/a1/486/458/0/60809-49499083-8.png)
效果图.根据你硬盘的分区情况列出菜单.

![](http://photo.staticsdo.com/a1/422/278/391/60810-49499083-8.png)

2.如果你需要多次调用,建议使用此方法(先设置好需要的变量后再执行模块)
如实现上面的例子:
```
set m.cmd="pause test cmd"
set m.return="pause test return"
hd_part.lst
```

注:使用方法1时,将不会使用变量参数即1,2不能混用.

```bat
!BAT
::::通用Grub4dos硬盘分区选择接口模块.
::1.程序占用内存地址(md)0x20A+22
::2.首先设置好参数,然后直接执行本批处理调用.
::3.参数设置.(变量)m.cmd必须设置,其它的可选
::  m.cmd    选择指定分区时要执行的命令接口执行是附加参数分区号例 set m.cmd=echo时,执行(hd0,0)的菜单就相当于执行echo (hd0,0).
::  m.title  菜单主标题
::  m.return 返回菜单时要执行的命令(如果没有设置,则不会出现返回菜单)
::  m.init   菜单初始化脚本(自动生成的菜单title命令之前的内容)
::4.使用方法.两种方式,自己根据情况选择.
::	1.直接通过批处理传递以上参数(用批处理传递参数时不要加前面的m.)例:
::	  hd_part.lst cmd="echo" return="configfile (md)4+8"
::	2.先设置变量再调用
::	  set m.cmd=echo
::	  set m.return="configfile (md)4+8"
::	  hd_part.lst
::
::	chenall 编写于 2011-08-09. http://chenall.net 
setlocal
debug off
checkrange 20110809:-1 read 0x8278 || echo Please use grub4dos-0.4.5b-2011-08-09 or above! && exit 1
if "%1"=="" goto :参数检测
set *
::set m.cmd=
::set m.title=
::set m.init=
::set m.return=
:获取参数
if /i "%1"=="" && goto :参数检测
set m.%~1=%~2
shift 1
shift 1
goto :获取参数

:参数检测
if not exist m.cmd exit 1
if not exist m.title set m.title=屯屯屯屯屯屯屯屯 Please select a partition 屯屯屯屯屯屯屯屯
set m.menu=(md)0x210+16
::自动生成菜单
echo default 1 > %m.menu%
echo -e debug off\n%m.init% >> %m.menu%
echo title %m.title% >> %m.menu%
echo pause Partition list menu for grub4dos by chenall . http://chenall.net >> %m.menu%
set n=1
set skip=0
find --devices=h root > (md)0x20A+6
call :分区信息
echo -e clear\ntitle 屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯\npause Partition list menu for grub4dos by chenall . http://chenall.net  >> %m.menu%
if not exist m.return && configfile %m.menu%
echo title  0. Return >>  %m.menu%
echo %m.return%  >>  %m.menu%
echo boot >> %m.menu%
configfile %m.menu%
exit

:分区信息
cat --locate=\xa --number=1 --skip=%skip% (md)0x20A+6 || exit
set /a length=%?%-%skip%
cat --skip=%skip% --length=%length% (md)0x20A+6 | call :add_list=
set /a skip=%length%+%skip%+1
goto :分区信息
:add_list
set m=1   %n%
echo title %m:~-2%. %* >> %m.menu%
echo %m.cmd% %1 >> %m.menu%
echo boot >> %m.menu%
set /a n=%n%+1
exit
```