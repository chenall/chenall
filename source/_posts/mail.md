title: "[原创]网易邮箱通用自动登录批处理脚本[2010-05-23更新]"
id: 60
date: 2009-05-13 21:14:14
tags: 
- 邮箱
- 自动登录
categories: 
- 程序设计/批处理
---


网易邮箱自动登录批处理脚本.具体请看里面的使用说明.

可以自动登录网易邮箱.批处理调用.

## 使用方法:
  * 直接在批处理里面输入用户名和密码.
  * 使用命令行方加参数启动.第一个参数为用户名和邮箱名,第二个参数为密码
  * 直接在本批处理中使用call :登录网易邮箱　邮箱地址 密码
    具体见下面的例子
    例子: call mail.cmd "mymail@163.com" "mypass"
    用户名是mymail@163.com密码是mypass登录到163邮箱

## 代码
把以下代码另存为一个批处理文件比如mail.cmd就可以使用了．

```
@echo off 
::网易邮箱自动登录批处理.===http://chenall.net=======chenall=================== 
::        使用方法. 
::                1,直接在批处理里面输入用户名和密码. 
::                2.使用命令行方加参数启动.第一个参数为用户名和邮箱名,第二个参数为密码
::                3.直接在本批处理中使用call :登录网易邮箱　邮箱地址 密码
::                  具体见下面的例子
::        例子: call mail.cmd "mymail@163.com" "mypass" 
::                用户名是mymail@163.com密码是mypass登录到163邮箱 
:: 
::用户名后面需要加邮箱后辍。如mymail@126.com(登录126邮箱) 或mymail@163.com(登录163邮箱) 
:: 
::如转载请保留完整出处!  http://chenall.net/2009/05/mail/
:: 最后修改日期　2010-05-23.

if not "%~2"=="" goto :登录网易邮箱
::直接在本批处理中使用call批量登录方法,按照下面的方法添加语句在本注释之后goto :eof之前就可以了
::call :登录网易邮箱 mymail@163.com my163pass
::call :登录网易邮箱 mymail@126.com my26pass

goto :eof

:登录网易邮箱
set "user=%1" 
set "pass=%2" 
if not defined user goto :eof 
if not defined pass goto :eof
::过滤用户名密码中的引号 
set user=%user:"=%&set pass=%pass:"=% 
setlocal enabledelayedexpansion 
::修改密码中出现的#和&,否则会登录不了 
set "pass=!pass:#=%%23!"
set "pass=!pass:&=%%26!"
endlocal&set "pass=%pass%" 
set user=%user: =% 
set pass=%pass: =% 
setlocal
for /f "tokens=1,2 delims=@" %%i in ("%user%") do ( 
	if /i "%%~nj"=="163" set "login.action=https://reg.163.com/logins.jsp?type=1&product=mail163&url=http://entry.mail.163.com/coremail/fcg/ntesdoor2?lightweight%3D1%26verifycookie%3D1%26language%3D-1%26style%3D" 
	if /i "%%~nj"=="126" set "login.action=https://reg.163.com/logins.jsp?type=1&product=mail126&url=http://entry.mail.126.com/cgi/ntesdoor?hid%3D10010102%26lightweight%3D1%26verifycookie%3D1%26language%3D0%26style%3D" 
	if /i "%%~nj"=="yeah" set "login.action=https://reg.163.com/logins.jsp?type=1&product=mailyeah&url=http://entry.mail.yeah.net/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26style%3D" 
	if /i "%%~nj"=="netease" set "login.action=https://reg.163.com/logins.jsp?type=1&url=http://entry.yeah.net/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26style%3D-1" 
	echo.正在自动登录%USER%的邮箱%%j……
) 
start "正在自动登录中" "%login.action%&username=%user%&password=%pass%" 
endlocal
goto :eof
```