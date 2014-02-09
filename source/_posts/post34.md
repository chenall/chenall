title: "非内置SCSI驱动在PE下的安装过程"
id: 34
date: 2008-12-14 14:53:38
tags: 
- 批处理
- SCSI
categories: 
- 系统相关
- 程序设计/批处理
---


在PE下安装硬盘控制器驱动都是失败的,因为都是使用DEVCON类.

由我之前发的贴子[<font color="#333333">[原创]让你的PE/XP/2003系统支持EXFAT.](http://bbs.wuyou.com/viewthread.php?tid=133135)

我突然想到,SCSI驱动是不是也可以使用类似的方法呢,实验证明我的想法有一定的可行性(因无条件进行全面测试)

具体安装方法.

1.把这个驱动的SYS文件复制到DRIVERS目录,其它文件复制到(不需要INF文件)SYSTEM32.

注:一般都是只有一个SYS文件的所以只要把这个SYS文件复制到DRIVERS目录就好了.

2.把这个SYS文件设为服务并启动.

3.好了,如果服务正常启动,那系统中就会显示出你的SCSI硬盘.

附上测试效果图.使用VMSARE测试.

![](http://d.chenall.net/upload/2008/12/0.JPG)![](http://d.chenall.net/upload/2008/12/1.JPG)![](http://d.chenall.net/upload/2008/12/2.JPG)

附件为下面批处理脚本,可用在PE下

```bat
@echo off
title 在PE下安装硬盘控制器驱动简单脚本 by chenall 2008-12-14
rem 使用方法: 1.可直接拖放,即把对应驱动的SYS文件拖放到这个程序的图标上.
rem  2.使用命令行pe_scsi.cmd [你的SYS文件]
rem http://chenall.net
if "%1"=="" goto :eof
>"%temp%\scsi_serv.inf" echo.
>>"%temp%\scsi_serv.inf" echo.[Version]
>>"%temp%\scsi_serv.inf" echo.signature = "$Windows NT$"
>>"%temp%\scsi_serv.inf" echo.[DefaultInstall.Services]
>>"%temp%\scsi_serv.inf" echo.AddService =  %~n1,,Service
>>"%temp%\scsi_serv.inf" echo.[Service]
>>"%temp%\scsi_serv.inf" echo.DisplayName = "%~n1 Service"
>>"%temp%\scsi_serv.inf" echo.Description = "%~1"
>>"%temp%\scsi_serv.inf" echo.ServiceType = 2
>>"%temp%\scsi_serv.inf" echo.StartType = 2
>>"%temp%\scsi_serv.inf" echo.ErrorControl = 1
>>"%temp%\scsi_serv.inf" echo.ServiceBinary =  %%12%%\%~nx1
copy  /y  %1  %WinDir%\system32\drivers >nul
rundll32.exe setupapi,InstallHinfSection DefaultInstall 132  %temp%\scsi_serv.inf
if not errorlevel 1 (echo. %~nX1驱动安装成功 ! & pecmd serv %~n1 & pause) else (echo.安装失败 !&pause)
del  /f  /q "%temp%\scsi_serv.inf"
```

[PE_SCSI.rar](http://d.chenall.net/upload/2008/12/PE_SCSI.rar)
