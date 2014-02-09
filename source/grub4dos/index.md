title: grub4dos
date: 2010-05-03 13:05:26
---

<div id="PublishedByWebStory-[5]1_B782C41738364310B646B652B7AC5B52_F25617A519B14EB59957A5BFA15C5335">
 <div>
</div> 

项目主页: [http://grub4dos-chenall.googlecode.com/](http://grub4dos-chenall.googlecode.com/)

 下载最新编译版版本: [http://code.google.com/p/grub4dos-chenall/downloads/list](http://code.google.com/p/grub4dos-chenall/downloads/list)

 下载最新版源码:

 参考: &nbsp;[http://code.google.com/p/grub4dos-chenall/source/checkout](http://code.google.com/p/grub4dos-chenall/source/checkout)

 <span style="FONT-FAMILY: nsimsun">svn checkout **_http_**://grub4dos-chenall.googlecode.com/svn/trunk/ grub4dos-chenall</span>

 <span style="COLOR: #ff00ff"><span style="COLOR: #ff00ff">[更新历史]</span></span>
 <div><font color="#FF00FF">懒得更新，最新的更新历史请直接点以下链接查看。</font></div> <div>[<font color="#FF00FF">http://code.google.com/p/grub4dos-chenall/source/browse/trunk/ChangeLog_chenall.txt</font>](http://code.google.com/p/grub4dos-chenall/source/browse/trunk/ChangeLog_chenall.txt)</div> <div>[http://code.google.com/p/grub4dos-chenall/source/browse/trunk/ChangeLog_GRUB4DOS.txt](http://code.google.com/p/grub4dos-chenall/source/browse/trunk/ChangeLog_GRUB4DOS.txt)
</div> <div><span style="COLOR: #000000">2010-08-10
 &nbsp;1.fixed a bug in disk_io.c,it may return error 25 when set root to a cd drive.
 &nbsp;&nbsp; 修正一个BUG,当设置root为cd设备时可能会提示Error 25的错误.
 &nbsp;2.加快colinux下源码在cofs设备时编译的速度.</span></div> <div><span style="COLOR: #000000">2010-08-09 improved CHS probing code of map command on ISO9660 images.
 2010-08-04 finally find out the missing-extended-partition problem is caused by a gcc bug, and workarounds are created.
 2010-07-25 re-enabled the extended partition with logical partitions in disorder.
 2010-07-24 patch by chenall: cat --length=0 will return the size of the compressed file if it is gzipped; fix memory-not-enough problem when mapping a gzipped memory-file with a high compression ratio.
 2010-07-23 improved next_pc_slice() to cope with the partition-loop problem.
 2010-07-22 try to solve the problem of missing Linux extended partitions in Tab-completion.
 2010-07-21 improved next_pc_slice() to cope with the partition-loop problem.
 2010-07-20 changed code about pxe_basemem to solve the problem that pxe_unload fail to release memory.
 2010-07-12 fixed a bug in guess_dos_versions(for DOS executable grub.exe).
 2010-06-21 applied bean's patch(supported new (ud) device created with fbinst1.6).
 2010-06-09 applied karyonix's patch(fixes on grub_read and blocklist).
 2010-06-07 adjusted probe_int(dosstart.S) to deal with HP DV3-2309TX on its garbage int76 vector.
 2010-06-03 adjusted restore_BDA_EBDA(dosstart.S) to deal with HP on its garbage EBDA size byte.
 2010-05-31 unhook int13 before hooking it in load_initrd() to avoid duplicate hooking.
 2010-05-29 resolved conflict between drives_addr and mmap_addr for multiboot kernels.
 2010-05-27 adjusted probe_int(dosstart.S) to deal with DELL on its garbage int05 vector.</span></div> <div><span style="COLOR: #000000">2010-05-23 change /main.lst back to /menu.lst, and the original /menu.lst dir to /menu for pxe booting.</span>

 <span style="COLOR: #000000">&nbsp;pxe启动默认加载的菜单修改。

 PXE启动使用的菜单文件有修改，具体如下</span></div> <div>
</div> <div><span style="COLOR: #000000">优先尝试/MENU.LST文件，如果没有找到则使用以前的方式，但menu.lst目录修改为menu</span></div> <div>
</div> 

# <span style="COLOR: #000000"><a name="注意：如果PXE启动有使用menu.lst目录的使用新版??"><font color="#FF0000" size="4">注意：如果PXE启动有使用menu.lst目录的使用新版需要修改为MENU，否则可能会死机.</font></a></span>
 <div>
</div> 

<span style="COLOR: #000000"><strike>2010-05-21 changed initial config filename from /menu.lst to /main.lst for pxe booting.</strike>

 2010-05-19 fixed problem of mapping small file(&lt;512B) to (rd).

 2010-05-15 added --keep-pxe option for grub.exe running under DOS.

 2010-05-14 (chenall)fixed ntfs small file(&lt;4KB) access problem.

 2010-05-13 added --off option for hiddenmenu. added nokeep subcommand for pxe. let halt return on failure.</span>
 <div>
</div> <div>

 2010-05-04 （来自官网） [<font color="#000000">hopefully non-linux kernels could get loaded now. version number changed to 0.4.5b.</font>](http://code.google.com/p/grub4dos-chenall/downloads/detail?name=grub4dos-0.4.5b-2010-05-03.zip&can=2&q=)</div> <div>
</div> <div> 

1.2.  尝试解决 非Linux 内核加载代码 与 3M 处的系统代码的冲突问题（希望成功，但因没有测试环境，所以，不知道结果如何）。
3.4.  版本号升级为 0.4.5b。
5. </div> 

2010-05-02

 PXE启动时首先尝试加载/menu.lst。

 <div>

 <span style="COLOR: #000000">2010-04-17

 &nbsp;1.命令行自动完成调整.现在可以直接输入/+TAB显示当前目录下的文件或(hd0,0)/+TAB显示(hd0,0)/下面的文件列表

 &nbsp;以前的版本必需要像以下命令才可以。

 &nbsp;&nbsp;root /+TAB

 &nbsp;2.get_cmdline函数调整，以方便外部命令直接调用。</span>

 <span style="COLOR: #000000">2010-03-29

 &nbsp;1.外部命令执行过程调整。</span>

 <span style="COLOR: #000000">&nbsp;例子:默认path (bd)/grub/

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; echo abcd&nbsp; ## 优先使用(bd)/grub/echo 文件，如果没有再找 /echo 文件

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /echo abcd ## 只查找/echo 文件。

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (fd0)/echo abcd ## 只找 (fd0)/echo abcd 文件。

 &nbsp;2.find 命令添加一个 --ignore-oem 参数。

 &nbsp;[http://code.google.com/p/grub4dos-ireneuszp/](http://code.google.com/p/grub4dos-ireneuszp/)</span>

 <span style="COLOR: #000000">2010-03-26

 1.添加外部命令loadslic。

 用途嘛，呵呵，自己想去吧。

 原始的源码来源于:</span>

 &nbsp;</div> 
 <div>&nbsp;</div> 
 <div><span style="COLOR: #000000">[http://code.google.com/p/grub4dos-ireneuszp/downloads/list](http://code.google.com/p/grub4dos-ireneuszp/downloads/list)</span></div> 
 <div>

 <span style="COLOR: #000000">其它的就不多做介绍了，使用很简单

 loadslic SLIC文件。

 注：已经删除下载。

 <span style="COLOR: #000000">2010-03-21

 1.WENV命令更新.

 Input自动加一个换行符.</span></span>

 &nbsp;</div> 

 <div>

 <span style="COLOR: #000000">2010-03-20

 1.WENV命令更新具体

 [http://www.chenall.com/blog/2010/02/grub4dos_WENV.html](http://www.chenall.com/blog/2010/02/grub4dos_WENV.html)</span>

 2010-03-14

 1.同步到官方2010-03-14版.

 <span style="COLOR: #000000">2010-03-10

 &nbsp;1.菜单边框位置自动调整。</span>

 <span style="COLOR: #000000">2010-03-09

 &nbsp;1.注释掉karyonix 4G GZIP MAP的部份代码。

 &nbsp;2.添加UNIFONT外部命令，可以加载UNIFONT字库。当菜单文件是UTF8格式时可以显示多国语言。

 &nbsp;Support multi-language menu with UNIFONT.</span>

 <span style="COLOR: #000000">2010-03-03

 1.新的FONTFILE 外部命令，支持小字库。 support small hz lib

 [http://bbs.znpc.net/viewthread.php?tid=5854&extra=page%3D1](http://bbs.znpc.net/viewthread.php?tid=5854&extra=page%3D1)

 [http://www.cn-dos.net/forum/viewthread.php?tid=47921](http://www.cn-dos.net/forum/viewthread.php?tid=47921)</span>

 <span style="COLOR: #000000">2010-03-01</span>

 &nbsp;1.打上了karyonix的4G map 补丁

 &nbsp;[http://bbs.znpc.net/viewthread.php?tid=5844](http://bbs.znpc.net/viewthread.php?tid=5844)

 &nbsp;[http://www.boot-land.net/forums/index.php?s=&showtopic=10096&view=findpost&p=91378](http://www.boot-land.net/forums/index.php?s=&showtopic=10096&view=findpost&p=91378)

 &nbsp;

 &nbsp;2.添加fontfile外部命令.

 &nbsp;3.添加menuset外部命令.

 2010-02-09

 &nbsp;1.重写cmp部份代码(注:比较时可能会比较慢,因为只使用了1MB的缓存,之前的版本是完全缓存).

 &nbsp;顺便添加了新参数 --skip=

 &nbsp;可以指定在比较时跳过几个字节,用于cmp --hex时方便查看差异.

 &nbsp;

 2010-02-05

 &nbsp;1.添加calc简单计算器功能.

 &nbsp;calc [*INTEGER=] [*]INTEGER OPERATOR [[*]INTEGER]

 &nbsp;

 &nbsp;具体使用方法参考这里的外部命令calc的用法,是一样的,只是内置了.

 &nbsp;[http://www.chenall.com/blog/2010/02/grub4dos_calc.html](http://www.chenall.com/blog/2010/02/grub4dos_calc.html)

 &nbsp;

 &nbsp;

 2010-01-13

 &nbsp;修改设置默认可执行文件搜索路径参数为

 &nbsp;--set-path=PATH

 &nbsp;例子

 &nbsp;command --set-path=(bd)/grub/

 &nbsp;

 2010-01-09

 &nbsp;1.为command参数添加一个参数--set-root用于设置默认可执行文件的搜索路径。

 &nbsp;add option --set-root for command

 &nbsp;sets a search PATH for executable files,default is (bd)/grub

 2009-12-03 [g@chenall.cn](mailto:g@chenall.cn)

 &nbsp;1.修改了cat --hex代码，现在cat --hex会显示ascii&gt;127的字符。

 &nbsp;2.修改了cmp --hex代码，现在cmp --hex后面显示的字符同样可以显示中文。

 &nbsp;&nbsp; 并且添加了颜色控制，不同的地方使用了菜单的高亮色显示。

 2009-12-01 [g@chenall.cn](mailto:g@chenall.cn)

 &nbsp;1.同步源码到2009-12-01版（修正了NTFS上DD或WRITE的问题）

 &nbsp;2.修改调整了cat --replace，当使用--replace=*addr时允许使用--hex来指定读取长度。具体

 &nbsp;[http://bbs.znpc.net/viewthread.php?tid=5784&page=10&fromuid=29#pid42939](http://bbs.znpc.net/viewthread.php?tid=5784&page=10&fromuid=29#pid42939)

 2009-11-29 [g@chenall.cn](mailto:g@chenall.cn)

 &nbsp;1.调整了chainloader功能，如果chainloader (rd)+1，并且没有指定edx设备，那将把当前设备设为EDX。

 &nbsp;&nbsp; Changed chainloader_func,if use chainloader (rd)+1 then will set current_root to EDX

 &nbsp;从光盘上的BOOTMGR启动硬盘上的VISTA/WIN7系统。

 &nbsp;&nbsp;Boot VISTA/WIN7 from cdrom or any other device

 &nbsp;&nbsp;chainloader (cd)/BOOTMGR

 &nbsp;&nbsp;rootnoverify (hd0,0)

 &nbsp;&nbsp;dd if=(hd0,0)+1 of=(md)0x3E+1

 &nbsp;现在可以直接使用以下方法来启动;&nbsp;You can now use the following commands..

 &nbsp;&nbsp;map --mem=0xF000 /BOOTMGR

 &nbsp;&nbsp;find --set-root --ignore-cd --ignore-floppies /BOOT/BCD

 &nbsp;&nbsp;chainloader (rd)+1

 &nbsp;[http://bbs.znpc.net/viewthread.php?tid=5784&page=7&fromuid=29#pid42684](http://bbs.znpc.net/viewthread.php?tid=5784&page=7&fromuid=29#pid42684)

 &nbsp;Tips:about EDX,please read README_GRUB4DOS.txt

 &nbsp;2.源码同步到官方2009-11-29版。

 2009-11-28 [g@chenall.cn](mailto:g@chenall.cn)

 &nbsp;&nbsp;&nbsp; 1.修正了当内存&gt;2G时访问可能会出错的问题.

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; fixed a bug when access memory&gt;2G problems.

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; eg.

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; cat --hex (md)0x40002F+1

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; map --mem (md)0x600000+0x19020

 2009-11-26 [g@chenall.cn](mailto:g@chenall.cn)

 &nbsp;1.修改cmp_func代码，使用之使用十六进制显示差异偏移（为了方便对比使用）。

 &nbsp;&nbsp; change cmp_func to show Differ at the offset with HEX

 &nbsp;2.为cmp添加了一个参数--hex（直接显示十六进制）

 &nbsp;&nbsp; add --hex option for cmp&nbsp;

 2009-11-24 [g@chenall.cn](mailto:g@chenall.cn)

 &nbsp;1.添加(bd)设备，即启动设备，注：使用configfile命令会改变启动设备。

 &nbsp;added (bd) support.(bd):the boot drive. note:use configfile to change boot drive

 &nbsp;eg. boot from (hd0,0)

 &nbsp;&nbsp;&nbsp; now boot drive is (hd0,0)

 &nbsp;&nbsp;&nbsp; configfile (hd0,1)/menu.lst

 &nbsp;&nbsp;&nbsp; now boot drive is (hd0,1)

 &nbsp;</div> 

</div> 