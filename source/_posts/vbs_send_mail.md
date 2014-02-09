title: "[转] Windows 下命令行/VBS脚本,发送带附件邮件."
id: 93
date: 2009-09-09 12:16:38
tags: 
- VBScript
- VBS发邮件
- 邮件附件
- 转载
categories: 
- 程序设计/VB/VBScript
---

利用`VBScript`发送邮件,以前从网上找的代码,不知原来的出处了.也不知作者是何人.....

挺有用的脚本,我就一直在使用这个脚本来发邮件,还可以带附件.放在这里做个备份,免得到时又找不到了.

目前我就通过批处理配合这个脚本来自动备份我的一些文件到邮箱里面.每天自动定时备份.

反正许多邮件的空间是无限的,,用来作备份也是挺不错的.一般都可以上传30-50MB附件,基本上够用了.

```vb
'code by NetPatch
'VBS发送邮件参数说明
'You_Account：你的邮件帐号
'You_Password:你的邮件密码
'Send_Email: 主要邮件地址
'Send_Email2: 备用邮件地址
'Send_Topic: 邮件主题
'Send_Body:邮件内容
'Send_Attachment:邮件附件
function Send_mail(You_Account,You_Password,Send_Email,Send_Email2,Send_Topic,Send_Body,Send_Attachment) 
    You_ID=Split(You_Account, "@", -1, vbTextCompare) 
    '帐号和服务器分离
    MS_Space = "http://schemas.microsoft.com/cdo/configuration/"
    '这个是必须要的，不过可以放心的事，不会通过微软发送邮件
    Set Email = CreateObject("CDO.Message")
    Email.From = You_Account
    '这个一定要和发送邮件的帐号一样
    Email.To = Send_Email         '主要邮件地址

    If Send_Email2 <> "" Then
	Email.CC = Send_Email2        '备用邮件地址
    End If

    Email.Subject = Send_Topic        '邮件主题
    Email.Textbody = Send_Body        '邮件内容

    If Send_Attachment <> "" Then
	Email.AddAttachment Send_Attachment     '邮件附件
    End If

    With Email.Configuration.Fields
	.Item(MS_Space&"sendusing") = 2       '发信端口
	.Item(MS_Space&"smtpserver") = "smtp."&You_ID(1) 'SMTP服务器地址
	.Item(MS_Space&"smtpserverport") = 25     'SMTP服务器端口
	.Item(MS_Space&"smtpauthenticate") = 1     'cdobasec
	.Item(MS_Space&"sendusername") = You_ID(0)    '你的邮件帐号
	.Item(MS_Space&"sendpassword") = You_Password   '你的邮件密码
	.Update
    End With
    Email.Send
    '发送邮件
    Set Email=Nothing
    '关闭组件

    Send_Mail=True 
    '如果没有任何错误信息，则表示发送成功,否则发送失败 
    If Err Then 
	Err.Clear 
	Send_Mail=False 
    End If 
End Function

'以下是利用上面的函数发送带附件的邮件例子

Attachment=wscript.Arguments(0)
Topic="chenall_soft;"+Attachment
Set objIE = CreateObject("InternetExplorer.Application") 
objIE.Navigate("about:blank") 
Body = objIE.document.parentwindow.clipboardData.GetData("text") 
objIE.Quit
set objie=nothing

'set oArgs = wscript.Arguments
'while iIndex < oArgs.Count
'wscript.echo oArgs(iIndex)
'       iIndex = iIndex + 1
'wend

If Send_Mail("USERNAME","PASSWORD","sendto","",Topic,Body,Attachment)=True Then
    Wscript.Echo "发送成功"
Else
    Wscript.Echo "发送失败"
End If
```