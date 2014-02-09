title: "【分享】小技巧，两条命令解决WIN7安装后改MBR启动失败问题"
id: 105
date: 2009-10-29 16:27:05
tags: 
- Windows 7
categories: 
- 系统相关
- 实用文集
---


从VISTA开始，系统和硬盘是紧密相联的，只要改动了MBR就有可能出现启动失败的问题。出现如下错误提示代码。

 <font color="#0000FF">Status: 0xc000000d</font>

TIPS：在硬盘MBR的偏移 **0x1B8** to 0x1BB是这个硬盘的签名信息，WINOWS 系统通过这个信息来找到硬盘，在XP时代如果有两个硬盘的签名信息一样系统启动过程中会自动改掉，如果失败就会出现0X7B蓝屏信息。如果有注意的话就会发现，你只要改动上面的信息，重启系统后，系统会重新分配盘符（表现为你调整好的盘符乱掉了）。

最近在试用WINDOWS 7，因为我经常在折腾我的电脑，也是经常碰到这个问题。按照以前的解决方法如下

*   首先想办法启动到PE或另一个系统中
*   然后执行bcdedit 命令进行修复
    ```
    bcdedit /store c:\boot\bcd /set {default} device partition=c:
    bcdedit /store c:\boot\bcd /set {default} osdevice partition=c:
    ```
    说明:**c:\boot\bcd** 指定启动时使用的BCD文件 
    后面的**c:** 指定WINDOWS 7系统目前所在的盘符（如果进入PE后，你的WIN7安装磁盘的盘符是F:就写F:）
*   重启就会发现一切正常了。


后来一次在测试中意外发现了另一个参数（这里首先得感谢下[无忧启动论坛](http://bbs.wuyou.com/)的[victor888](http://bbs.wuyou.com/viewpro.php?uid=131142) ,被他逼着学习bcdedit了，所以就多了解了一下，纯属意外），可以永绝祸患，只要改一下，以后就不会再出现这种问题了。不敢独享，如果有碰到同样问题的朋友可以试下，没有碰到的朋友也可以试下。^_^

当然了我只是在自己的电脑测试过，有没有效果要靠大家的测试了。说不多说，进入正题，请看下面的命令

首先进入WINDOWS 7系统，使用管理员权限打开CMD命令窗口，然后输入以下命令。
```
bcdedit /set {current} device boot
bcdedit /set {current} osdevice boot
```

适用情况：系统安装在硬盘上，并且和启动文件BOOTMGR在同一个分区上。

其中:一般情况下以上的命令不需要修改可以直接使用，{current}代表当前系统。boot 代表启动分区。

如果执行失败了可以把{current}改成你的WINDOWS 7的启动GUID（BCDEDIT命令可以查看）