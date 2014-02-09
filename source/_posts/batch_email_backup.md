title: "使用批处理自动定时备份文件到邮箱"
id: 95
date: 2009-09-14 13:43:59
tags: 
- batch
- VBScript
- 定时备份
- 批处理
- 自动备份
- 邮件
- 原创分享
categories: 
- 程序设计/批处理
---


因为需要,想让系统自动定时备份我的文件到邮箱上(只备份更新或新增加的文件),在网上找了许多软件要么是收费的,要么使用不方便.后来想起了以前收藏的一段 [VBSCRIPT发送邮件的代码](/post/VBS_SEND_MAIL/)就想到是否可以利用批处理自己写一个脚本来实现,所以就有了以下的代码,有兴趣的朋友可以一起继续完善,现在只能根据文件大小,日期.来确定是否上传.

批处理文件自动上传到邮件备份.功能:自动上传有更新的文件到指定的邮箱中(邮箱在SENDMAIL.VBS里面指定)

```bat
@echo off
::设定要备份的文件所在目录
set 备份目录=D:\Web\webdisk\USER\justway\佳为企管系列__商品流通 (商场,超市,百货,批发商贸,电器,家居,加工)

::首次运行检测
echo.%date% %time%  启动,正在检测.....>>%~dp0sendmail.log
if not exist "%~dp0Files.lst" goto :firstrun

::转入上面定义的备份目录.
pushd "%备份目录%"

::检测文件是否有更新
for %%i in (*.*) do call :check "%%i"

::重新创建文件信息列表files.lst(用于对比)
del "%~dp0files.lst"
for %%i in (*.*) do echo.%%i,%%~zi,%%~ti>>"%~dp0Files.lst"

popd
echo.%date% %time%  检测完成.....>>%~dp0sendmail.log
goto :eof


:check
Set send=
::根据上次备份时保存的文件列表对比文件的,时间,大小.如果不一样就通过sendmail.vbs命令行把文件上传到邮箱中备份.
::	如果文件没有在列表中说明是新的文件.
find /i %1 "%~dp0files.lst" || Set send=新的文件
if not defined send for /f "usebackq skip=2 tokens=1,2,3 delims=," %%i in (`find /i %1 "%~dp0files.lst"`) do (
    if "%%~i"=="%~1" (
        if not "%%j"=="%~z1" set send=文件大小发生改变.
        if not "%%k"=="%~t1" set send=文件日期发生改变.
    )
)
:: 记录日记.
if defined send echo.check,%~1,%send% >>%~dp0sendmail.log

:: 如果有设定了send变量说明文件是要上传的,就调用程序发送文件
if defined send cscript /nologo "%~dp0sendmail.vbs" "%~f1" "%1">>%~dp0sendmail.log

::%~f1	前面传入文件的完全路径. %1 ,传入的文件参数.
goto :eof

:firstrun
pushd "%备份目录%"
for %%i in (*.*) do echo.%%i,%%~zi,%%~ti>>"%~dp0Files.lst"
for %%i in (*.*) do cscript /nologo "%~dp0sendmail.vbs" "%%~fi" "%%~ni">>%~dp0sendmail.log
popd
goto :eof

rem 附:每天定时自动执行的命令.使用管理员的权限执行就可以了.
::  at 时间 /every:M,T,W,Th,F,S,Su "执行文件路径"
::例子,在每天的2点备份,本文件放在E:\TEST\autobackup.cmd
::
:: at 02:00 /every:M,T,W,Th,F,S,Su "E:\TEST\autobackup.cmd"
```

PS:因为我需要上传的文件都在50MB以内,而大多邮箱的附件在15-50MB左右.我使用的是QQ邮箱有50MB有附件大小.由且邮箱容量是无限的,所以就用来备份文件了.呵呵,利用一下.
