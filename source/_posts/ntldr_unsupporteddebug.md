title: "[转载] ntldr隐藏大秘密——启动时手动编辑调整菜单选项"
id: 4
date: 2008-05-05 14:52:37
tags: 
- NTLDR
- 技巧
- 转载
categories: 
- 系统相关
- 实用文集
description:  ntldr隐藏大秘密——启动时手动编辑调整菜单选项
---


{% blockquote fujianabc http://www.cn-dos.net/forum/viewthread.php?tid=39644 中国DOS联盟论坛 %}
 大家知道，ntldr只能执行之前编辑好的的boot.ini菜单选项，而无法像grub的menu.lst一样在启动时手动编辑和调整菜单，很缺乏灵活性。
 
 今天我在启动vista时，偶然按了一下F10，发现vista的bootmgr+winload.exe在此时可以手动编辑启动选项，故而查找了一些相关资料，发现微软竟然在ntldr中包含了显示启动选项和编辑启动菜单这两个隐藏功能，下面我就来说明如何实现这两个功能。

 在启动到操作系统选择菜单时，输入**unsupporteddebug**后，神奇的事出现了boot.ini启动项的标题、路径、启动选项居然能显示出来了：

 选中一个操作系统选项，按回车，在boot.ini满足一定的条件时，还能出现启动选项手动编辑菜单：

 要出现启动选项编辑菜单，要求boot.ini文件中[operating systems]下面的操作系统项中的**任意一行**，满足下面条件中**任意一条**：
 
* 选项中包含**/redirect**参数，并且标题的引号中的字符长度超过57字节（用不了这么长，可以用彩色标题啊 <http://www.cn-dos.net/forum/viewthread.php?tid=20816>)
* 选项中包含**/debug**或**/baudrate**，并且路径开头不是**C:\\**
* 选项中包含 **/win95dos**或**/win95**参数 
* 操作系统路径是**C:\\** （没有任何文件名）

有兴趣的，可以更进一步参考：  
 <http://www.geoffchappell.com/viewer.htm?doc=notes/windows/boot/unsupporteddebug.htm>
 
 另外，关于vista bootmgr的F10编辑菜单的使用可以参考：
 
 <http://www.geoffchappell.com/viewer.htm?doc=notes/windows/boot/editoptions.htm>
 
{% endblockquote %}