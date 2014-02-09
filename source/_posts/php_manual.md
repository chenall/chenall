title: "PHP相关记录"
id: 883
date: 2012-11-27 10:35:48
tags: 
- curl
- CURLOPT
- mysql
- php
- 进度条
categories: 
- 程序设计/PHP
---

1.  PHP Curl 417 Expectation Failed
    原因: 服务端使用lighttpd,而lighttp不支持返回"Expect: 100-continue"这样的header，就会以417 "Expectation failed" 来代替（lighttpd 1.5.0无此问题）。
    解决方法:更新到新版或设置CURL头信息CURLOPT_HTTPHEADER=&gt;array('Expect:');
2.  使用MYSQLI或PDO来代替MYSQL
    相关文章,http://php.sinaapp.com/manual/zh/mysqlinfo.api.choosing.php
    通过对比可以发现使用MYSQLI或PDO_MYSQL更容易移植.操作起来也更方便.
3.  MYSQL数据库查询语句优化
    如下例子第二句比第一句速度更快,当然了,两个命令显示的结果是不一样的,具体可以查一下相关资料,只是大部份情况下都可以用join命令来优化.
    ```
    select * from t1,t2 where t1.id=t2.id
    select * from t1 left join t2 using(id)
    ```
4.  在线PHP手册国内镜像站点
   [http://php.sinaapp.com/manual/zh/](http://php.sinaapp.com/manual/zh/)
   或
   [http://cn2.php.net](http://cn2.php.net)
5.  PHP使用CURL时显示上下传进度的方法
    ```
    function curl_progress($download_size, $downloaded, $upload_size,$uploaded)
    {//PHP手册上的说明有误，其实应该是四个参数。如本例。
        if ($download_size)
            echo "D:".(round(($downloaded100)/$download_size,2))."%\t\r";
        else if ($upload_size)
            echo "U:".(round(($uploaded100)/$upload_size,2))."%\t\r";
        return 0;
    }
    $curl_opts = array(CURLOPT_URL => $url,
        CURLOPT_PROGRESSFUNCTION=> ‘curl_progress’,
        CURLOPT_NOPROGRESS => false);
    $curl = curl_init();
    curl_setopt_array ($curl, $curl_opts);
    $ret = curl_exec ($curl);
    curl_close($curl);
    ```