title: "[原创]华为网盘免密码一键登录(2012-08-21更新)"
id: 835
date: 2012-06-18 19:09:55
tags: 
- 一键签到
- 免密码
- 华为网盘
- 自动登录
- 自动签到
- 原创
categories: 
- 实用文集
---

因为最近在折腾的自动签到程序，之前使用模拟的方法登录，速度慢，而且很容易出错。

所以就想使用post的方法快速登录。

经过抓包分析终于搞定了，以下是原理。

post 的地址是 http://login.dbank.com/loginauth.php?nsp_app=48049

参数如下:

*   response 最关键的参数，经过一系列计算得到
1. 用户名+":NSP Passport:"+密码 进行32位md5计算。（小写）
  测试时可以利用以下地址的在线工具进行计算
  http://app.baidu.com/yiten_md5?keyword=MD5
2. 上面的结果再 + ":" + nonce 进行32位md5计算.(小写)，得到的就是response的值。

* nsp_user 用户名
* nsp_cid 从表单中提取
* nonce  从表单中提取
* m=1 固定值。

提交以上参数之后如果参数正确的话返回json数据里面包含了一个k的数据。

最终再提交一下以下地址就行了。k的值从上面的返回中获取，如果没有看到k的值肯定是你前面提交的参数错了。

http://login.dbank.com/loginauth.php?k=K的参数

附，测试登录过程。

测试帐号 test@chenall.tk 密码： wMtA8HscF6G0Zv6V

打开 http://login.dbank.com/loginauth.php?nsp_app=48049
提取到需要的数据

```
<input type="hidden" id="nonce" name="nonce" value="4fdf0b700b0052.91924864">
<input type="hidden" id="nsp_cid" name="nsp_cid" value="802fdd1049992984cf49a1cd0fc7545c">
```

2012-08-21 更新: 发现上面这一步可以省略,nonce是一个随机值,你可以自己随便生成一个随机数就行了.nsp_cid参数可以省略,不需要.

首先计算response的值:

<span style="color:#ff0000;">test@chenall.tk</span><span style="color:#ff00ff;">:NSP Passport:</span><span style="color:#ff0000;">wMtA8HscF6G0Zv6V</span>

经过md5计算后得到

<span style="color:#ff00ff;">aead43fd1435a2087a12c4ac9d21e56c</span>

再进行一次md5计算

<span style="color:#ff00ff;">aead43fd1435a2087a12c4ac9d21e56c</span><span style="color:#ff0000;">:4fdf0b700b0052.91924864</span>

得到

<span style="color:#ff00ff;">9cd84c2500a6013ef3bd1441919132b6</span>

现在参数全部有了直接提交（用get或post都可以）

<http://login.dbank.com/loginauth.php?nsp_app=48049&m=1&nonce=4fdf0b700b0052.91924864&nsp_cid=802fdd1049992984cf49a1cd0fc7545c&nsp_user=test@chenall.tk&response=9cd84c2500a6013ef3bd1441919132b6>

返回的数据如下(如果是其它信息肯定是你的参数有误或用户密码错误改正之后重新提交)
```
{"retcode":0,"k":"IFi6cylxBlRZsRw21JIiDtxO6ORZGun5VLViD52OOuj3dN0ylLoeHDw3ruaa1S4RFTP1Y0q8vazTvjDUjJiSu0aFSWIQ9lEgIbPSdcKCCDo%3D"}
```

再提交一次就成功登录了 <http://login.dbank.com/loginauth.php?k=IFi6cylxBlRZsRw21JIiDtxO6ORZGun5VLViD52OOuj3dN0ylLoeHDw3ruaa1S4RFTP1Y0q8vazTvjDUjJiSu0aFSWIQ9lEgIbPSdcKCCDo%3D>

另外要说一点，看起来挺安全的，因为没有传输密码。但是好像有一个问题。最终的登录地址目前没有任何的限制。只要得到这个地址，你换一台电脑直接提交这个地址就可以登录了，这也是一个安全隐患。不知有没有时间限制，我试了昨天生成的地址，今天还能用。
大家可以试试点击上面的链接，看看是不是还能正常登录。
2012-06-21  经测试修改了密码之后，上面的自动登录链接依然有效。
2012-06-25  一个星期过去了，依旧。
2012-06-26  发现其它的也是一样，只要获取到最终的API参数，无需登录或密码都可以操作。比如签到不需要登录就行了。
2012-08-21  登录的第一步获取nonce等值的过程可以省略了.具本看前面的介绍
            题外话，本来想把网盘签到的post方法也找出来，里面最重要的参数是nsp_key，这个是把很多的数据整在一起进行MD5计算，看了好久还没有找全所有的需要的数据。无奈只能放弃，如果您有已经研究出了计算的方法，不妨分享一下。
2012-06-26 已经找出计算方法，现在可以直接快速签到了。^_^，chrome真是强大，调试一下很快就找出来了，以前还傻傻的慢慢看JS源码。。

