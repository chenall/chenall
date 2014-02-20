title: "[原创] pretty自动加载语言代码"
date: 2014-01-20 17:00
tags: 
- pretty
- 原创
- 代码
categories: 
- 程序设计/html
description: 使用jquery代码实现 pretty 根据需要自动加载对应语言的.不受路径/CDN限制,自动获取prettify文件的路径,自动加载需要的代码高亮文件.
keywords: pretty,高亮,CDN,路径,css,自动,javascript
---

pretty是一个Javascript模块和CSS文件，可以实现文章中代码的高亮显示.  
在网上找到的使用方法都是差不多的,

首先就是加载css和js文件  
<!--more-->

```html
<script src="https://google-code-prettify.googlecode.com/svn/loader/prettify.js"></script>
<script src="https://google-code-prettify.googlecode.com/svn/loader/prettify.css"></script>
```
然后在文章尾部添加代码实现自动高亮显示

```html
<script type="text/javascript">
$(window).load(function(){
     $("pre").addClass("prettyprint");
     prettyPrint();
})
<script type="text/javascript">
```

或使用run_prettify来自动加载
```html
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css&skin=sunburst"></script>
```

但是上面都是有缺点的:
* 第一种方法,虽然也可以高亮显示,但看起来并不美观,因为还需要额外加载对应语言的js文件(像lang-html.js).
* 第二种方法,是自动加载了,不过它依赖google-code-prettify.googlecode.com上的代码文件,由于众所周知的原因,这个是经常不能正常访问的.并且由于run_prettify把加载代码的路径写死了,只能加载google-code上的代码.如果使用CDN的话它还是要加载google-code上的.不方便.

所以这里就给一个变通的方法,实现了根据需要自动加载对应语言的通用JS代码.不受路径限制,自动获取prettify文件的路径,自动加载需要的代码高亮文件.
需要jquery的支持.


```html
<script type="text/javascript">
   var lang=[];
   var pretty_base='';
   $('script').each(function(){
	var c = $(this).attr('src');
	if (!c)
	    return;
	if (c.match(/(\/)?prettify(\.min)?\.js/i))
	{
	    var index = c.lastIndexOf('/');
	    if (index != -1)
		pretty_base = c.substr(0,index + 1);
	    return false;
	}
   })
   $('pre code').each(function(){
	var c = $(this).attr('class')
	if (!c)
	    return;
	c = c.match(/\s?(lang\-\w+)/i);
	if (c && lang.indexOf(c[1]) == -1)
	{
	    lang.push(c[1]);
	    $.getScript(pretty_base + c[1] + '.min.js');
	}
   })

    $(window).load(function(){
       $("pre").addClass("prettyprint");
       prettyPrint();
    })
</script>
```