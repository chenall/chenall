title: "Hexo 模块化主题"
date: 2014-02-13 22:25
id: 1402132138
tags:
- hexo
- 主题
- 模块化
- 内链
categories: 
- 个人日记
- 程序设计/Node.js
- 程序设计/html
description: hexo模块化主题,自由,强大,本主题还通过主题插件实现了很多特色功能(仅此一家).支持多个一级分类、子分类、iLink文章内链、ijs文章内嵌脚本等.
---

### 主题简介

基于[Hexo]默认主题 [light] 修改而成,采用 [bootstrap] 框架  

在尽量保留原有主题功能的同时采用模块化设计支持实现组件模块化.完全自定义,通过widgets你可以添加许多实用功能.可以自定义组合各种组件,像评论系统,统计系统等.

大部份的JS/CSS等静态文件都使用CDN加载,使用了 [bootcss] 和 [qiniu] 的CDN服务.

以下是本主题的特色:

- 支持单独启用或禁用小工具(像侧边栏之类的)
- 支持单独启用或禁用评论
- 可以单独指定加载小工具
- 支持多个分类，支持子分类,分类名不区分大小写
- 独特的用户配置文件(自动加载`$SOURCE\_$THEME.yml`[默认就是**source\\_chenall.yml**]作为主题的配置文件,这样可以避免升级主题或其它原因导致的配置文件丢失).
- `iLink` 文章内链功能
- `ijs` 文章内嵌脚本或能
- 允许在head或body的前面或尾部附加自定义内容.
- 独立脚本插件扩展(source_dir/_scripts目录里面的js文件会自动加载,效果和scripts目录里面一样)

<!--more-->

注: 上面的$SOURCE是hexo配置文件中在`source_dir`,$THEME是hexo配置文件中的`theme`,即 **hexo.source_dir + '_'+ hexo.config.theme+ '.yml'**;

其它: 本主题可以轻松支持多站点，每个站点的配置各自独立，互不影响（包括站点特定插件等）。

效果见本站源码：<https://github.com/chenall/chenall>  
还有demo源码: <https://github.com/chenall/hexo-theme-chenall>  

site分支里面的文件就是文章源码，源码里面包括了对应的配置文件_config.yml和插件等。

安装hexo之后，再安装本主题。 
然后下载本站源码，就可以使用新版的hexo测试了

例子:

```
svn co -r HEAD https://github.com/chenall/hexo-theme-chenall/trunk themes/chenall
svn co -r HEAD https://github.com/chenall/chenall/branches/site chenall.net
hexo server --config chenall.net/_config.yml
```

## **具体效果:** [demo] 或本站 [chenall.net]

### 安装方法

通过以下命令下载主题到您的theme目录，然后修改blog的`_config.yml`中_theme_为`chenall`。

```
git clone git://github.com/chenall/hexo-theme-chenall.git themes/chenall
```
或
```
svn co -r HEAD https://github.com/chenall/hexo-theme-chenall/trunk themes/chenall
```

另外: 主题内置的`list_posts`插件还需要额外安装一个`lodash`组件,使用以下命令安装即可.

```
npm install lodash --save
```

### 更新

通过以下命令来保持更新:

```
cd themes/light
git pull 或 svn up
```

### 分类说明

本主题分类方式是额外实现的,一行一个分类,每一行都是一个独立分类.

同时支持多级分类,像下面的.就设置了两个分类,`编程开发`和`VBScript`,`VBScript`是一个子分类.具体效果请参考[demo]

```yaml
categories: 
- 程序设计/VB/VBScript
- 编程开发
```

### ijs 内嵌脚本

`ijs` 是本主题的内置的`tag`插件,可以在文章中内嵌脚本,这样可以实现一些特殊功能.(因为是在主题中执行的,所以可以使用那些helper插件);

一个简单的例子,在文章中插入以下内容.
{% raw %}
```
{% ijs %}
return link_to('http://chenall.net','我的搏客');
{% endijs %}
```
{% endraw %}

以上通过hexo内置的*helper*插件**link_to**实现在文章中插入一个链接指向`http://chenall.net`.

## 效果: {% ijs %}
return link_to('http://chenall.net','我的搏客');
{% endijs %}


复杂一些的例子,在文章中插入最新的5篇文章列表.
{% raw %}
```
{% ijs %}
var str = '';
if (site.posts.length){
  str = '<ul class="list-group">';
  site.posts.sort('date', -1).limit(5).each(function(post){
    str += '<li class="list-group-item"><a href="' + config.root + post.path + '">' + post.title + '</a></li>';
  });
  str += '</ul>';
}
return str;
{% endijs %}
```
{% endraw %}

## 效果如下:

{% ijs %}
var str = '';
if (site.posts.length){
  str = '<ul class="list-group">';
  site.posts.sort('date', -1).limit(5).each(function(post){
    str += '<li class="list-group-item"><a href="' + config.root + post.path + '">' + post.title + '</a></li>';
  });
  str += '</ul>';
}
return str;
{% endijs %}

### iLink 文章内链

