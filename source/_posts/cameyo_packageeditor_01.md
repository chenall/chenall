title: Cameyo PackageEditor 基本使用介绍
date: 2014-04-06 15:00:54
id: 1404061501
tags: 
- cameyo
- PackageEditor
- 虚拟化
- 绿色
categories: 
- 软件推荐
- 实用文集
description:
---

  [Cameyo] 是一款可以媲美 thinstall 的虚拟化软件,可以把整个应用程序虚拟化为单文件版,虚拟化后的软件不需要安装可以在任意电脑上运行,这里简单介绍一下通过 Cameyo PackageEditor 把一个绿色软件制作成单文件版的方法.

<!--more-->

### 简易转换过程

这里以 [百度云管家绿色版](http://www.zdfans.com/674.html) 转换为Cameyo虚拟化包为例,因为这个相对比较简单,不需要更多设置,可以直接运行:

* 首先打开 [PackageEditor] 启动编辑器,创建新的虚拟程序包(本例用的是2.X的版本).到了如下界面,在这里可以进行一些基本的设置,像运行模式之类的,还有扩展属性(本例最终的设置效果在后面).

  ![]([CDN_URL]:/post/cameyo_packageeditor_use_01.png)

* 现在开始添加所有需要的文件进去.

  ![]([CDN_URL]:/post/cameyo_packageeditor_use_filesystem.png)
  ![]([CDN_URL]:/post/cameyo_packageeditor_use_filesystem01.png)
  ![]([CDN_URL]:/post/cameyo_packageeditor_use_filesystem02.png)

* 添加完文件之后再设置一下主程序,如里有多个可以使用菜单.

  ![]([CDN_URL]:/post/cameyo_packageeditor_use_02.png)

* 使用更改图标功能设置应用的图标(会同时设置应用属性),直接在弹出的窗口中选择百度云管家的主程序就行了,,最终的设置效果图

  ![]([CDN_URL]:/post/cameyo_packageeditor_use_03.png)

* 现在把它保存起来.比如保存为 **BaiduYunGuanjia** 最终的文件名是 **BaiduYunGuanjia.cameyo.exe**,双击就可以直接启动百度云管家了.

看起来很简单,不是吗?

当然了以上是最基本也是比较简单的,为了方便直接使用了完全访问的模式,如果使用数据模式或其它模式,则还需要设置一下下载路径允许比如 **D:\BaiduYunDownload** 的文件系统访问模式为完全访问,请继续往下看.

### 安全设置

上面的是**完全访问**模式,也就是说这个虚拟化包可以对系统文件进行修改之类的,不太安全,一般除非特殊情况,不建议使用该模式,比较常用的是**数据模式**.

下面简单介绍一下各种模式的区别:

首先关于虚拟文件/注册表系统的一些基本概念(以下都是相对真实系统而言): 
  * 完全访问: 可以直接读写
  * 只读访问: **CopyOnWrite**,可以读但不能写入(写入的是副本),也同样是安全的,但是由于可以访问系统文件,
  * 禁止访问: 这个模式下就无法访问到真实系统上的对应文件或注册表,最安全的模式.

Cameyo基本数据访问模式:
  * 数据模式: 可以修改我的文档/桌面/网络硬盘上的文件内容.这个模式比较经常用到.
  * 隔离模式: 安全模式,不能修改任何非虚拟化程序之外的内容.
  * 完全访问: 完全直接访问模式,虚拟化程序可以直接改写系统内容.对于一些优化之类的软件使用.
  
百度云管家只是用来管理百度网盘上的文件的,所以我这里设置为**数据模式**,由于下载的文件一般是存放在D盘的,所以同时允许对D盘完全访问.

这些设置在上面的第二张图片的界面上设置,选中目录,然后点击右上角系统文件旁边的选项进行修改.也可以下载本文附件用PackageEditor打开查看.

### 成品下载

我制作好的百度云管家Cameyo单文件版下载: [百度云管家单文件绿色版](http://d.chenall.net/1/虚拟化绿软/BaiduYunGuanjia.exe)

[Cameyo]: http://www.cameyo.com/
[PackageEditor]: http://chenall.net/post/cameyo-packageeditor/
[thinstall]: http://www.vmware.com/company/news/releases/thinstall