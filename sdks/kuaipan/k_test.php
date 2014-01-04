<?php
header("Content-Type:text/html;charset=UTF-8");
require_once('kp.class.php');
define('CONSUMER_KEY',''); //换成你申请的应用对应的CONSUMER_KEY
define('CONSUMER_SECRET','');//同上
$kp = new kp(CONSUMER_KEY,CONSUMER_SECRET);
if (file_exists('./kp_oauth'))
$oauth = json_decode(file_get_contents('./kp_oauth'));//从文件中读取
if (!empty($oauth))
{
	$kp->oauth_token = $oauth->oauth_token;
	$kp->oauth_token_secret = $oauth->oauth_token_secret;
}
else
{
	$oauth = $kp->OAuth();
	if ($kp->errstr)
		die("OAuth授权失败:".$kp->errstr);
	else
		printf("OAuth授权成功：%s<br>",json_encode($oauth));
	file_put_contents('./kp_oauth',json_encode($oauth));
}

echo "<br>创建文件夹测试: /中文===>";
$ret = $kp->md('中文');
if ($ret == false)
	echo "失败:".$kp->errstr."<br>";
else
	printf("成功: 文件夹ID:%s<br>",$ret);

echo "<br>上传文件测试:<br>".__FILE__."==>中文/test.php=>";
$ret = $kp->upload('中文/test.php',__FILE__);
if ($ret==false)
	echo "失败:".$kp->errstr;
else
	echo "成功: 文件ID:".$ret; 
echo "<br>".__FILE__."==>中文/中文测试.php=>";
$ret = $kp->upload('中文/中文测试.php',__FILE__);
if ($ret==false)
	echo "失败:".$kp->errstr;
else
	echo "成功: 文件ID:".$ret; 

echo "<br>复制文件测试:<br>";
echo "/中文/test.php==>/中文/test_copy.php==>";
$ret = $kp->cp('/中文/test.php','/中文/test_copy.php');
if ($ret==false)
	echo "失败:".$kp->errstr;
else
	echo "成功"; 

echo "<br>复制文件夹测试:<br>";
echo "/中文==>/copy_of_中文==>";
$ret = $kp->cp('/中文','/copy_of_中文');
if ($ret==false)
	echo "失败:".$kp->errstr;
else
	echo "成功"; 

echo "<br>改名测试:<br>";
echo "/中文/test.php=>/中文/test_mv.php==>";
$ret = $kp->mv('/中文/test.php','/中文/test_mv.php');
if ($ret==false)
	echo "失败:".$kp->errstr;
else
	echo "成功"; 

echo "<br>文件列表测试: 列表根目录：<br>";
$ret = $kp->dir();
if ($kp->errstr)
	printf("失败: %s<br>",$kp->errstr);
else if (empty($ret))
	echo '该目录下没有任何文件';
else
	echo print_dir($ret);
echo "<br>列表中文目录内容:<br>";
$ret = $kp->dir('/中文');
if ($kp->errstr)
	printf("失败: %s<br>",$kp->errstr);
else if (empty($ret))
	echo '该目录下没有任何文件';
else
	echo print_dir($ret);

echo "<br>删除文件测试,删除文件/中文/test_mv.php==>";
$ret = $kp->rm('/中文/test_mv.php');
if ($ret == false)
	echo '删除失败'.$kp->errstr;
else
	echo "成功";
$ret = $kp->dir('/中文');
if ($kp->errstr)
	printf("失败: %s<br>",$kp->errstr);
else if (empty($ret))
	echo '该目录下没有任何文件';
else
	echo print_dir($ret);

echo "<br>删除目录测试,删除目录/copy_of_中文==>";
$ret = $kp->rm('/copy_of_中文');
if ($ret == false)
	echo '删除失败'.$kp->errstr;
else
	echo "成功";

echo "<br>文件列表测试: 列表根目录：<br>";
$ret = $kp->dir();
if ($kp->errstr)
	printf("失败: %s<br>",$kp->errstr);
else if (empty($ret))
	echo '该目录下没有任何文件';
else
	echo print_dir($ret);

echo "<br>下载测试: 以下是文件 中文/中文测试.php的下载地址<br>";
$ret = $kp->download('中文/中文测试.php');
if ($ret == false)
	echo "获取下载地址出错!".$kp->errstr;
else
	echo "<a href='$ret'>点击下载[中文测试.php]</a>";
echo $kp->FetchUrl($url);
unset($kp);
function print_dir($data)
{
	echo '<table><tr><th>文件名<th>大小<th>修改日期</tr>';
	foreach($data as $fil)
	{
		echo '<tr><td>';
		if ($fil->isfolder)
			echo "[".$fil->name."]</td><td>";
		else
		{
			echo $fil->name."</td><td>".ByteToMB($fil->size);
		}
		echo "</td><td>".$fil->modify_time."</td></tr>";
	}
	echo '</table>';
}

function ByteToMB($size)
{
	$dw = array("B","KB","MB","GB","TB","PB","EB");
	for($i = 0;$i<count($dw)-1;++$i)
	{
		if ($size < 1024)
			break;
		$size /= 1024;
	}
	return sprintf("%.2f%s",$size,$dw[$i]);
}