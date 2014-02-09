title: "[GRUB4DOS] 新外部命令 fontfile"
id: 130
date: 2010-03-04 00:31:57
tags: 
- FONTFILE
- GRUB4DOS
- 字库
- 原创
categories: 
- GRUB4DOS/扩展
---

### [功能说明]

  加载一个点阵字库用于显示中文。

  可以直接使用完整的点阵字库，或从以下软件生成的小字库
  http://www.cn-dos.net/forum/viewthread.php?tid=47921

  注: 最新的版本一般不需要这个命令,文章保留作为记录,或编写外部命令的参考

### [使用方法]

 1. 把fontfile复制到GRUB目录下。
 2. 使用以下命令调用
 
  FONTFILE PATH-TO-HZKFILE
  
 例子:
 
 FONTFILE /MENU.FON OR FONTFILE /HZK16


### [其它说明]

 必须使用以下网址，2010-03-01以后的版本才可以正常使用。(在最新版的GRUB4DOS上可能会显示不正常,本程序也不再维护更新)
 [http://grub4dos-chenall.googlecode.com/](http://grub4dos-chenall.googlecode.com/)
 小字库生成的命令。
 mkfon menu.lst
 执行后会生成menu.fon

 具体mkfon的使用方法请看
 [http://www.cn-dos.net/forum/viewthread.php?tid=47921](http://www.cn-dos.net/forum/viewthread.php?tid=47921)

 注意：`mkfon目录下必须有字库 GBK16 或 HZK16。这些可以自己从网上下载，如果找不到上面的网址里面也有。`

### [截图]

截图使用的菜单可以从以下地址下载（包含了小字库）

 [http://grub4dos-chenall.googlecode.com/files/sample_menu_with_chinese.zip](http://grub4dos-chenall.googlecode.com/files/sample_menu_with_chinese.zip)

 ![](http://farm5.static.flickr.com/4047/4529473849_f18864c1e7_o.png)
