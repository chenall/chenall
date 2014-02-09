title: "批处理检测外部命令是否存在的模块"
id: 99
date: 2009-09-29 21:29:21
tags: 
- IF_EXIST
- 批处理
- 原创
categories: 
- 程序设计/批处理
---

编写批处理时经常需要用到外部命令,一些常用的命令一般的系统都会有,但是一些精简的系统上可能就没有了,如果没有做判断就可能导致程序出现未知的错误.

一般检测文件是否存在可以使用
> IF EXIST filename 执行某个命令...

但是这样只能检测当前目录下或指定目录的,而批处理的外部命令通过PATH变量来确定位置的.正常情况下可以通过以下命令来确定这个外部命令是否存在,
> for %I in (find.exe) do if "%~$PATH:I"=="" echo find 命令不存在

为了以后方便就写了一个模块,用于判断命令是否存在.

```
@echo off
cls&echo.IF_EXIST.cmd by chenall 2009-09-29 http://www.chenall.net
echo.
echo.功能:
echo.   从环境变量PATH,当前目录,程序所在目录中查找指定的文件,如果找到就显示并返回值0,否则就返回1
echo.
echo.使用方法:
echo.   直接复制下面::模块开始::到::模块结束::之间的代码到你的批处理程序中.然后使用以下命令调用.
echo.   CALL :IF_EXIST xxxx.xxx
echo.
echo.使用例子:
echo.   CALL :IF_EXIST find.exe || echo.find.exe 不存在
echo.
echo.注:只是简单查找,并且不支持查找子目录.主要用于批处理中判断某个外部命是否存在.
echo.   实际应用中可以删除echo %~$PATH:1语句删除输出显示,或者在调用时加一个>nul
echo.
echo.
ECHO.以下是测试命令.
ECHO.查找FIND.EXE
CALL :IF_EXIST FIND.EXE || ECHO.FIND.EXE 不存在
CALL :IF_EXIST FIND.EXE >nul ||echo.出错了,find.exe不存在.
ECHO.查找noEXIST.FILE
CALL :IF_EXIST noEXIST.FILE || ECHO.noEXIST.FILE 不存在
PAUSE
GOTO :EOF

::::::::::::::::::::::::模块开始::::::::::::::::::::::::
:IF_EXIST       BY chenall QQ:366840202     2009-09-29
SETLOCAL&PATH %PATH%;%~dp0;%cd%
if "%~$PATH:1"=="" exit /b 1
echo %~$PATH:1
exit /b 0       http://www.chenall.net
:::::::::::::::::::::::模块结束:::::::::::::::::::::::::
```