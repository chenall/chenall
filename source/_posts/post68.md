title: "无需第三方工具Windows下隐藏限制磁盘访问."
id: 68
date: 2009-07-07 16:34:53
tags: 
- 限制
- 隐藏
categories: 
- 系统相关
- 实用文集
---

利用WINDOWS自身的功能通过修改注册表实现

1. 隐藏或显示某个磁盘,隐藏盘符在资源管理器中看不到

2. 限制某个磁盘不可访问(具体表现为双击这个盘符或直接运入中输入这个盘符时会出现如下提示)

<!--more-->
![](http://d.chenall.net/upload/2009/7/9E9989B32704B5B5600B4350CF797F2A27558ECE.jpg)

### 原理:

1. 注册表相关键值.  
	系统级,具体优先权.针对所有用户.  
  	```
   	HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\policies\Explorer
   	```
	或用户级,只针对某个用户.  
	```
	HKEY_CURRENT_USER\SOFTWARE\Microsoft\Windows\CurrentVersion\policies\Explorer
	```
	`NoDrives` 指定隐藏盘符.  
	`NoViewOnDrive` 指定限制盘符.  
	以上值在注册表中都是一个`REG_DWORD`数据.  

2. 数据和盘符的对应方法.
	将上面的REG_DWORD数据转换成二进制数.也就是**11110011**之类的数字.  
	从右边算起,第一位代表A,第二位代表B,依此类推.....  
	比如想要隐藏E,C盘.  
	可以按以下方法来得到这个值.  
	**GFEDCBA**  
	**0010100**  

	也就是把E,C对应的位设为1.然后再把这个二进制数转换16进制或10进制填入到上面的`NoDrives`中就可以了.
	限制的同上,只是改成`NoViewOnDrive`

	如果要显示只要把对应位置的1改成0再转成10进制就可以了.

### 附上一个修改的图文实例.  
隐藏T和W盘.未隐藏之前的截图.  
[![](http://d.chenall.net/upload/2009/7/438C41854D2FB23D9507B03BA68AEF41940ADBBF.jpg)](http://d.chenall.net/upload/2009/7/438C41854D2FB23D9507B03BA68AEF41940ADBBF.jpg)

修改方法.  

[![](http://d.chenall.net/upload/2009/7/44A715EAEF27205EAB10B28F030540937F8AA55B.jpg)](http://d.chenall.net/upload/2009/7/44A715EAEF27205EAB10B28F030540937F8AA55B.jpg)

[![](http://d.chenall.net/upload/2009/7/170A59A44BAE4436F37FA6166E6C3D617C9B246E.jpg)](http://d.chenall.net/upload/2009/7/170A59A44BAE4436F37FA6166E6C3D617C9B246E.jpg)

再点击一下十进制按钮.  

[![](http://d.chenall.net/upload/2009/7/809A9F036F53412097C5A47E0CAF1C1F08089F1F.jpg)](http://d.chenall.net/upload/2009/7/809A9F036F53412097C5A47E0CAF1C1F08089F1F.jpg)

最后得到的值是**4718592**
打开注册表.定位到上面的注册表位置.  
修改`NoDrives`的值为**4718592**.如果没有该值则新建一个.  

[![](http://d.chenall.net/upload/2009/7/1F5D11D6BDBFFC3B6CD203204E9937F5D32EAB7E.jpg)](http://d.chenall.net/upload/2009/7/15CA4B165BBA9D849BECF443CD91229DBFBC8D88.jpg)

修改完了就OK了,最终效果图.可以发现T,W已经看不到了.  

[![](http://d.chenall.net/upload/2009/7/FCBB865B0673DB563DF18FC6AB54E389B9B8880C.jpg)](http://d.chenall.net/upload/2009/7/FCBB865B0673DB563DF18FC6AB54E389B9B8880C.jpg)

### 其它说明
1. 修改后并不能直接反应出效果,只需要重启`EXPLORER.EXE`进程就可以了,或注销再进就可以看到了.
2. 限制磁盘访问的方法同上,只是注册表中修改的值变成了`NoViewOnDrive`
3. 以下注册表同样的值系统优先使用(第一个).
	```
	HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\policies\Explorer
	HKEY_CURRENT_USER\SOFTWARE\Microsoft\Windows\CurrentVersion\policies\Explorer
	```

