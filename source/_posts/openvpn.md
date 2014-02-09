title: "[分享] WINDOWS OpenVPN安装实战"
id: 61
date: 2009-05-15 16:20:09
tags: 
- openvpn
- WINDOWS
categories: 
- 系统相关/OpenVPN

---

利用OpenVPN实现虚拟网实战.之前一直使用SOFTETHER,因为它配置简单,使用方便.而且它也支持RIP协议,方便自动配置路由.SOFTETHER可以从这里下载,

[http://www.onlinedown.net/soft/34495.htm](http://www.onlinedown.net/soft/34495.htm)

现在由于SOFTETHER 已经不支持VISTA之类的系统了,所以想寻找一个替代品.OpenVpn 之前也有尝试过,可能是当时还不懂配置或是什么其它的原因,发现它不支持RIP路由协议.而且配置也不方便所以就没有使用了.

最近又尝试了一下,发现它支持RIP和OSPF路由协议了,这里记录一下安装过程,供有需要的人参考.

需要准备的软件OpenVpn可以从它的主页下载.[http://openvpn.net/index.php/downloads.html](http://openvpn.net/index.php/downloads.html)

本文是使用2.1RC15版配置的.其它版本应该差不多.

<!--more-->

一.下载并安装OpenVpn软件.

二.配置 分服务端和客户端. 

先在服务器上装好OPENVPN软件.

首先: 下面有部份是DOS命令,看你习惯,比如复制文件你可以用WINDOWS资源管理器复制或直接使用下面例子中提供的命令.

* 首先是证书的生成.   
	进入CMD模式,转到**OpenVpn**安装目录的**easy-rsa**目录.默认的安装目录是**C:\Program Files\openvpn\easy-rsa**,可以按以下方法进入.
	点开始->运行->输入**cmd.exe**(进入CMD环境)
	输入以下命令进行以上目录.
	```bat
	cd /d "C:\Program Files\openvpn\easy-rsa"
	::运行init-config.bat初使化配置文件.
	init-config.bat
	notepad vars.bat
	```
	打开VARS.BAT修改后面内容,根据具体情况修改.也可以不改...
	```bat
	REM 国家中国设为CN
	set KEY_COUNTRY=CN
	REM 省份,例子FUJian
	set KEY_PROVINCE=FuJian
	REM 城市,本例ShiShi
	set KEY_CITY=ShiShi
	REM ORG,公司/组织
	set KEY_ORG=chenall.com
	REM 邮箱地址,
	set KEY_EMAIL=admin@chenall.net
	```
* 经过以上初始化.开始生成服务器需要的证书
	还在是上面的命令行窗口中依次执行以下命令   
	```
	vars.bat
	clean-all.bat
	build-ca.bat
	```
	build-ca执行需要输入一些参数,具体参数就是上面VARS.BAT修改的内容.(一般可以使用默认即可,也就是直接回车)
	需要注意是的.以下必须输入(可以输入服务器名或你的用户名,随意),例子:

	*Common Name (eg, your name or your server's hostname) []:* **chenall**

	接下来一路回车就生成了CA根证书.

	```
	build-dh.bat
	```

	生成一个dh1024.pem文件(服务器需要)这一步需要的时间比较长一分钟左右吧.

	```
	build-key-server.bat server
	```

	生成服务端密钥:同build-ca过程差不多**Common Name**也是必须的.(其它的默认就可以,最后提示[y/n]全部按y就可以)
	其中可选的设置,以下设定一个密码(如果服务端这里设置了密码,后面客户端同样要设置而且要一样).
	```
	A challenge password []:
	```

* 生成客户端需要的证书.(以后每增加一个客户端就执行一次以下命令,只要common name不要一样就可以)
	```
	build-key.bat client
	```
	过程和前面的一样,**Common Name**不要和服务器一样,一般是使用客户端的计算机名.(可以放在U盘上复制到客户端电脑上)
	
* 服务端配置.
	1. 服务器只需要以上第二步生成的证书即可.复制上面的证书到OpenVPN的CONFIG目录(也可以在WINDOWS用文件操作去复制)
		需要复制的文件**CA.CRT**,**dh1024.pem**,**SERVER.CRT**,**SERVER.KEY**(在CMD中使用以下命令复制)
		```
		for %i in (ca.crt,dh1024.pem,server.crt,server.key) do copy keys\%i /y ..\config\
		```
	2. 复制openvpn安装目录下sample-config目录里面的server.ovpn文件到config目录下.(附CMD命令)
		```
		copy ..sample-configserver.ovpn ..config
		```
	3. 打开并修改server.ovpn文件.(也可以不修改,跳过这一步)
		```
		notepad ..configserver.ovpn
		```
		具体修改方法可以参考网上的其它文章.
	4. 运行桌面上的OpenVPN GUI程序,会在系统栏上显示一个图标,只要右键点击,弹出菜单,选择connect连接上图标变绿了服务器就可以了.

* 客户端配置
	1. 同样安装OPENVPN软件在客户端上面.
	2. 从服务器上复制客户端需要的证书到config目录.
	   需要的文件.**ca.crt**,**client.crt**,**client.key**
	3. 复制sample-config目录下的client.ovpn文件到config目录.
	4. 打开并修改CLIENT.OVPN找到以下内容.
		**my-server-1**修改为你的服务器IP保存就可以了.
		remote my-server-1 11945.
	5. 运行桌面上的OpenVPN GUI程序,会在系统栏上显示一个图标,只要右键点击,弹出菜单,选择connect连接上图标变绿了就可以了.
	6. 每添加一个客户端就先生成一个客户端证书,然后再客户端配置

这样就可以使用了,很简单吧.

提醒: 在生成证书后请注意备份和保管好你的证书文件,最重要的是CA根证书,请备份CA.*文件

注: 以上是默认配置,更多的配置需要修改SERVER.OVPN和CLIENT.OVPN文件,英文看得懂的可以自己尝试修改下,否则可以上Google找一下.

