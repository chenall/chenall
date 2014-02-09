title: "[分享]华军软件园免验证码下载"
id: 853
date: 2012-08-11 08:00:30
tags: 
- 破解
- 华军
- 原创
categories: 
- 实用文集
---

以前经常去华军软件园下载软件,后来很少上了,最近发现下载需要输入验证码才能下载.

这个验证码是带广告类型的,需要输入中文,很是麻烦,对于我等懒人来说当然是能不用输入就不用输入了.

查了一下网页源码,发现可以直接饶过验证下载.原理有兴趣的自己Google一下.^_^这里就不再啰嗦了.直接进入主题.

方法如下有很多种.
<!--more-->
1. 书签法,直接把以下链接存为书签,下载时点一下就自动通过验证了.
   书签1:  
   <a href='javascript:CustomDefinedAjaxOnkeyup(1);'>华军软件园免验证下载</a>
   书签2:  
   <a href="javascript:showDownlist(type,'checkok');">华军软件园免验证下载</a>

2.  使用admucher之类的自动通过验证.
   打开admucher在*My Filters*里面添加一条*Add Javascript to all pages*的规则(admucher 请使用这里的版本:<http://cjx82630.ys168.com/>)
	```
	if(__amscript_cd(“onlinedown.net”) && location.href.indexOf(“_2.”)!= -1){__amscript_addonload(“CustomDefinedAjaxOnkeyup(1);”)};
	```
3.  用admucher的文本替换功能(Replace Text)  
	Match text(匹配) :  *showDownlist(type,"checkno")*  
    Replacement text(替换): *showDownlist(type,"checkok")*  

注:前面的两种方法是自动验证,这个方法是饶过验证. 区别是前面的两种方法验证码处会有提示**正确 请选下载链接下载**

第3种直接从源头去掉验证过程,直接显示下载地址出来了.自己选一种方法使用就可以免去输验证码之苦了.嘿嘿.