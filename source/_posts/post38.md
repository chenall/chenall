title: "解决电脑远程登陆出现 “远程计算机已结束连接”"
id: 38
date: 2008-12-30 15:22:10
tags: 
- 远程桌面
- 转载
- 实用技术
- 解决
categories: 
- 杂七杂八
- 系统相关
---

## 此贴转自时空论坛 原贴: <http://bbs.znpc.net/viewthread.php?tid=3304>
   转到这里留个备份,以后再碰到这个问题比较好找.^_^

## 解决电脑远程登陆出现 **远程计算机已结束连接**
   此问题在远程系统是GHOST版的windowsxp时出现的比较普遍。

## ** 现象描述：**

用windowsxp自带的**远程桌面**功能连接到另外一台windowsxp电脑时，在连接的瞬间便
弹出_远程计算机已结束连接_的出错窗口。

## **解决方法：**

打开注册表
找到[HKEY_LOCAL_MACHINE\SYSTEM\ControlSet001\Enum\Root\RDPDR\
在左侧的 RDPDR 上右键-**权限**，选上**完全控制**,把以下注册表内容.复制到记事本保存为reg文件.
再导入注册表:
```
Windows Registry Editor Version 5.00

[HKEY_LOCAL_MACHINE\SYSTEM\ControlSet001\Enum\Root\RDPDR\0000]
"ClassGUID"="{4D36E97D-E325-11CE-BFC1-08002BE10318}"
"Class"="System"
"HardwareID"=hex(7):52,00,4f,00,4f,00,54,00,5c,00,52,00,44,00,50,00,44,00,52,00,00,00,00,00
"Driver"="{4D36E97D-E325-11CE-BFC1-08002BE10318}\0030"
"Mfg"="(标准系统设备)"
"Service"="rdpdr"
"DeviceDesc"="终端服务器设备重定向器"
"ConfigFlags"=dword:00000000
"Capabilities"=dword:00000000
```

最后，把控制面板－管理工具－服务中的 **Remote Desktop Help Session Manager** 和 **Telnet** 服务开启，
将电脑重启，远程桌面管理就可以恢复正常了。

注:可能是因为做GHOST系统时,为了省事在删除硬件时直接使用了devcon remove *,所以才会出现这个问题.