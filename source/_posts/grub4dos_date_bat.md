title: "[分享] 直接在GRUB4DOS环境中修改系统时间"
id: 782
date: 2011-10-08 17:12:07
tags: 
- date
- GRUB4DOS
- time
- 批处理
categories: 
- GRUB4DOS/批处理
---

修改系统日期有很多种方法，比如直接进入BIOS修改，或者进入系统后修改。

如果我想每次开机都改成一个固定的时间，进入系统后自动更新为正确的时间（一般用于过期软件破解）

现在可以直接使用GRUB4DOS来实现自动修改了。

本批处理属于GRUB4DOS高级编程，直接调用BIOS中断来实现修改日期的目的。

BIOS中断调用的实现例子。

用法:

把批处理直接保存为DATE然后使用以下命令就可以了或直接使用C语言编译的版本

  显示当前日期

    date

  修改日期

    date 2011-01-01


### 相关资料:
```
时钟服务(Clock Service——INT 1AH) 
00H —读取时钟“滴答”计数06H —设置闹钟
01H —设置时钟“滴答”计数07H —闹钟复位
02H —读取时间0AH —读取天数计数
03H —设置时间0BH —设置天数计数
04H —读取日期 80H —设置声音源信息 
05H —设置日期
(1)、功能00H
功能描述：读取时钟“滴答”计数
入口参数：AH=00H
出口参数：AL=00H——未过午夜，否则，表示已过午夜
CX:DX=时钟“滴答”计数
(2)、功能01H
功能描述：设置时钟“滴答”计数
入口参数：AH=01H
CX:DX=时钟“滴答”计数
出口参数：无
(3)、功能02H
功能描述：读取时间
入口参数：AH=02H
出口参数：CH=BCD码格式的小时
CL=BCD码格式的分钟
DH=BCD码格式的秒
DL=00H——标准时间，否则，夏令时
CF=0——时钟在走，否则，时钟停止
(4)、功能03H
功能描述：设置时间
入口参数：AH=03H
CH=BCD码格式的小时
CL=BCD码格式的分钟
DH=BCD码格式的秒
DL=00H——标准时间，否则，夏令时
出口参数：无
(5)、功能04H
功能描述：读取日期
入口参数：AH=04H
出口参数：CH=BCD码格式的世纪
CL=BCD码格式的年
DH=BCD码格式的月
DL=BCD码格式的日
CF=0——时钟在走，否则，时钟停止
(6)、功能05H
功能描述：设置日期
入口参数：AH=05H
CH=BCD码格式的世纪
CL=BCD码格式的年
DH=BCD码格式的月
DL=BCD码格式的日
出口参数：无
(7)、功能06H
功能描述：设置闹钟
入口参数：AH=06H
CH=BCD码格式的小时
CL=BCD码格式的分钟
DH=BCD码格式的秒
出口参数：CF=０——操作成功，否则，闹钟已设置或时钟已停止
(8)、功能07H
功能描述：闹钟复位
入口参数：AH=07H
出口参数：无
(9)、功能0AH
功能描述：读取天数计数，仅在PS/2有效，在此从略
(10)、功能0BH
功能描述：设置天数计数，仅在PS/2有效，在此从略
(11)、功能80H
功能描述：设置声音源信息
入口参数：AH=80H
AL=声音源
=00H——8253可编程计时器，通道2
=01H——盒式磁带输入
=02H——I/O通道上的"Audio In"
=03H——声音产生芯片
出口参数：无
```
C语言版的代码在这里

[http://code.google.com/p/grubutils/source/browse/trunk/src/date.c](http://code.google.com/p/grubutils/source/browse/trunk/src/date.c)

批处理版源码:

```
!BAT
::datefunc for grub4dos by chenall 2011-10-08
setlocal
debug off
set edi=0x60000
set esi=0x60004
set ebp=0x60008
set esp=0x6000C
set ebx=0x60010
set bx=0x60010
set edx=0x60014
set dx=0x60014
set ecx=0x60018
set cx=0x60018
set eax=0x6001C
set ax=0x6001C
set gs=0x60020
set fs=0x60024
set es=0x60028
set ds=0x6002c
set ss=0x60030
set eip=0x60034
set cs=0x60038
set eflags=0x60003c
::时钟服务(Clock Service——INT 1AH) 
::04H —读取日期
call :BIOS_INT 1A ax=0x400
set date=%*
if exist date && goto :SET_DATE
call Fn.0 0 "%%04X%%04X" *%cx% *%dx% | set date=
echo -n The current date is: %date:~0,4%-%date:~4,2%-%date:~6%
set /p date=Enter the new date: (yyyy-mm-dd)

:SET_DATE  调用BIOS中断修改日期
::05H —设置日期
call :BIOS_INT 1A ax=0x500 cx=0x%date:~0,4% dx=0x%date:~5,2%%%date:~8,2%
exit

:BIOS_INT
::初始化系统参数
echo -n > (md)0x300+1
write %cs% -1
write %ss% -1
write %esp% -1
write %eflags% -1
write %ds% -1
write %es% -1
write %fs% -1
write %gs% -1
write %eip% 0xFFFF%1CD
shift 1

::设置参数
:参数
if "%2"=="" goto :realmode_run
write %%%1% %2
shift 1
shift 1
goto :参数
:realmode_run
call Fn.53 0x60000
exit
```