`iLink` 是本主题内置的的`tag`插件,通过**iLink**可以很方便的在文章中插入文章链接.

iLink 使用格式
{% raw %}
```
{% iLink TYPE:VALUE%}
TYPE: 类型
VALUE: 值
```
{% endraw %}
其中TYPE可使用的值如下:

* `tag`  链接到标签  
   {% raw %}
   ```
   {% iLink tag:GRUB4DOS %}
   ```
   {% endraw %}
   例: {% iLink tag:GRUB4DOS %}
* `cat` 或 `category` 链接到分类  
   例子: 
   {% raw %} 
   ```
   {% iLink cat:程序设计 %}
   ```
   {% endraw %}
   例: {% iLink cat:程序设计 %}
* 其它值会根据提供的信息自动链接到指定文章   
  例子:
    1. 链接到源文件名 
      {% raw %}
      ```
      {% iLink source:_posts/grub4dos_dev.md %}
      ```
      {% endraw %}
      例: {% iLink source:_posts/grub4dos_dev.md %}  
    2. 链接到文章标题 
      {% raw %}
      ```
      {% iLink title:[推荐] 免费的云计算Koding %} 
      ```
      {% endraw %}
      例: {% iLink title:[推荐] 免费的云计算Koding %}  
    3. 若某个文章页有额外添加了一些信息比如`id: 596`  
      {% raw %}
      ```
      {% iLink id:597 %}
      ```
      {% endraw %}
      例: {% iLink id:597 %}
    4. 通过文章的slug  
      {% raw %}
      ```
      {% iLink slug:jekyll_or_hexo %}
      ```
      {% endraw %}
      例: {% iLink slug:jekyll_or_hexo %}

### 附加自定义内容

如果你需要一些添加一些额外和主题无关的内容.这时就可以使用这个功能. 
在`_modules`目录中(主题或source都可以)新建一个文件夹`partial`.

然后就可以通过`partial`里面的特定文件添加额外内容.

具体文件列表:

* `body_start.ejs`   标签`<body>`后.
* `body_end.ejs`     标签`</body>`前.
* `head_start.ejs`   标签`<head>`后
* `head_end.ejs`     标签`</head>`前

例子: 想要在head中添加一行`meta`信息就可以在`head_start.ejs`中添加.

## 主题配置说明

注: 配置中如果需要访问到本地路径,除非特别指定否则应该用`css/theme.css`不要写成`/css/theme.css`,前者是相对路径会自动添加**config.root**路径.后者是绝对路径.

本主题特色: **把这个配置文件复制到`source`目录下并改名为`_chenall.yml`则会优先使用该配置,这样可以避免由于升级主题或其它原因导致的配置丢失.更方便使用.**

### 默认的配置

