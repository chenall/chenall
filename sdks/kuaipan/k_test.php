<?php
header("Content-Type:text/plain;charset=UTF-8");
require_once('/libs/kp.class.php');
const CONSUMER_KEY = ''; //填入你申请的应用对应的CONSUMER_KEY
const CONSUMER_SECRET = '';//同上
$kp = new kp(CONSUMER_KEY,CONSUMER_SECRET);

//如果已经通过了授权把授权对应信息写在这里就不用再次授权了。
//$kp->oauth_token = "";
//$kp->oauth_token_secret = "";

echo "OAuth测试:\r\n";
$ret = $kp->OAuth();//成功之后$ret里面保存了OAUTH验证需要的信息，可以自己保存下来.
if ($kp->errstr)
	die("OAuth授权失败:".$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));

echo "创建文件夹测试: md('mytest')\r\n";
$ret = $kp->md('mytest');
if ($kp->errstr)
	printf("失败: %s\r\n",$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));

echo "上传文件测试:\r\n";//使用CURL上传文件
$ret = $kp->upload('mytest/kuaipan.php',array('file'=>'@'.__FILE__.';filename=kuaipan.php'));
if ($kp->errstr)
	printf("失败: %s\r\n",$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));

echo "复制文件测试:\r\n";
$ret = $kp->cp('/mytest/kuaipan.php','/mytest/kuaipan_copy.php');
if ($kp->errstr)
	printf("失败: %s\r\n",$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));

echo "复制文件夹测试:\r\n";
$ret = $kp->cp('/mytest','/copy_of_mytest');
if ($kp->errstr)
	printf("失败: %s\r\n",$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));

echo "改名测试:\r\n";
$ret = $kp->mv('/mytest/kuaipan.php','/mytest/kuaipan_mv.php');
if ($kp->errstr)
	printf("失败: %s\r\n",$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));

echo "文件列表测试:\r\n列表根目录：\r\n";
$ret = $kp->ls('');
if ($kp->errstr)
	printf("失败: %s\r\n",$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));
echo "列表mytest目录内容:\r\n";
$ret = $kp->ls('/mytest');
if ($kp->errstr)
	printf("失败: %s\r\n",$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));

print "删除测试\r\n";
$ret = $kp->rm('/mytest');
if ($kp->errstr)
	printf("失败: %s\r\n",$kp->errstr);
else
	printf("成功：%s\r\n",json_encode($ret));
