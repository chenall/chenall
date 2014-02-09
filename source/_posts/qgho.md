title: "[原创]QGHO 快速一键恢复程序(2011-01-02更新)"
id: 624
date: 2010-12-29 22:49:14
tags: 
- GRUB4DOS
- Qgho
- GHOST
- 原创
categories: 
- 程序设计/综合
---

[说明]
   QGHO是一个用于演示GRUB4DOS功能的小程序.
 可以快速全自动/手动 备份恢复分区.(使用GHOST内核).
 目前为止最快速/最小巧的基于DOS+GHOST的备份恢复程序.
 BUG报告或其它资料请移步我的搏客
 [http://chenall.net/post/qgho/](http://chenall.net/post/qgho/)

### [注意事项]
 1. 必须安装在硬盘上使用,因为默认是备份第一硬盘第一分区到第一硬盘最后分区的.
    如果U盘启动可能会备份到U盘中
 2. 如果需要修改默认设置请看QGHO.SET文件.里面有详细说明.
 3. 文件列表:(所有文件都是必须的)
```
GRUB4DOS.MOD  GRUB4DOS 外命模块(使用GZ压缩过了)
 QGHO.BIN  MSDOS软盘最小化镜像
 QGHO.LST  QGHO启动菜单文件,使用GRUB4DOS调用.
 QGHO.SET  QGHO配置文件,可以修改默认设置.
 QGHO.ZIP  GHOST程序文件,可以替换里面BIN目录下的GHOST.EXE为其它版本.
                                  auto.bat 会在启动的时候自动执行.目前只是简单的备份恢复命令.
 QGHO.TXT  说明文件.
```
 4. 必须使用GRUB4DOS 2010-01-01之后的版本才可以使用.

 5. 转载或修改请保留出处.

主要是为了展示GRUB4DOS的功能,,QGHO更多的扩展功能等待你去挖掘......

### [使用方法]
 直接复制QGHO目录到某个硬盘的根目录下,在你的GRUB4DOS菜单中添加一个菜单
```
title QGHO
 find --set-root /QGHO/QGHO.BIN
 configfile /QGHO/QGHO.LST
```

一般情况下,你不需要修改任何东西即可直接使用.  
默认自动备份第一硬盘第一分区数据到第一硬盘最后一个分区上.  

你可以自己修改/QGHO/QGHO.SET来实现自定义的备份.  
 比如设定备份任意分区到任意目录.  

没有磁盘限制,只要你定义的分区没有错就可以了.  

### [其它]
 如果你对这个有兴趣的话,也可以编写一个GUI界面来修改QGHO.SET内容.  
 因为我对GUI不感冒,所以这些事我就不做了.  

懂得使用就用,不懂的就不要瞎折腾了,对GRUB4DOS不了解的朋友请直接略过吧.... 

写给使用QGHO作为系统一键备份恢复的朋友:  

如果你已经把GRUB4DOS作为系统的第一引导,只要做如下操作就可以做到一键自动备份/恢复.

 并且可以通过在系统中修改QGHO.SET的设置来实现下一次引导时自动进行的操作.

只需要原来的MENU.LST在最前面加一句.
```
find --set-root --devices=h /QGHO/QGHO.SET && cat --length=2 /QGHO/QGHO.SET &gt; (md)0x300+1 && checkrange 0x3A3A read 0x60000 || configfile /QGHO/QGHO.LST
```
 具体QGHO.SET的设置方法请用记事本打开QGHO.SET查看.

下载地址:

[QGHO 最新版下载](http://dl.dbank.com/c0az9tcai0 "QGHO 最新版快盘下载")

### [更新内容]

2010-01-02

1.  添加了选择指定GHO文件恢复到指定分区的功能，具体看后面的图片 

2010-12-29 v0.5 元旦版

1.  弃用之前复杂的菜单转用新版GRUB4DOS的批处理方式,比较直接.
2.  恢复模式时会自动检测GHO文件的密码.
3.  其它优化调整. 

### [截图]

启动界面
 

显示参数信息.


开始备份.


新功能，菜单3.

选择要恢复的目的分区。



选择要恢复的GHO文件。


### [菜单文件]

注:这是老版的,新版已经改用批处理方式,想要查看批处理源码可以打开GRUB4DOS.MOD   
 查找"!BAT"就可以看到了.(可能需要对GRUB4DOS.MOD进行解压)

供想学习GRUB4DOS的朋友使用,大部份都有注释,有什么不明白的可以提出来.

如果你有发现了错误麻烦通知我,谢谢.
```bat
default=0
timeout=5
#设置可执行程序的路径(外部命令)
command --set-path=(fd0)/bin/
debug off

#菜单0
title auto ghost\n\n\t\tQuick Ghost Ver: 0.3\t\t2010-08-16\n\n\tmade by chenall QQ:366840202\t\thttp://chenall.net
write 0x60000 1000 && fallback --go 3
kernel

#菜单1
title ghost_Backup\n\n\t\tQuick Ghost Backup\n\n\tmade by chenall QQ:366840202\t\thttp://chenall.net
write 0x60000 1001 && fallback --go 3
kernel

#菜单2
title ghost_Restore\n\n\t\tQuick Ghost Restore\n\n\tmade by chenall QQ:366840202\t\thttp://chenall.net
write 0x60000 1002 && fallback --go 3
kernel

#菜单3 隐式菜单
title
#定位QGHO.BIN主程序位置
cat --length=0 /QGHO/QGHO.BIN || find --set-root /QGHO/QGHO.BIN
map --mem /QGHO/QGHO.BIN (fd0)
map --hook

#复制GHOST.ZIP文件到内存盘
fat copy /QGHO/GHOST.ZIP (fd0)/DOS.ZIP

#设置默认变量参数,fallback 4当后续语句执行出错时跳到菜单4.
fallback 4
wenv set mode=pdump
wenv set dst_path=/sys_c.gho
#从文件中读取配置参数,如果文件不存在或读取错误,返回0,根据上面的fallback 3就跳到菜单3去执行
WENV read /QGHO/QGHO.SET

#如果有设置变量dst_chk就执行检测操作.并把找到的分区设置为dst_id
#这里使用了wenv和disk外部命令
wenv get dst_chk && wenv run find --set-root --ignore-floppies --ignore-cd ${dst_chk} && diskid && wenv set dst_id=*0x4ff00
wenv get src_chk && wenv run find --set-root --ignore-floppies --ignore-cd ${src_chk} && diskid && wenv set src_id=*0x4ff00
fallback --go 4

#菜单4 隐式菜单
title
#设置默认参数，默认备份第一个硬盘激活的分区到第一硬盘最后分区.
#find --set-root makeactive --status,定位到第一个激活的分区.
wenv get src_id || find --set-root makeactive --status && diskid && wenv set src_id=*0x4ff00

#没有指定dst_id,使用最后一个分区(第一个激活分区所在硬盘)
wenv get dst_id || find --set-root makeactive --status && root endpart && diskid && wenv set dst_id=*0x4ff00

wenv set dst=${dst_id}${dst_path}
#根据内存位置0X60000的值来确定是还原状态或者备份状态。（当使用菜单启动时） 

#以下两句用于定位目标分区.
wenv run write (md)0x301+1 ${dst_id}\0

#diskid 命令gid=XX:YY 设定XX:YY对应的分区为当前root.XX:YY可以从内存中提取.这里取的是上一句写入的内存
diskid gid=*0x60200

#自动判断模式.
checkrange 1000 read 0x60000 && WENV run cat --length=0 ${dst_path} && WENV set mode=pload
checkrange 1001 read 0x60000 && wenv set mode=pdump
checkrange 1002 read 0x60000 && wenv set mode=pload

#写文件
wenv run write (fd0)/SETENV.BAT set mode=${mode}\r\n
#从指定位置开始写入0x10
wenv run write --offset=0x10 (fd0)/SETENV.BAT \r\nset src=${src_id}\r\n
wenv run write --offset=0x20 (fd0)/SETENV.BAT \r\nset dst=${dst}\r\n
#替换文件中路径的符号"/"为"\"
cat --skip=0x28 --locate=/ --replace=\\ (fd0)/SETENV.BAT
wenv run echo QGHO:${mode} ${src_id} <==> ${dst}
pause --wait=6 && chainloader (fd0)/io.sys
#直接启动DOS,也可以使用rootnoverify (fd0) 和 chainloader +1

```