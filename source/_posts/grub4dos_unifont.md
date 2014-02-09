title: "[GRUB4DOS] 多国语言菜单支持[2010-04-20]"
id: 207
date: 2010-03-18 10:42:19
tags: 
- GRUB
- GRUB4DOS
- UNIFONT
- 外部命令
- 多国语言
categories: 
- GRUB4DOS/扩展
---


##　[功能]

GRUB4DOS 显示多国语言菜单.

注: `新的版本GRUB4DOS已经支持多国语言菜单,所以本程序也已经不再更新维护，也不建议使用．本文只保留作为记录.`

## [说明]
  2010-04-20更新

  1.  添加了简单的帮助信息
  2.  解决有时只显示半个字符的问题。

 [http://bbs.wuyou.com/viewthread.php?tid=162209&amp;extra=page%3D1&amp;page=4](http://bbs.wuyou.com/viewthread.php?tid=162209&amp;extra=page%3D1&amp;page=4) 

 1. GRUB4DOS 必须是>[grub4dos-0.4.5a-2010-03-11](http://code.google.com/p/grub4dos-chenall/downloads/detail?name=grub4dos-0.4.5a-2010-03-11.zip&amp;can=2&amp;q=)以后的版本.
 2. 使用外部命令UNIFONT实现.
 3. 需要使用UNIFONT加载一个字库才能正常显示.

使用方法:
    UNIFONT 字库路径
例子
    UNIFONT /GRUB/U16.BIN
卸载(释放程序和字体占用内存):
    UNIFONT --unload

 [截图]</font>
 
 ![](http://farm5.static.flickr.com/4055/4529415013_b2a3dfd68f_o.png)
 
 ## [下载]

[http://code.google.com/p/grub4dos-chenall/downloads/list](http://code.google.com/p/grub4dos-chenall/downloads/list)

[http://grub4dos-chenall.googlecode.com/files/grub4dos-0.4.5a-2010-03-11.zip](http://grub4dos-chenall.googlecode.com/files/grub4dos-0.4.5a-2010-03-11.zip)

[http://grub4dos-chenall.googlecode.com/files/unifont.zip](http://grub4dos-chenall.googlecode.com/files/unifont.zip)


字库下载.

 [http://grub4dos-chenall.googlecode.com/files/arialuni_U16.zip](http://grub4dos-chenall.googlecode.com/files/arialuni_U16.zip)
 [http://grub4dos-chenall.googlecode.com/files/wqy-microhei-lite_0_U16.zip](http://grub4dos-chenall.googlecode.com/files/wqy-microhei-lite_0_U16.zip)
 
## [其它说明]

[http://bbs.znpc.net/viewthread.php?tid=5862&amp;extra=page%3D1](http://bbs.znpc.net/viewthread.php?tid=5862&amp;extra=page%3D1)


使用了 “建国雄心” 提供的资料还有软件
 [http://blog.sina.com.cn/wujianguo789](http://blog.sina.com.cn/wujianguo789)

注：要支持多国语言菜单要使用UTF-8编码(<strike>目前不支持内置菜单</strike>新版GRUB4DOS 2010-04-20已经支持内置菜单）
 字库可以直接使用以下两个已经做好的。
 文泉驿字库
 [http://grub4dos-chenall.googlecode.com/files/wqy-microhei-lite_0_U16.zip](http://grub4dos-chenall.googlecode.com/files/wqy-microhei-lite_0_U16.zip)

这个据说是LINUX里面使用的，不知有没有版权？
 [http://grub4dos-chenall.googlecode.com/files/arialuni_U16.zip](http://grub4dos-chenall.googlecode.com/files/arialuni_U16.zip)

想要自己生成字库可以使用以下地址下载软件生成。（只要有.TTF字库文件就可以生成了）

[http://blog.sina.com.cn/s/blog_5d8cc6410100d654.html](http://blog.sina.com.cn/s/blog_5d8cc6410100d654.html)

[http://iask.sina.com.cn/u/1569506881/ish](http://iask.sina.com.cn/u/1569506881/ish)

附:

 另一个可用参数(不建议使用)
     unifont --all-font /grub/u16.bin
 加`--all-font`参数加载时连英文字体也使用字库提供的样式(如果字库中有的话).

 效果图.

 字库:

Consolas

 ![Consolas](http://farm5.static.flickr.com/4046/4529415313_9b3f7a253e_o.png)
 
微软`雅黑`字体（Microsoft `YaHei` Font）

![微软雅黑字体](http://farm5.static.flickr.com/4068/4529415723_b67a10bfa9_o.png)