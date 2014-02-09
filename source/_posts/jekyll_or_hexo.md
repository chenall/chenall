title: "静态搏客 jekyll & Hexo"
id: 933
date: 2013-10-30 21:41:00
tags: 
- github
- Hexo
- jekyll
- 静态搏客
categories: 
- 个人日记
---

Hexo 和 *jekyll* 都是简单的免费的Blog生成工具，只生成静态网页，不需要数据库支持，评论可以使用第三方服务像Disqus还有国内的多说。特别是由于github直接支持*jekyll*很多人已经使用*jekyll*写搏客了。

我看了一下觉得真的很不错，真是太适合像我这样的懒人了，直接使用MarkDown语法写博客，使用一些简单的标记就可以实现一些排版等。

比如 [Yonsm](http://www.yonsm.net) 这个就是使用*jekyll*的，我也打算使用*jekyll*来写搏客，不过由于对这个还不太熟悉所以就先了解下情况，后来又发现了Hexo，它使用node.js 速度更快，不知用哪个好，所以就两个都试了。

首先就是测试平台的搭建，想要在Windows上搭建还是有些麻烦的，虽然网上有很多教程，但是你一步一步下来还是会发现许多问题，我就碰到了好几个问题（主要还是程序版本问题嘿）。

像Python要用2.x的，pygments插件要用0.5.0的。

还有中文编码问题 

`... invalid byte sequence in GBK ..`

在网上找了一下，大多是说要修改*jekyll*程序的文件，本来我也想改，不过看了一下发现原来新版的已经不需要这样修改了

直接在配置文件_config.yam中添加一行'encoding: UTF-8'就行了。

经过各种折腾总算把测试平台建好了，我比较喜欢绿色化，所以顺便绿色化了一下，有需要的可以留言，我再上传（7z压缩后100MB左右，解压后400MB左右python27+ruyb193+nodejs+svn+git+XXX需要的基本都有了）

再来说下经过我试用后的比较，个人比较喜欢Hexo，因为它的功能还有扩展性都比较强，速度也快。

*jekyll* 更新比较快，调试信息比较清楚，而且Github原生支持，只是产生的速度慢一些。

另外*jekyll* 受限于*Liquid*语法对于修改模板来说真的很不方便，如果可以用其它语法就好了，当然如果你不需要修改模板就没有什么问题了。

分别用*jekyll*和*Hexo*生成了两个网站，有兴趣可以去观赏下。

*jekyll* 托管在*github*上(作为ALMRUN程序的主页)  [http://almrun.chenall.net](http://almrun.chenall.net)

hexo 托管在BAE上  [http://hexo.chenall.net](http://hexo.chenall.net)

2014-01-10 经过测试比较后,最后我决定采用[Hexo](https://github.com/tommy351/hexo)