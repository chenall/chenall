title: "[grub4dos] 全新的fat命令 [2010-06-24]"
date: 2010-06-24 20:56:27
---

<div id="PublishedByWebStory-[5]1_F1F744D8A03348989C1DC4AFB4ACC797_AC7FFF65BF144803A039CA10D7CEB6F0">
	<div>　　抽空重新改写了GRUB4DOS外命令FAT，完全重写代码。 直接使用了开源的[FAT File System Module](http://elm-chan.org/fsw/ff/00index_e.html)</div>
	<div>　　上次写的FAT命令是为了学习FAT文件系统的原理，花去了好多时间。本来想继续在原来的基础上改进添加一些其它功能，想想还是算了，我自己写代码很乱并不比别人的好，还不如直接利用现有的代码。

		所以这次就利用了上面的开源FAT模块，只需要编写磁盘读写函数给这个模块，就可以直接使用了。&nbsp;</div>
	<div>　　而且这个模块支持许多功能，包括，文件/目录，读写、删除、改名，还可以格式化磁盘等。唯一的代价是因为功能多了所以编译出来的程序文件当然会比较大，目前的版本大小是20KB，比以前的版本多了10KB,当然了可以用GZ压缩一下就只有7KB左右了。</div>
	<div>&nbsp;</div>
	<div>废话不多说了，直接先上个图。截图使用到的功能 复制文件/改名/删除</div>
	<div>![](http://chenall.net/wp-content/uploads/2010/06/165B2520FAD14BF74839EB396E8EE30F8C727BD1.jpg)</div>
	<div>FAT帮助信息。</div>
	<div>![](http://chenall.net/wp-content/uploads/2010/06/C5CB8FCB914502D31D42862E39AF68F3EEFC808C.png)</div>
	<div>&nbsp;</div>
	<div><font color="#ff00ff">2010-06-24</font></div>

1.  添加获取当前时间代码.
2.  修正dir显示时间日期错误.
3.  copy时按原文件复制禁用GRUB4DOS的自动解压功能&nbsp;
	<div><font color="#ff00ff">2010-06-11 正式版</font></div>

1.  添加mkfs命令用于创建一个FAT分区（相当于format）

    			命令格式

    			<span style="color: #f00">FAT mkfs [/A:UNIT-SIZE] DRIVE</span>

    			注：<span style="color: #f00">DRIVE</span>必须是一个GRUB4DOS可用的磁盘号，比如(fd0) (hd0,1)。不要直接使用(hd0)，否则可能会把整个磁盘都格成FAT格式。

    			这个命令建议用于虚拟内存盘，除非必要，尽量不要用于真实硬盘。
2.  copy命令添加一个/o参数，复制时覆盖已有文件。
3.  dir命令添加参数/a显示指定属性的目录或文件（和dos的dir命令一样）.
4.  由于带有完整功能的版本文件比较大，所以发布时同时带了一个mini版本，只带copy mkfile 和del三个命令。
	<div><font color="#ff00ff">2010-06-06 测试版</font></div>
	<div>

1.  添加dir命令.

    				![](http://chenall.net/wp-content/uploads/2010/06/E3609D9E30AF342B74F3887103E94AF8C35D6956.jpg)
2.  修改create_file命令参数为mkfile.
	</div>

注：接下来就是主要进行测试了，最近不会有更新的版本。

	<div><font color="#ff00ff">2010-06-05　预览版a3</font></div>

1.  <font color="#000000">添加帮助信息，没有加任何参数，或参数有误时显示帮助信息。</font>
2.  修改0604版fat info显示信息。
3.  添加<font color="#ff0000"><strike>create_file</strike></font>子命令(已经改成<font color="#ff0000">mkfile</font>)，可以创建一个指定大小的空白文件（只进行空间分配）
	<div><font color="#ff00ff">2010-06-04 预览版a2</font></div>

1.  <font color="#000000">copy命令改进，允许不指定目标文件名，自动使用源文件名。

    			![](http://chenall.net/wp-content/uploads/2010/06/02C5C48F7C045FA170D3DB4209C77AF8EECFAEC8.jpg)&nbsp;

    			另外，新版版在复制前增加了检测，如果磁盘空间不够就不复制。</font>
2.  为了调试方便，增加了一个info命令用于查看当前可用空间（正式版可能会删除这个命令）

    			<font color="#ff00ff">![](http://chenall.net/wp-content/uploads/2010/06/0AB87A4EFF706CD4EC4C6C4FD56C8A9785129047.jpg)</font>

<font color="#ff00ff">2010-06-03 预览版</font>

1.  <font color="#000000">修改了几个可能导致出错的代码。</font>
2.  <font color="#000000">精简FAT模块部份没有用到的函数。</font>

<font color="#ff00ff">2010-06-02 预览版</font>

		目前可使用功能列表 ：

1.  <div style="background-color: #ffffff"><font color="#ff00ff">mkdir</font> 创建一个目录 fat mkdir 目标目录&nbsp;&nbsp;

    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 例子：<font color="#ff00ff">fat mkdir</font> (hd1,0)/abcd

    				<font color="#ff0000">注：只能一级一级建立，不可以同时建立多级目录（以后也许会考虑改进）</font></div>
2.  <div style="background-color: #ffffff"><font color="#ff00ff">copy</font>&nbsp;&nbsp; 复制文件&nbsp; <font color="#ff00ff">fat copy</font> [/o] 来源 目标&nbsp;&nbsp;

    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 例子: <font color="#ff00ff">fat copy</font> (hd0,0)/file.ext (hd1,0)/file.ext

    				<font color="#ff0000">注：来源文件可以是任意GRUB4DOS可以访问的路径.</font>

    				<strike><font color="#ff0000">目标文件必须是FAT分区，并且这个文件不存在（以后会考虑加一个参数，让它可以进行覆盖操作）</font></strike><font color="#ff0000">，新的版本已支持覆盖操作要加参数/o</font>

    				<font color="#ff0000">并且目标目录必须存在否则会提示错误（这个目前就不考虑改进了）。</font></div>
3.  <div style="background-color: #ffffff"><font color="#ff00ff">ren</font>&nbsp;&nbsp;&nbsp;&nbsp; 文件或目录更名/移动 fat ren 旧名 新名&nbsp;&nbsp;&nbsp;

    				&nbsp;例子：

    				修改当前ROOT分区下的abc.txt文件为abc.ini

    				<font color="#ff00ff">fat ren</font> /abc.txt abc.ini

    				移动文件，把abc.txt移到test目录下（test目录必须已经存在）

    				<font color="#ff00ff">fat ren</font> /abc.txt /test/abc.txt&nbsp;</div>
4.  <div style="background-color: #ffffff"><font color="#ff00ff">del</font>&nbsp;&nbsp;&nbsp; 删除文件或目录（只能删除空目录同DOS）

    				例子：

    				删除一个文件

    				<font color="#ff00ff">fat del</font> /abc.txt

    				<font color="#ff0000">删除一个目录同删除文件一样，但要求这个目录是空目录，你必须先删除这个目录下的文件才能删除这个目录</font>

    				<font color="#ff0000">注意：不要删除根目录</font></div>
5.  <div style="background-color: #ffffff"><font color="#ff00ff">create_file</font> 创建一个文件。

    				创建一个1M大小的文件。

    				<font color="#ff0000">FAT create_file size=1M (hd0,0)/1M.BIN</font>

    				创建一个文件，大小自动取前面的cat --length=0得到的文件大小值。

    				<font color="#ff0000">FAT create_file size=* (hd0,0)/NEW.BIN</font></div>
6.  <div style="background-color: #ffffff"><font color="#ff00ff">dir</font> 显示指定目录下面的文件列表。

    				FAT DIR

    				新的版本可以按属性来显示列表。

    				<span style="color: #f00">d</span> 　目录

    				<span style="color: #f00">s</span> 　系统属性

    				<span style="color: #f00">r</span> 　只性属性

    				<span style="color: #f00">h</span> 　隐藏属性

    				<span style="color: #f00">-</span> 　表示&ldquo;否&rdquo;的前辍

    				几个例子：

    				FAT dir /a-d 不显示目录

    				FAT dir /ad 只显示目录

    				FAT dir /a-dsh 只显示带有系统和隐藏属性的文件。

    				&nbsp;</div>
7.  <div style="background-color: #ffffff">mkfs 创建一个FAT分区

    				<span style="color: #f00">FAT mkfs </span><span style="color: #00f">[/A:UNIT-SIZE]</span><span style="color: #f00"> </span><span style="color: #00f">[DRIVE]</span>

    				把指定的DRIVE格式化成FAT格式。如果不指定DRIVE则使用当前的root分区。

    				UNIT-SIZE指定格式化时使用的族大小，具体请参考windows的format命令

    				例子

    				FAT mkfs&nbsp; 按默认参数格式化当前磁盘

    				FAT mkfs /A:1024 或　FAT mkfs /A:1k&nbsp; 指定每个簇大小为1Kb

    				FAT mkfs (fd0)

    				&nbsp;</div>

下载测试地址：[http://grub4dos-chenall.googlecode.com/](http://grub4dos-chenall.googlecode.com/) 或 [http://grub4dos.chenall.com/](http://grub4dos.chenall.com/)（自动跳转）

注：目前<strike>只是预览测试版</strike>的版本应该比较稳定了，请使用虚拟机测试。欢迎大家进行测试。有什么问题或建议，可以直接留言，也可以到时空或者无忧论坛相关贴子留言。&nbsp;

		&nbsp;

	&nbsp;</div>