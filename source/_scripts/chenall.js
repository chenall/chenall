var extend = hexo.extend;
var route = hexo.route;
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

extend.generator.register(function(locals, render, callback){
  route.set('index.php', '');
  callback();
});
