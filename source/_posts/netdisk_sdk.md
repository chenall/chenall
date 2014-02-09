title: "[PHP] 打算整合多个网盘资源"
id: 898
date: 2013-02-07 11:22:28
tags: 
- API
- 网盘
- PHP
categories: 
- 程序设计/PHP
---

目前有N多的网络硬盘,各有各的好处和优缺点.另外基本上都有开放API.只是API调用方法都不一样.若是可以让所有网盘的调用方法变得一致.这样一来如是要开发什么的都很方便了.一个网盘不行了就换一个,什么代码都不用改.

HOHO~~~应该有搞头吧,

这里的金山快盘SDK就是一个原型http://chenall.net/post/sdk_kp_php/

最终我希望所有的网盘都可以这样子来调用

```
$disk = 'kuaipan';
$fs = new $disk(CONSUMER_KEY,CONSUMER_SECRET);
$fs->ls();
```

这样一来,批量管理网盘就变得容易了.一个文件可以同时上传到N个网盘. 不知有没有支持的?

以后有空再放个DEMO出来.

EDIT: 由于时间还有个人精力有限,搁浅了...