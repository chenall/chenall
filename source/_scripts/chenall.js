var extend = hexo.extend;
var route = hexo.route;
var htmlTag = hexo.util.html_tag;
extend.generator.register(function(locals, render, callback){
  var config = hexo.config;
  if (config.url)
  {
    var domain = config.url.match(/\/\/([^\/]+)/);
    if (domain) route.set('CNAME',domain[1]);
  }
  callback();
});

extend.tag.register('imgL',function(args, content){
  return '<img src="http://c-dl.qiniudn.com/post/' + args.shift() + '">';
});

extend.tag.register('tdj',function(args){
  var itemtext = '点击购买';
  if (/^\d+$/.test(args)){
    var itemid = args;
  } else {
    var itemstr = /^([a-z]+:)?\/{1,2}.+?id=(\d+)/.exec(args);
    if (itemstr){
      var itemid = itemstr[2];
      itemtext = args;
      var href = args;
    } else {
      return '<a type="error"></a>';
    }
  }

  var attrs = {
    'data-type': "0",
    'data-tmpl': "628x100",
    'data-tmplid': "7",
    'data-rd':    "2",
    'data-border': "1",
    'data-style': "2",
    'biz-itemid': itemid,
    'target': '_blank',
    'rel':  'external',
    'title': '点此链接购买',
    'href': href || 'item.taobao.com/item.htm?id=' + itemid,
  };
  
  return htmlTag('a',attrs,itemtext);
});


extend.generator.register(function(locals, render, callback){
  route.set('index.php', '');
  callback();
});
