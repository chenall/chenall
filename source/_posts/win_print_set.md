title: "[分享] 在使用批处理修改WINDOWS的打印机设置"
id: 652
date: 2011-02-25 09:41:12
tags: 
- 批处理
categories: 
- 系统相关
- 程序设计/批处理
---

因为无忧里面以下贴子,

[http://bbs.wuyou.com/viewthread.php?tid=187450](http://bbs.wuyou.com/viewthread.php?tid=187450)

所以就抽空研究了一下整理了一个批处理出来.

自己目前用不上,发在这里留一个底,万一自己以后碰到了就有现成的可用了.

如果对您有用就支持一下吧,^_^

```
@echo off
:::::::::::使用批处理修改打印机设置:::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::来源:   http://chenall.net/post/win_print_set
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
setlocal
::指定打印机名称
set print=Microsoft XPS Document Writer
::设置默认的注册表路径
set reg_path=HKLM\SYSTEM\CurrentControlSet\Control\Print\Printers\%print%
::读取原来的设置
for /f "usebackq tokens=3" %%i in (`reg query "%reg_path%" /v Attributes ^| find /i "Attributes"`) do set p_attr=%%i
::0x0     立即开始打印(默认)
::0x1     在后台处理完最后一页时开始打印
::0x2     直接打印到打印机
::::::::::以上设置只有一个会生效
::0x80    挂起不匹配文档
::0x100   保留打印的文档
::0x200   首先打印后台文档
::0x800   双向打印

::修改设置
::例子取消双向打印,使用与运算
set /a "p_attr &= ~0x800"
::::若是要启用双向打印,使用或运算
::set /a "p_attr |= 0x800"
::设置首先打印后台文档
set /a "p_attr |= 0x80"


::最终执行
reg add "%reg_path%" /v Attributes /t REG_DWORD /d %p_attr% /f
::以下是必须的，刷新一下打印机的设置，否则需要重启后才可以看到效果。
net stop spooler
net start spooler
```