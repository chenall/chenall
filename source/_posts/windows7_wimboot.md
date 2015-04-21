title: "【分享】成功实现WIN7的WIMBOOT功能"
id: 2015042
date: 2015-04-21 17:28
tags: 
- windows7
- WIMBOOT
- VHD
categories: 
- 系统相关
---

把WINDOWS 8的WIMBOOT功能应用到WINDOWS 7上,目前使用一切正常.

最终的文件列表如下,很简洁,两个系统总共才占用40GB左右的空间.我使用用一个60G的固态硬盘.启动速度飞快.7秒左右进桌面.

正常安装的话一个64位的系统就差不多需要40GB了,现在两个系统才40GB,是不是很心动呢,先上来秀一下,过一段时间有空了再继续写.


```
 BOOTMGR ==>启动文件
├─boot  ==>启动文件目录
│  │  memtest.exe
│  │  
│  ├─Fonts ==>启动界面字体
│  │      chs_boot.ttf
│  │      cht_boot.ttf
│  │      jpn_boot.ttf
│  │      kor_boot.ttf
│  │      wgl4_boot.ttf
│  │      
│  │      
│  └─zh-CN
│        bootmgr.exe.mui
│        memtest.exe.mui
│          
└─wimboot ==>系统文件夹
    │  wimboot.wim  ==>系统WIM WINDOWS 7 x86/x64二合一镜像 占用14G空间
    │  
    ├─x64  ==>64位系统所使用的VHD
    │      wimboot.vhd ==>差分VHD启动使用      ==>启动后15G
    │      win7.vhd  ==>64位系列主VHD文件      ==>400MB左右
    │      
    └─x86 ==>32位系统使用的VHD
            wimboot.vhd ==>32位差分启动使用    ==>启动后10G
            Win7.vhd ==>32位系统主VHD文件      ==>400MB左右
```       
