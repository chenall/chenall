title: "【分享】神奇的DESKTOP.INI文件，系统自带的文件保护功能。"
id: 103
date: 2009-10-25 10:56:36
tags: 
- desktop.ini
- 文件夹
categories: 
- 系统相关
---


最近在试用Windows 7无意中发现了一个很有意思的特性，写出来分享下。可以不使用任何工具对一个文件夹/文件进行普通的保护

1.  不可改名
2.  可以改名但改名后对原来里面的程序没有任何影响（只是改的显示名称，实际上原来的名字并没有改变）
3.  对文件夹里面的文件重新指定名字（只是显示出来的名字，原名没有改变）
4.  处理以后文件夹实际上显示的是自定义的名称，改名也只是改这个名称，文件夹原来的名字并不会改变。
5.  只需要在DESKTOP.INI里面添加一些语句就可以对这个文件夹下的某些文件进行保护（可以防止某个文件被改名），这个文件被用户改名以后还可以使用原来的名字进行访问。

PS: 从WINDOWS XP开始就有这种特性了，不过从VISTA开始又有变动，更加简单了。这里主要介绍WIN7下的方法，VISTA应该是一样的，XP/2003基本差不多

首先看看如下图片，有没有发现一些比较特殊的地方？

![]([CDN_URL]:/upload/2009/10/6F82F0AE06F64B8A257E871C7EC8E7EE73606F6C.png)

想知道上面的文件夹是如何来的吗？

首先大家都知道从WINDOWS 9X开始，在系统中经常可以看到desktop.ini的身影，通过它可以对一个文件夹进行自定义外观的操作。
{% blockquote 百度百科 http://baike.baidu.com/view/676737.html %}
以下内容来源于百度百科 [http://baike.baidu.com/view/676737.html](http://baike.baidu.com/view/676737.html)

### 一、文件夹图标

　　[.ShellClassInfo]

　　InfoTip=注释

　　IconFile=图标文件的路径

　　IconIndex=选择要使用文件中的第几个图标

　　自定义图标文件，其扩展名可以是.exe、.dll、.ico等。

### 二、文件夹

　　[ExtShellFolderViews]

　　{BE098140-A513-11D0-A3A4-00C04FD706EC}={BE098140-A513-11D0-A3A4-00C04FD706EC}

　　[{BE098140-A513-11D0-A3A4-00C04FD706EC}]

　　Attributes=1

　　IconArea_Image=11.jpg

　　[.ShellClassInfo]

　　ConfirmFileOp=50

　　其中11.jpg是图片，把以上内容用记事本保存为desktop.ini ，和背景图片一起放在要改变背景的文件夹内。为了防止误删，可以把desktop.ini和图片设为隐藏属性。

### 三、标示特殊文件夹

　　系统中有一些特殊的文件夹，如回收站、我的电脑、我的文档、网上邻居等。这些文件夹的标示有两种方法：

####1. 直接在文件夹名后续上一个**.**在加对应的CLSID

　　如：把一个文件夹取名为：新建文件夹.{20D04FE0-3AEA-1069-A2D8-08002B30309D}

　　（注意：新建文件夹后面有一个半角的句号）

　　那么这个文件夹的图标将变为我的电脑的图标，并且在双击该文件夹时将打开我的电脑。

　　在下面查看CLSID

　　在注册表中展开HKEY_CLASSES_ROOT\\CLSID\\，在CLSID分支下面就可以看到很多的ID，这些ID对应的都是系统里面不同的程序，文件，系统组件等

　　常见组件类对应的CLSID:

　　我的文档：450D8FBA-AD25-11D0-98A8-0800361B1103

　　我的电脑：20D04FE0-3AEA-1069-A2D8-08002B30309D

　　网上邻居：208D2C60-3AEA-1069-A2D7-08002B30309D

　　回收站：645FF040-5081-101B-9F08-00AA002F954E

　　Internet Explorer：871C5380-42A0-1069-A2EA-08002B30309D

　　控制面板：21EC2020-3AEA-1069-A2DD-08002B30309D

　　拨号网络/网络连接 :992CFFA0-F557-101A-88EC-00DD010CCC48

　　任务计划 :D6277990-4C6A-11CF-8D87-00AA0060F5BF

　　打印机(和传真):2227A280-3AEA-1069-A2DE-08002B30309D

　　历史文件夹:7BD29E00-76C1-11CF-9DD0-00A0C9034933

　　ActiveX缓存文件夹: 88C6C381-2E85-11D0-94DE-444553540000

　　公文包: 85BBD920-42A0-1069-A2E4-08002B30309D

#### 2. 第二种是通过一个desktop.ini文件

　　还以我的电脑为例:

　　新建一个文件夹,名字随便,然后在其下边建立desktop.ini文件,内容如下:

　　[.ShellClassInfo]

　　CLSID={相应的ID}

　　注:有部分病毒会建立这样的文件夹以达到隐藏自身的目的.另外这也是一种我们隐藏小秘密的方法.

### 四、标示文件夹所有者

　　这通常见于我的文档等如我的文档里就有这样一个文件，内容如下：

　　[DeleteOnCopy]

　　Owner=Administrator

　　Personalized=5

　　PersonalizedName=My Documents
{% endblockquote %}

好进入正题，其实上面的文件夹都是用到了一个参数<font style="background-color: transparent" color="#ff00ff" size="4">LocalizedResourceName</font><font color="#000000">（这个的意思自己翻译一下),通过它我们就可以为我们的文件夹重新定义名字。</font>

<font style="background-color: transparent" color="#ff00ff" size="4"></font><font color="#000000">其它的我就不多说了，自己找下资料，上面的文件夹制作方法例子：</font>

1.  新建一个文件夹名为<font color="#ff00ff">test</font><font color="#000000">(随意)</font>
2.  在<font color="#ff00ff">test</font>文件夹中新建一个<font color="#ff00ff">desktop.ini</font>文件（注意一下扩展名）
3.  在desktop.ini中输入以下内容
    [.ShellClassInfo]
    LocalizedResourceName=自定义显示的名称
4.  最后一步也是很重要的一步，否则就不能显示。给<font color="#ff00ff">test</font>文件加个只读或者系统的属性

    使用ATTRIB命令（可以进入CMD，然后输入attrib+空格再把上面的文件夹拖放到CMD窗口获取这个文件夹路径）

    ::+r只读属性;+s是系统属性，可以只加一个

    attrib [</font><font color="#800000">test文件夹路径</font>] +r +s

5.  怎么样看到效果了吗？如果没有可能是系统还没有刷新，先关闭资源管理器，等一下再开就可以看到了。

知道了这些，上面的文件夹就很容易做出来了，只是改一下LocalizedResourceName的值而已。要实现上面第三个的效果（不能改名），只需要给这个文件夹只读属性，再把DESKTOP.INI也设成只读属性。就OK了。

PS:上面的做好以后你可以试着对这个文件夹进行改名操作，然后再注意看一下地址栏上显示的文件夹名

