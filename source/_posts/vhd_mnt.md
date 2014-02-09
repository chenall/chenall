title: "[原创] VHD_MNT VHD文件快速挂载/卸载工具"
id: 667
date: 2011-04-29 00:38:14
tags: 
- vhd
- vhdmount
- 系统相关
categories: 
- 程序设计/批处理
---

VHD_MNT 是使用批处理写的一个小程序 ,

可以在WIN7以上的系统中使用.

用于快速挂载/卸载VHD虚拟磁盘.

依赖程序: 系统自带的diskpart,reg,find三个命令.

特点: 不使用第三方工具,不生成临时文件.使用方便.你需要做的只是双击.

2011-04-29 新增支持右键快速创建`差异磁盘`功能.

【使用方法】很简单两个关键字`双击`

*   使用了智能检测代码,所以需要做的就是`双击`.
*   安装: 直接`双击`运行本程序.
*   卸载: 直接`双击`运行本程序.
*   使用: 直接`双击`要挂载/分离的VHD文件. 

【批处理代码】

```
@echo off
if "%~n1"=="" goto :install
set "diskpart=echo exit|%ComSpec%/kprompt %%dsc%%$_|diskpart"
if "%~1"=="PARENT" goto :PARENT

:attach
title ====VHD_MNT by chenall======正在自动检测....
set dsc=list$Svdisk
%diskpart%|find /i "%~1" >nul && goto :detach
title ====VHD_MNT by chenall====@@附加VHD@@ %*
set dsc=select$Svdisk$Sfile="%~f1"$_attach$Svdisk$S%2$_
goto :diskpart

:detach
title ====VHD_MNT by chenall====@@分离VHD文件@@%*
set dsc=select$Svdisk$Sfile="%~f1"$_detach$Svdisk$_
goto :diskpart

:PARENT
shift
for /l %%i in (1,1,99) do if not exist "%~dpn1_s%%i.vhd" (set "file=%~n1_s%%i.vhd"&goto :create)

exit /b

:create
title ====VHD_MNT by chenall====@@创建差异VHD文件@@
echo.
echo.
echo. VHD_MNT 创建一个差异VHD镜像文件.
echo. 来源: %1
echo.
echo. 请输入要创建的差异VHD文件名.直接回车使用%file%
echo. 注:不要输入路径名.
echo.
set /pfile=差异VHD:
set dsc=create$Svdisk$Sfile="%~dp1%file%"$SPARENT="%~f1"$_
title ====VHD_MNT by chenall====@@创建差异VHD文件@@%file%

:diskpart
%diskpart%
pause
exit /b

:install
reg query "HKCR\.vhd\shell\@附加/分离\command" /ve 1>nul 2>nul && goto :uninstall
reg add "HKCR\.vhd\shell\@附加/分离\command" /d "vhd_mnt.cmd %%1" /f >nul
reg add "HKCR\.vhd\shell\创建差异VHD\command" /d "vhd_mnt.cmd PARENT=%%1" /f >nul
reg add "HKCR\.vhd\DefaultIcon" /d "%%SystemRoot%%\\system32\\shell32.dll,8" /f >nul
copy /y "%~f0" "%SystemRoot%\system32\vhd_mnt.cmd" >nul
echo.
echo. .VHD文件默认文件设置完成.
echo.
echo. 现在可以直接双击.VHD文件来自动挂载/卸载了(如果已经挂载再次双击该文件时自动卸载)
echo. 
echo. VHD文件快速挂载/卸载工具 by chenall 2011-04-29
echo.				http://chenall.net/post/vhd_mnt
pause
exit

:uninstall
echo.
reg delete "HKCR\.vhd\shell" /f >nul
del /f "%SystemRoot%\system32\vhd_mnt.cmd"
echo.
echo. 已经取消.VHD的默认关联,如果需要双击VHD自动挂载/卸载请再次执行本程序.
echo.
echo. VHD文件快速挂载/卸载工具 by chenall 2011-04-29
echo.				http://chenall.net/post/vhd_mnt
pause
exit
```