``` yaml
# Site default meta keywords
#keywords: site, wide, default, keywords

#已加载的模块,按顺序加载,所以需要自己调整加载的顺序,比如jquery一般要加载在最前面
loaded_modules:
- jquery
- bootstrap
- fontawesome
- prettify
- fancybox
- mathjax

# 注: 模块是由css或js文件来实现的,部份需要附加js代码的模块在_modules目录下.
# 如: prettify 如果加载了prettify则会同时加载_modules\_modules.ejs
# 部份模块是自动按需加载的,在模板中添加如下代码加载多说的JS模块
# <% theme.add_module('duoshuo'); %>
#
#
modules:
  # respond 不要放到loaded_modules中,这个会自动加载
  # proxy 指定respond的proxy地址
  # 注: bootstrap的css文件和这个proxy需要在同一个域上
  respond: ## A fast & lightweight polyfill for min/max-width CSS3 Media Queries (for IE 6-8, and more).
    js: http://cdn.staticfile.org/respond.js/1.4.2/respond.min.js
    proxy: http://cdn.staticfile.org/respond.js/1.4.2/respond-proxy.html
  jquery:
    js: http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js
  bootstrap: #强大的CSS框架，由Twitter的开发工程师推出
    css: http://cdn.staticfile.org/twitter-bootstrap/3.1.0/css/bootstrap.min.css
    js: http://cdn.staticfile.org/twitter-bootstrap/3.1.0/js/bootstrap.min.js
  prettify: # Google Code Prettify 代码的高亮显示
    css: http://cdn.bootcss.com/prettify/r298/prettify.min.css
    js: http://cdn.bootcss.com/prettify/r298/prettify.min.js
  highlightjs: # highlight.js 代码高亮显示插件
    css: http://cdn.bootcss.com/highlight.js/7.4/styles/github.min.css
    js:  http://cdn.bootcss.com/highlight.js/7.4/highlight.min.js
  fancybox: # 一款基于jQuery开发的类Lightbox插件
    css: http://cdn.bootcss.com/fancybox/2.1.5/jquery.fancybox.min.css
    js:  http://cdn.bootcss.com/fancybox/2.1.5/jquery.fancybox.min.js
  imagesloaded: #监测图片是否加载完毕的JavaScript库
    #js: js/jquery.imagesloaded.min.js
     js: http://cdn.bootcss.com/jquery.imagesloaded/3.0.4/jquery.imagesloaded.min.js
  Gallery:
    css: http://cdn.bootcss.com/blueimp-gallery/2.11.2/css/blueimp-gallery.min.css
    js: http://cdn.bootcss.com/blueimp-gallery/2.11.2/js/jquery.blueimp-gallery.min.js
  fontawesome:
    css: http://cdn.bootcss.com/font-awesome/4.0.3/css/font-awesome.min.css
  # MathJax is an open source JavaScript display engine for mathematics that works in all browsers.
  mathjax: # 生成数学公式插件
    css:
    js: http://cdn.bootcss.com/mathjax/2.3/MathJax.js?config=TeX-AMS-MML_HTMLorMML
    #js: http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML
  uyan: #有言评论系统
    uid: 1880458
  ujian: #友荐：为网站添加'猜你喜欢'功能
    uid: 1880458

##评论功能设置,目前支持disqus和duoshuo/uyan,需要在上面的modules中进行要应的设置
# show_count 是否显示文章的评论数量
# short_name 对应的short_name
# 需要的其它参数也可以加在下面,然后自己修改模板来使用.theme.comments.xxxxxx来调用
#
# 
comments:
    provider: duoshuo
    show_count: true
    short_name: hexochenall

## 站点分析统计代码功能组件
# 加载在站点的footer位置
analytics:
  # provider 要加载的统计代码类型,可同时加载多少,使用","分隔. 如下就加载了51la和google的统计代码
  # provider: 51la,google 
  provider: 51la,google,cnzz
  # google-analytics UA
  google:
  # 我要啦」免费统计 ID
  51la:
  # cnzz 免费统计
  cnzz:
    siteid: 5774006  #站点ID,在获取统计代码的页面的地址栏上可以看到siteid=xxxx或从代码中提取(一般是一串数字)
    show: #显示样式  留空: 图片形式1; 1: 图片形式2; 2: 图片形式1; 其它值: 文字形式

# 站点顶部菜单,支持子菜单
menu:
  Home: ''
  About: about/
  Archives: archives/
  其它链接:
    chenall: //chenall.net
    gihtub: https://github.com/chenall/hexo-theme-chenall

# ajax_widgets是否使用jquery.load动态加载widget的内容,
# 注: 部份小工具,像标签,分类,最近文章等,这些工具的内容在所有页面都是一样的,这时它就支持动态加载
# 所谓的动态加载,就是把这些内容从文章中分离出来独立存在,并采用ajax技术动态加载到指定位置.
# 使用动态加载,更新文章时,就不会因为分类或标签等内容的更改,导致所有页面都需要更新.
#
ajax_widgets: true

# 要加载的工具在这里添加
widgets:
  header: #顶部
  footer: #底部
  sidebar: #侧边栏
    - search
    - category
    - recent_posts
    - tagcloud
    - latest_update_posts
    - random_posts
    - sina_weiboshow
    - recent_comments
  before_content: # 文章内容前
  after_content:  # 文章内容后
    - wumiiRelatedItems
    - post_footer_info
    - ujian

  after_post:     # 文章框架之后
    - post_pageNav
    - related_posts

# For use with tagcloud or tag widgets
# - only tags >= to tag_minium are shown
tag_minium: 3

## Google 跟踪代码管理器 设置
## https://www.google.com/tagmanager/
## ID 就是对应容器的ID
## GoogleTagManagerID: GTM-ABCDEF
GTM_ID:

## 在文章中使用'[ CDN_URL]:'（注：CDN_URL两边无任格空格，这里是为了防止被替换）字符串自动替换为下面的地址,主要是为了方便使用.
CDN_URL: http://your.cdn.url

twitter_id: chenall
facebook_id:
linkedin_id:
github_id: chenall/almrun

rss: atom.xml
```

### 其它语言支持

  本主题只设置了简体中文语言文件,要使用其它语言,可以自己翻译下.以下是简体中文的语言文件例子:

```yaml
categories: 分类
search: 搜索
tags: 标签
tagcloud: 标签云
tweets: 推文
prev: 上一页
next: 下一页
comment: 留言
archive_a: 归档
archive_b: 归档：%s
page: 第 %d 页

post:
  updated: 最近更新
  Tagged: 标签
  Posted on: 发表于
  Posted in: 归类
  read more: 阅读全文

menu:
  Home: 主页
  About: 关于
  Archives: 归档
  GuestBook: 留言板

widgets:
  category: 分类
  recent_posts: 最近文章
  latest_update_posts: 最近更新
  recent_comments: 最近评论
  sina_weiboshow: 新浪微搏秀
  google_sidebar: 赞助商
  tags: 标签
  tagcloud: 标签云
```

[Hexo]: http://zespia.tw/hexo/
[demo]: http://hexo.chenall.net
[chenall.net]: http://chenall.net
[light]: https://github.com/hexojs/hexo-theme-light
[bootstrap]: http://getbootstrap.com/
[bootcss]: http://open.bootcss.com/
[qiniu]: http://www.staticfile.org/