### _快速自动签到方法，只需点击一个链接就可以自动签到无需密码,无需登录_,
本文测试帐号的自动签到链接如下:
<http://api.dbank.com/rest.php?nsp_svc=com.dbank.signin.signin&anticache=383&nsp_sid=wuTubNKuCQi1muaOXx-uu4FjnYp182zozF58ZBk1HSNkFwED&nsp_ts=1341032380236&nsp_key=9AC41E0B0DD240F97361F87483131667&nsp_fmt=JS&nsp_cb=_jqjsp>
如何获取到上面的链接呢？最简单的方法直接抓包就行了，用chrome就可以直接抓包了。
当然可以手工打造一个链接，要生成这个链接首先要知道各个参数是如何得来的。
上面的链接参数解释(其中不重要的参数可以不要)
* nsp_svc是固定的，表示要进行签到 `nsp_svc=com.dbank.signin.signin`
* anticache 是一个随机数字，不重要
* nsp_sid 身份标志信息，这个就是cookie里面的session的值
* nsp_sid=kuTubNkuCQi19uaOXxiuu4FjMYp18kTozF5VnBk1HnAkFwEv
* nsp_ts  这个不需要解释了，是一个时间串，~~不是很重要，同样可以固定~~
* nsp_key 验证信息，通过多种参数进行组合再进行MD5加密的结果 nsp_key=9AC41E0B0DD240F97361F87483131667
* nsp_fmt=JS&nsp_cb=_jqjsp 这个参数也不重要,可以省略
看了上面的参数列表，基本上都是现成的，只有nsp_key需要额外获取。
这个nsp_key的获取方法:
1. 把上面除了nsp_key之外的参数按字母正向排序一下,得到如下结果。
```
anticache=383
nsp_cb=_jqjsp
nsp_fmt=JS
nsp_sid=wuTubNKuCQi1muaOXx-uu4FjnYp182zozF58ZBk1HSNkFwED
nsp_svc=com.dbank.signin.signin
nsp_ts=1341032380236
```
       
2. 去掉参数中间的`=`合成一串得到_anticache383nsp_cb_jqjspnsp_fmtJSnsp_sidwuTubNKuCQi1muaOXx-uu4FjnYp182zozF58ZBk1HSNkFwEDnsp_svccom.dbank.signin.signinnsp_ts1341032380236_
3. 获取cookie里面的secret的值接在上一步的前面比如是`325c8b0ee26aa42cd4a4c20326a97a98`那最终得到的字符串如下
   <div><span style="color:#ff0000;">325c8b0ee26aa42cd4a4c20326a97a98</span><span style="color:#b22222;">anticache383nsp_cb_jqjspnsp_fmtJSnsp_sid</span><span style="color:#ff0000;">wuTubNKuCQi1muaOXx-uu4FjnYp182zozF58ZBk1HSNkFwED</span><span style="color:#b22222;">nsp_svccom.dbank.signin.signinnsp_ts1341032380236</span></div>
4. 把上一步的字符串进行MD5计算就得到了nsp_key的值了`9AC41E0B0DD240F97361F87483131667`
5. 现在所有参数都有了，组合成前面的链接就行了，**这个链接经过我测试就像前面的自动登录链接一下一直有效。** 需要自动签到很简单，只需要定时打开该链接就行了，根据返回的结果还可以获取签到的结果。

PS: 请继续看本文尾部，有更新的方法哦。

整理一下本文的自动登录和签到链接

[自动登录测试](http://login.dbank.com/loginauth.php?k=IFi6cylxBlRZsRw21JIiDtxO6ORZGun5VLViD52OOuj3dN0ylLoeHDw3ruaa1S4RFTP1Y0q8vazTvjDUjJiSu0aFSWIQ9lEgIbPSdcKCCDo%3D)
[自动签到测试](http://api.dbank.com/rest.php?nsp_svc=com.dbank.signin.signin&anticache=383&nsp_sid=wuTubNKuCQi1muaOXx-uu4FjnYp182zozF58ZBk1HSNkFwED&nsp_ts=1341032380236&nsp_key=9AC41E0B0DD240F97361F87483131667&nsp_fmt=JS&nsp_cb=_jqjsp)

大家有兴趣可以试试点击以上这两个链接，看看可以用多久，，目前自动登录的链接在本文发表日期6月18日获取的，目前6月30号，依然有效。
EDIT: 发现现在的签到的链接是有限制的（前几天我测试时好像没有限制），所以。。。只好每次都重新生成了,也简单，只需要获取登录之后cookie里面的`secret`和`session`的值替换进去就行了，其它的都不需要变。
我算是知道为什么华为网盘的页面打开速度反应偏慢了。你想啊，每打开一个页面，都需要调用10个以上的API，每个都需要经过一系列的MD5计算能不慢吗。而且经过这么复杂的计算个人认为没有增加什么安全性可言，只是人为增加客户端和服务端的计算量。
建议参考一下其它的网盘，登录后可以直接调用API，而不需要这么麻烦。像天翼网盘，登录之后直接
http://cloud.189.cn/userInfoJson.action 就可以获取用户信息
http://cloud.189.cn/userSign.action  签到
看起来又直观，又简单，真搞不明白华为为什么要搞得这么复杂，我猜测可能是为了和其它API的调用保持一致吧。

EDIT2: 经测试，那些参数中有一些是可以不要的。重新整理一下必备参数如下.只有需要两个参数了。
```
nsp_sid=wuTubNKuCQi1muaOXx-uu4FjnYp182zozF58ZBk1HSNkFwED
nsp_svc=com.dbank.signin.signin
nsp_ts 参数后面的值可以不要，但nsp_ts字符串须要有
```
最终的链接地址为因为参数少了，链接里面的参数也要相应的减少.
<http://api.dbank.com/rest.php?nsp_svc=com.dbank.signin.signin&nsp_ts=&nsp_sid=wuTubNKuCQi1muaOXx-uu4FjnYp182zozF58ZBk1HSNkFwED&nsp_key=501171C21D5EDB90BFF7080F2002F348>

EDIT3: 2014-01-15 由于搏客转移到HEXO,文章重新整理了下,新的API有改变 nsp_ts是必须的而且不能和服务器的时间差太多,在php中可以用time()获取.
由于API有了一些变化,另外华为网盘已经有相关的API文档了,上面的计算方法大部份都可以从API文档中找到,估计上面的链接应该都失效了,懒得重新获取了.留本文作为研究记录,