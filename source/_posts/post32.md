title: "批处理脚本整理之邮箱自动登录示范(亿邮首页eyou)"
id: 32
date: 2008-12-03 02:04:20
tags: 
- eyou
- 自动登录
- 批处理
categories: 
- 程序设计/批处理
---

有时想用批处理登录邮箱,如果这个邮箱登录支持GET方式的话只要构造一个URL地址提交就可以了,如果不支持上URL提交就不行了,这时可以参考以下代码

```
@echo off
::调用例子 call :登录 <用户名> <密码>
goto :eof
:登录 
>"%temp%\eyou.hta" echo  ^<form id="login" action="http://ssl.eyou.com/mail_login.php" method="POST"^>
>>"%temp%\eyou.hta"  echo ^<input name="LoginName" type="hidden" value="%~1" /^>
>>"%temp%\eyou.hta"  echo ^<input name="Password" type="hidden" value="%~2"/^>
>>"%temp%\eyou.hta"  echo ^<script^>
>>"%temp%\eyou.hta"  echo login.submit()
>>"%temp%\eyou.hta"  echo window.close()
>>"%temp%\eyou.hta"  echo ^</script^>
"%temp%\eyou.hta"
del /f "%temp%\eyou.hta"
```

上面的HTA也可以改为HTM,如果你的电脑不支持HTA的话.原理很简单,从上面的代码就可以看到.当然了,这个方法并不一定是最好的.用VBS或其它的工具一样可以实现.