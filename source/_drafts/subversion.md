title: "[SVN]Subversion 开放源代码的版本控制系统"
id: 115
date: 2009-11-27 16:38:36
tags: 
- pe
- SVN
- 开源
- 版本控制
categories: 
- 网络收集
---

<div id="Published By Juziyue-[4]1_077656154EB9415092AD624AC29F57B8_DD19AA222F79402E88EB182AB0DF9E86">

[Subversion](http://zh.wikipedia.org/wiki/Subversion "来源")
 <div id="bodyContent"> 

### 维基百科，自由的百科全书
 <div id="contentSub"></div> <div id="jump-to-nav"></div> <table class="infobox" style="FONT-SIZE: 80%; WIDTH: 21em; TEXT-ALIGN: left" cellspacing="3"> <tbody> <tr> <th style="FONT-SIZE: 130%; BACKGROUND-COLOR: lightsteelblue; TEXT-ALIGN: center" colspan="2"> 

Subversion
 </th> </tr> <tr> <td style="TEXT-ALIGN: center" colspan="2">[File:Subversion.png](http://zh.wikipedia.org/w/index.php?title=Special:%E4%B8%8A%E4%BC%A0%E6%96%87%E4%BB%B6&amp;wpDestFile=Subversion.png "File:Subversion.png")</td> </tr> <tr> <th>[开发](http://zh.wikipedia.org/zh-cn/è»ä»¶éç¼ "软件开发")</th> <td>[CollabNet, Inc.](http://zh.wikipedia.org/w/index.php?title=CollabNet,_Inc.&amp;action=edit&amp;redlink=1 "CollabNet, Inc.（尚未撰写）")</td> </tr> <tr> <th style="WHITE-SPACE: nowrap">最新版本</th> <td>1.6.1 / <span class="bday">2009-04-10</span><span class="noprint">（7个月前</span>）</td> </tr> <tr> <th style="WHITE-SPACE: nowrap">[操作系统](http://zh.wikipedia.org/zh-cn/ä½æ¥­ç³»çµ± "操作系统")</th> <td>[跨平台](http://zh.wikipedia.org/zh-cn/è·¨å¹³å° "跨平台")</td> </tr> <tr> <th>类型</th> <td>[版本控制](http://zh.wikipedia.org/zh-cn/çæ¬æ§å¶ "版本控制")</td> </tr> <tr> <th>[许可协议](http://zh.wikipedia.org/zh-cn/è»é«è¨±å¯è­ "软件许可证")</th> <td>[Subversion许可证](http://zh.wikipedia.org/w/index.php?title=Subversion%E8%A8%B1%E5%8F%AF%E8%AD%89&amp;action=edit&amp;redlink=1 "Subversion许可证（尚未撰写）")</td> </tr> <tr> <th>[网站](http://zh.wikipedia.org/zh-cn/ç¶²ç« "网站")</th> <td>[http://subversion.tigris.org/](http://subversion.tigris.org/)</td> </tr> </tbody> </table> 

**<span lang="en" xml:lang="en">Subversion</span>**，简称**SVN**，是一个[开放源代码](http://zh.wikipedia.org/zh-cn/å¼æ¾æºä»£ç  "开放源代码")的[版本控制](http://zh.wikipedia.org/zh-cn/çæ¬æ§å¶ "版本控制")系统，相对于的[RCS](http://zh.wikipedia.org/w/index.php?title=RCS&amp;action=edit&amp;redlink=1 "RCS（尚未撰写）")、[CVS](http://zh.wikipedia.org/zh-cn/CVS "CVS")，采用了分支管理系统，它的设计目标就是取代[CVS](http://zh.wikipedia.org/zh-cn/CVS "CVS")。互联网上越来越多的控制服务从CVS转移到Subversion。
 <table class="toc" id="toc"> <tbody> <tr> <td> <div id="toctitle"> 

## 目录
 </div> 

*   <span class="tocnumber">[1 Subversion的历史](#Subversion.E7.9A.84.E5.8E.86.E5.8F.B2)</span>
*   [<span class="tocnumber">2</span> <span class="toctext">优于CVS之处</span>](#.E5.84.AA.E6.96.BCCVS.E4.B9.8B.E8.99.95)
*   [<span class="tocnumber">3</span> <span class="toctext">不足</span>](#.E4.B8.8D.E8.B6.B3)
*   [<span class="tocnumber">4</span> <span class="toctext">使用情况</span>](#.E4.BD.BF.E7.94.A8.E6.83.85.E6.B3.81)
*   [<span class="tocnumber">5</span> <span class="toctext">外部链接</span>](#.E5.A4.96.E9.83.A8.E9.8F.88.E6.8E.A5) </td> </tr> </tbody> </table> <script type="text/javascript"> //< ![CDATA[   if (window.showTocToggle) { var tocShowText = "显示"; var tocHideText = "隐藏"; showTocToggle(); }    //]]> </script> 

## <span class="mw-headline" id="Subversion.E7.9A.84.E5.8E.86.E5.8F.B2"><a id="Subversion.E7.9A.84.E5.8E.86.E5.8F.B2" name="Subversion.E7.9A.84.E5.8E.86.E5.8F.B2">Subversion的历史</a></span>

在2000年初，开发人员要写一个CVS的[自由软件](http://zh.wikipedia.org/zh-cn/èªç&plusmn;è&frac12;¯ä&raquo;¶ "自由软件")代替品，它保留CVS的基本思想，但没有它的错误和局限。

2000年2月，他们联系了Open Source Development with CVS (Coriolis, 1999)的作者Karl Fogel，问他是否愿意为这个新项目工作。巧的是这时Karl已经在和他的朋友Jim Blandy讨论一个新的版本控制系统的设计。在1995年，两人开了一家提供CVS技术支持的公司，叫作Cyclic Software。虽然公司已经卖掉了，他们仍然在日常工作中使用CVS。在使用CVS时受到的束缚已经让Jim开始仔细思考管理版本化数据的更好的路子。他不仅已经起好了名字“Subversion”，而且有了Subvesion资料库的基本设计。当CollabNet打来电话时，Karl立刻同意为这个项目工作。Jim征得他的老板RedHat Software的同意，让他投入这个项目，而且没有时间限制。CollabNet雇用了Karl和Ben Collins-Sussman，从5月份开始详细设计。由于Greg Stein 和CollabNet的Brian Behlendorf 和Jason Robbins 作了恰当的推动，Subversion很快吸引了一个活跃的开发人员社区。这说明了许多人有相同的受制于CVS的经验，他们对终于有机会对它做点什么表示欢迎。

最初的设计团队设定了几个简单的目标。他们并不想在版本控制方法论上有新突破。他们只想修补CVS。他们决定Subversion应该与CVS相似，保留相同的开发模型，但不复制CVS最明显的缺点。虽然它不一定是CVS的完全的替代品，它应该和CVS足够象，从而任何CVS用户可以不费什么力气的转换过来。

经过14个月的编码，在2001年8月31号，Subversion可以“自我寄生”了。就是说，Subversion开发人员停止使用CVS管理Subversion的源代码，开始使用Subversion代替。

虽然CollabNet发起了这个项目，而且仍然支助一大部分的工作（它为一些专职的Subversion开发人员发薪水）。但是Subversion像大部分开放源码的项目一样运作，由一个松散透明，鼓励能者多劳的规则管理。CollabNet的版权许可证和Debian FSG完全兼容。换句话说，任何人可以免费下载，修改，按自己的意愿重新分发Subversion，而不必得到来自CollabNet或其他任何人的许可。

## &nbsp;<a class="mw-headline" name=".E5.84.AA.E6.96.BCCVS.E4.B9.8B.E8.99.95">优于CVS之处</a>

*   统一的版本号。CVS是对每个文件顺序编排版本号，在某一时间各文件的版本号各不相同。而Subversion下，任何一次提交都会对所有文件增加到同一个新版本号，即使是提交并不涉及的文件。所以，各文件在某任意时间的版本号是相同的。版本号相同的文件构成软件的一个版本。
*   [原子](http://zh.wikipedia.org/w/index.php?title=%E5%8E%9F%E5%AD%90%E6%93%8D%E4%BD%9C&amp;action=edit&amp;redlink=1 "原子操作（尚未撰写）")提交。一次提交不管是单个还是多个文件，都是作为一个整体提交的。在这当中发生的意外例如传输中断，不会引起数据库的不完整和数据损坏。
*   重命名、复制、删除文件等动作都保存在版本历史记录当中。
*   对于二进制文件，使用了节省空间的保存方法。（简单的理解，就是只保存和上一版本不同之处）
*   目录也有版本历史。整个目录树可以被移动或者复制，操作很简单，而且能够保留全部版本记录。
*   分支的开销非常小。
*   优化过的数据库访问，使得一些操作不必访问数据库就可以做到。这样减少了很多不
必要的和数据库主机之间的网络流量。
*   支持元数据（Metadata）管理。每个目录或文件都可以定义属性（Property），它是一些隐藏的键值对，用户可以自定义属性内容，而且属性和文件内容一样在版本控制范围内。 

## <span class="mw-headline" id=".E4.B8.8D.E8.B6.B3"><a name=".E4.B8.8D.E8.B6.B3">不足</a></span>

*   只能设置目录的访问权限，无法设置单个文件的访问权限。 

## <a class="mw-headline" name=".E4.BD.BF.E7.94.A8.E6.83.85.E6.B3.81">使用情况</a>

虽然在[2006年](http://zh.wikipedia.org/zh-cn/2006å¹´ "2006年")Subversion的使用族群仍然远少于传统的CVS，但已经有许多[开放原码团](http://zh.wikipedia.org/zh-cn/éæ&frac34;æºä&raquo;£ç&cent;&frac14; "开放源代码")体决定将CVS转换为Subversion。已经转换使用Subversion的包括了[FreeBSD](http://zh.wikipedia.org/zh-cn/FreeBSD "FreeBSD")、[Apache Software Foundation](http://zh.wikipedia.org/zh-cn/Apache_Software_Foundation "Apache Software Foundation")、[KDE](http://zh.wikipedia.org/zh-cn/KDE "KDE")、[GNOME](http://zh.wikipedia.org/zh-cn/GNOME "GNOME")、[GCC](http://zh.wikipedia.org/zh-cn/GCC "GCC")、[Python](http://zh.wikipedia.org/zh-cn/Python "Python")、[Samba](http://zh.wikipedia.org/zh-cn/Samba "Samba")、[Mono](http://zh.wikipedia.org/zh-cn/Mono "Mono")以及许多团体。许多开发团队换用Subversion是因为 [Trac](http://zh.wikipedia.org/zh-cn/Trac "Trac")、[SourceForge](http://zh.wikipedia.org/zh-cn/SourceForge "SourceForge")、[CollabNet](http://zh.wikipedia.org/w/index.php?title=CollabNet&amp;action=edit&amp;redlink=1 "CollabNet（尚未撰写）")、[CodeBeamer](http://zh.wikipedia.org/w/index.php?title=CodeBeamer&amp;action=edit&amp;redlink=1 "CodeBeamer（尚未撰写）")等专案协同作业软件以及[Eclipse](http://zh.wikipedia.org/zh-cn/Eclipse "Eclipse")、[NetBeans](http://zh.wikipedia.org/zh-cn/NetBeans "NetBeans")等[IDE](http://zh.wikipedia.org/zh-cn/IDE "IDE")提供Subversion的支援整合。除此之外，一些自由软件开发的协作网如[SourceForge.net](http://zh.wikipedia.org/zh-cn/SourceForge.net "SourceForge.net")除了提供CVS外，现在也提供专案开发者使用Subversion作为源代码管理系统，[JavaForge](http://zh.wikipedia.org/zh-cn/JavaForge "JavaForge")、[Google Code](http://zh.wikipedia.org/zh-cn/Google_Code "Google Code")以及[BountySource](http://zh.wikipedia.org/w/index.php?title=BountySource&amp;action=edit&amp;redlink=1 "BountySource（尚未撰写）")则以Subversion作为官方的源代码管理系统。

[2009年](http://zh.wikipedia.org/zh-cn/2009å¹´ "2009年")，绝大多数CVS服务已经改用SVN。此时CVS早已经停止维护。不过CVS也有了合适的替代品。

## <a class="mw-headline" name=".E5.A4.96.E9.83.A8.E9.8F.88.E6.8E.A5">外部链接</a>

*   [Subversion 官方网站](http://subversion.tigris.org/)
*   [在linux下安装配置svn独立服务器](http://jijian91.com/blog20061020/svn-subversion-install-configure.html)
*   [svn客户端TortoiseSVN的安装和操作](http://jijian91.com/blog20061215/tortoisesvn.html)
*   [Subversion 中文站](http://www.subversion.org.cn/)
*   [SVNBook 正体中文版](http://svn.stu.edu.tw/svnbook/) <!--  NewPP limit report Preprocessor node count: 265/1000000 Post-expand include size: 1862/2048000 bytes Template argument size: 557/2048000 bytes Expensive parser function count: 0/500 --><!-- Saved in parser cache with key zhwiki:pcache:idhash:171159-0!1!0!!zh-cn!2!zh-cn and timestamp 20091125021950 --> <div class="printfooter">取自“[http://zh.wikipedia.org/zh-cn/Subversion](http://zh.wikipedia.org/zh-cn/Subversion)”</div> </div></div>