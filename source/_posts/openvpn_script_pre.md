title: "[OpenVPN] OpenVPN脚本应用之--简介."
id: 63
date: 2009-05-19 09:29:43
tags: 
- openvpn
- 脚本
categories: 
- 系统相关/OpenVPN
description: OpenVPN,可以在一些特定的情况下自动运行多种脚本,通过这些脚本,可以实现很多非常有用的功能.还可以提高安全性.

---

经过几天的试用,发现OpenVPN的稳定性还是挺不错的,而且功能也很强大,可以丢掉**SoftEther**了.

OpenVPN,可以在一些特定的情况下自动运行多种脚本,通过这些脚本,可以实现很多非常有用的功能.还可以提高安全性.

例子.

验证证书的时候,*tls-verify* 

用户和密码验证脚本.*auth-user-pass-verify *

使用好这些脚本,可以实现OpenVPN的统一管理,证书密码,权限之类的.

例举几个比较实用的功能,

1.  可以通过这些脚本来管理证书.  
 	一般情况下证书如果丢失了需要吊销(使用<span style="background-color: yellow; color: #ee6600" id="Mark">REVOKE-full.bat</span>脚本来处理),这样子吊销可能比较麻烦.   
	其实通过一些自动运行的脚本同样可以达到这种目的,还可以通过数据库统一管理,在脚本里面自动连接数据库,根据数据库里面的内容来确定这个证书是否充许使用.  
	*tls-verify* **cmd**  

	注:也可以在其它地方验证.(一般情况下还是使用这个来验证.因为这个是每一个小时自动验证一次的,验证通过就保持连接,否则就断开连接)

2. 使用用户名和密码验证.  
	*auth-user-pass-verify* **cmd [via_env|via-file]**

	同样的可以通过脚本连接到数据库来管理用户. 

3.  禁止某个IP登录./只充许部份指定的IP进行登录.  
	在大部份自动运行的脚本中都可以应用.

4.  在连接或断开时自动运行.
	*up* **cmd**(在连接上以后执行,可以用于处理路由等)   
	*down-pre* **cmd** (在断开之时执行,)   
	*down* **cmd**(在断开之后执行)  

要注意的是.
在OpenVPN 2.1_rc9.以后的版本中配置文件中要使用如下语句

*script-security* 2 system(不保存密码在环境变量中)或*script-security* **3** system(保存密码在环境变量中)

当使用

*auth-user-pass-verify* cmd via_env

验证密码时,如果*script-security* **2**时就不能验证密码了,需要使用*script-security* **3**


后面SYSTEM参数的作用是,

The **method** parameter indicates how OpenVPN should call external commands and scripts. Settings for **method:**

* **execve** -- (default) Use execve() function on Unix family OSes and CreateProcess() on Windows.   
* **system** -- Use system() function (deprecated and less safe since the external program command line is subject to shell expansion).


如果不加这个参数使用默认的(**execve**),那在执行脚本时一般情况下只能使用内置命令.

(当然了这个环境也可以说比较安全).可以通过指定路径来运行外部程序,但不一定都是可以运行成功的.

使用**SYSTEM**参数后,就可以得到一个比较完整的环境

例子.脚本是一个批处理文件.
```
up test.cmd  
```
test.cmd内容就以下一句话  
```
@set>test.log
```
使用加SYSTEM参数前后对比生成文件的内容就可以发现其中的区别.
```