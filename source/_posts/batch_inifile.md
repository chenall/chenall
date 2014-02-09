title: "【原创】批处理读取INI格式文件"
id: 109
date: 2009-11-06 19:19:32
tags: 
- batch
- inifile
- 原创
categories: 
- 程序设计/批处理
---

**批处理读取INI文件,以前无聊时写的.当时只是觉得好玩就尝试写了一下，原贴请看DOS联盟论坛**

http://www.cn-dos.net/forum/viewthread.php?tid=25789

最早的版本，发现了许多错误，而且使用了许多的SETLOCAL，经常会出错。后来优化了下，可以运行了，就一直都没有再去改过了。

最近DOS联盟论坛的朋友[blacksheep2000](http://www.cn-dos.net/forum/viewpro.php?uid=154086) 在使用时发现了一些问题，我就再查了一下代码，不查不知道，一查真是吓一跳，呵呵。

所以就重新整理了一下，这下应该可以用了。主要用于学习，由于批处理的执行效率比较低，正常情况下，请使用同类INIFILE.EXE代替。

欢迎有兴趣的朋友一起继续优化。相比第1个版本，执行效率提升了许多。

<!--more-->

```batch
@echo off
:::::::::INI文件读取 by chenall QQ:366840202::::::::::::::::::::::
::使用方法:                                                     ::
::    inifile iniFilePath [section] [item]                      ::
::例子:                                                         ::
::      inifile c:\boot.ini                                     ::
::      读取c:\boot.ini的所有[section]                          ::
::      inifile c:\boot.ini "[boot loader]"                     ::
::      读取c:\boot.ini [boot loader]段的内容                   ::
::      inifile c:\boot.ini "[boot loader]" timeout             ::
::      显示c:\boot.ini [boot loader]段 timeout的值             ::
::07-04-26 新增设置变量的功能,只需将下面的setvar=0改为1即可     ::
::09-11-05 重写并优化部份代码，修正不能正确设置变量的BUG        ::
::         100:文件不存在或未找到                               ::
::::::::::::::::::::::::::::::::::::::::::::2006-12-21::::::::::::
SETLOCAL
set setvar=1
::当有指定[item]参娄并且setvar值为1时就将[item]的值设为变量[item]
::例子inifile c:\boot.ini "[boot loader]" timeout 就可以得到一个%timeout%的变量

::初始化变量
set exit_code=
set item=
set item_value=inifile=没有找到指定项目!
set filepath=
set section=
set inifile=
if not "%~1"=="" (
        set filepath=%1
) else goto :file_err
if not exist %filepath% goto :file_err
if "%~2"=="" goto :section
set "section=%~2"
set "item=%~3"
call :开始
endlocal&if defined item set %item_value%
goto :eof

:开始
for /f "usebackq delims=[] skip=2" %%i in (`find /i "%section%" /n %filepath%`) do set 字段开始=%%i
if "%字段开始%"=="" goto :eof
for /f "eol=; usebackq tokens=1* skip=%字段开始% delims==" %%i in (`type %filepath%`) do (
        call :分析数据 "%%i" "%%j"
        ::强制退出，并返回一个退出代码
        if defined exit_code exit /b %exit_code%
)
goto :eof

:分析数据
set "a=%~1"
setlocal EnableDelayedExpansion
call :trim a
endlocal & set "a=%a%"
::如果获取到的第一个字符是"["，说明本节已经搜索完成。退出，返回0
if "%a:~0,1%"=="[" (set exit_code=0&goto :eof)
::分析数据，因为INI文件一般“;”以后是注释符，这里去掉注释。
for /f "delims=;" %%x in ("%a%=%~2") do (
        if not DEFINED item (echo %%x) else (
                if /i "%a%"=="%item%" (
                        set exit_code=0
                        if "%setvar%"=="1" (
                                set "item_value=%%x"
                        ) else (
                                echo %%x
                        )
                )
        )
)
goto :eof

:section
for /f "eol=; usebackq delims== skip=2" %%i in (`find /i "[" %filepath%`) do echo %%i
goto :eof

:trim
if "!%1:~0,1!"==" " (set %1=!%1:~1!&&goto trim)
if "!%1:~0,1!"=="       " (set %1=!%1:~1!&&goto trim)
if "!%1:~-1!"==" " (set %1=!%1:~0,-1!&&goto trim)
if "!%1:~-1!"=="        " (set %1=!%1:~0,-1!&&goto trim)
goto :eof

:file_err
echo.
echo %1文件未找到或未输入!
echo.
exit /b 100
goto :eof
```