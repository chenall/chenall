title: "[OpenVPN] OpenVPN简单用户密码验证实例."
id: 64
date: 2009-05-27 18:45:22
tags: 
- auth-user-pass-verify
- openvpn
categories: 
- 系统相关/OpenVPN
description: 在OpenVpn中使用用户名和密码验证方法,实例

---

OpenVpn使用用户名和密码验证方法.本例为了方便使用是的批处理.

方法如下.

### 服务端
1. 在配置文件中添加如下语句,(如果已经有就修改一下)
	```
	#用于用户名和密码验证,使得可以在变量中取到密码.
 	script-security 3 system
 	#开启用户密码验证脚本,(脚本文件名author.cmd),使用环境变量的方式验证.
 	auth-user-pass-verify author.cmd via-env
	```
2. 产生一个author.cmd文件在配置文件同目录下.  
	内容如下.把以下内容另存为author.cmd.
	```
	@echo off
	::初使化
	set chk_pass=0&set chk_user=0&set chk_active=0
	for /f “skip=2 usebackq tokens=1,2,3 delims=,“ %%i in (`find /i “%username%,“ users`) do (
        if “%%i“==“%username%“ (
            set chk_user=1
            ::再进一步验证用户名和证书用户名,注释掉以下语句就可以了.
            ::if /i not “%username%”==”%common_name%” set chk_user=0
            if /i “%%k“==“1“ set chk_active=1
            if /i “%%j“==“%password%“ set chk_pass=1
        )
	)

	::验证通过，直接返回一个值，0代表验证通过。
	if “%chk_user%%chk_pass%%chk_active%“==“111“ exit /b 0

	::可选验证操作记录,如果不记录,直接删除或注释掉该代码就可以了
	echo.%time%        用户名:%username%        证书用户名:%common_name%验证失败!::::错误代码:%chk_user%,%chk_pass%,%chk_active% >>用户登录.log

	::验证失败,让程序返回一个失败值1.
	exit /b 1
	```

3. 脚本已经弄好了,接下来就是添加用户名和密码文件.上面的脚本指定的用户名和密码文件是存放在一个文件名为users的文件中.  
	在配置文件同目录中新建一个USERS文件.内容按以下格式添加.  
 	使用","作为分隔符,格式:用户名,密码,是否启用(1,启用,0,禁用)  
 	```
	用户,密码,启用
 	user1,passowrd1,1
 	user2,password2,0
	```

### 客户端

只要在配置文件中添加如下语句开启用户和密码验证即可使用.

```
auth-user-pass
#可选的语句,一般建议加上,用途,加上以后就不会在内存中保存用户密码.
auth-nocache
```
