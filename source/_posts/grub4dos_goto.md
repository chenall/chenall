title: "[GRUB4DOS] 一个很简单的外部命令"
id: 125
date: 2010-01-30 14:15:53
tags: 
- GRUB4DOS
- 外部命令
- 原创
categories: 
- GRUB4DOS/扩展
---


## [功能说明]

用于菜单中，可以直接跳到另一个菜单项执行.

注：因为是调用`fallback`命令的功能

所以如果有使用`fallback`则使用这个命令之后之前的`fallback`设置就失效。

注: _这个只是演示一下GRUB4DOS外部命令的编写,在新版GRUB4DOS中已经直接支持_

## [下载地址]

  [http://grub4dos-chenall.googlecode.com/files/goto.zip](http://grub4dos-chenall.googlecode.com/files/goto.zip)

  GRUB4DOS最新版本下载

  [http://code.google.com/p/grub4dos-chenall/](http://code.google.com/p/grub4dos-chenall/)


## [使用方法]

### 例子：

```
default 1
 timeout 5

title 0.title 0
 pause title 0
#跳到菜单1.
 goto 1

title 1.title 1
 pause title 1
 #如果xxx.xxx文件存在跳到菜单2.
 ls /xxx.xxx &amp;&amp; goto 2

title 2.title 2
 pause title 2
```
 [其它说明]
 必须配合grub4dos 0.4.5a 2010-01-21以后的版本使用.
很简单的一个功能。

源码只有两行^_^够简单吧。

```
  builtin_cmd("fallback",arg,flags);
  return !(errnum = MAX_ERR_NUM);
```

这里顺便解释一下GRUB4DOS中fallback命令的用法

>fallback
  fallback NUM 进入无人干预启动模式：如果默认启动入口项出错失败，立即用入口项 NUM 来启动（这里的“入口项”与 default 命令中的“入口项”意义相同）。

可以指定多个入口项比如
 fallback 1 2 3 4
 这样当启动出错失败就跳到第1个菜单处执行，第一个菜单执行过程中出错失败就继续进入第2个菜单....
如果到第4个菜单还是执行失败则，提示出错信息。

 不加任何参数的`fallback`命令代表取消`fallback`的设置。

`fallback`可以用于智能控制`GRUB4DOS`的菜单的执行过程。

`goto`命令就是利用了`fallback`的原理。先指定一个入口，然后再返回一个失败信息。这样菜单指行时就会跳过去了。
