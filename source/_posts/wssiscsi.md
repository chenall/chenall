title: "[分享]Hack Microsoft iSCSI Software Target 安装"
id: 69
date: 2009-07-08 22:55:42
tags: 
- ISCSI
- Microsoft
- SCSI
- Software
- Target 2003
categories: 
- 实用文集
- 系统相关
---


一些介绍.

Microsoft收购String Bean的WinTarget软件后，已将该iSCSI target（目标）技术将通过OEM以Windows Storage Server 2003 R2的功能包提供，命名为Microsoft iSCSI Software Target，可用于标准版（Standard Edition）或企业版（Enterprise Edition）的Windows Storage Server 2003 R2。通过将这个Microsoft iSCSI Software Target与OEM合作伙伴的硬件集成，微软表示部署块和文件存储设备的成本将下降25%之多。
Microsoft iSCSI Software Target 结合Windows Storage Server 2003 R2可提供一个高性价比的IP SAN解决方案，同时支持File（文件）和Block（块）级别的数据传输；无需改变现有系统架构，直接应用在现有网络结构中，安装、实施、维护、升级均不影响现有作业；其管理方式将被整合在Microsoft Management Console (MMC) 用户界面 中，实现快捷方便的操作；并可实现snapshots快照、backup备份及clustering集群应用；Microsoft iSCSI Software Target 目前只能用于Windows Storage Server 2003 R2 Standard或Enterprise版本上。

根据介绍,它只能安装在Windows Storage Server 2003 R2 Standard或Enterprise版本上.

如果是直接安装确实是不行的.图下面图示.会出现一个错误提示.

 [![](http://lh5.ggpht.com/_W5yZS95Sbuw/SlSzXPSMrwI/AAAAAAAAAGA/-_MSsLYoHSw/thumb_20090708222415242.jpg?imgmax=800)](http://lh5.ggpht.com/_W5yZS95Sbuw/SlSzZdbXTWI/AAAAAAAAAGE/w3ce_78V1tA/20090708222415242.jpg?imgmax=800)

如果是其它系统就不行了吗?不死心就研究了一下安装程序里面的相关文件,后来在一个update_w03.inf文件中找到了关键所在具体在下图.

[![](http://lh3.ggpht.com/_W5yZS95Sbuw/SlSzaSX1dGI/AAAAAAAAAGI/kTr7wv9nBUo/thumb_20090708224023164.jpg?imgmax=800)](http://lh5.ggpht.com/_W5yZS95Sbuw/SlSzckTaqlI/AAAAAAAAAGM/63q9W3UTXns/20090708224023164.jpg?imgmax=800)

只要按照上面的要求修改注册表就可以安装了.
 1. 修改[HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows NT\CurrentVersion]  
    ```ProductName="Microsoft Windows Server 2003 R2"```
 2. 在 [HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft]
    下新建项,ServerAppliance  
    然后在新建的项下再新建一个Edition的Dword值为2或3就可以了.

    整理后的注册表内容.如果不懂得修改,只要把下面的内容存为REG文件,直接双击导入就可以了.
    ```
    REGEDIT4

    [HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\ServerAppliance]
     "Edition"=dword:00000003

    [HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows NT\CurrentVersion]
     "ProductName"="Microsoft Windows Server 2003 R2"
    ```


 导入后再运行安装程序,发现可以正常安装了.
 
 [![](http://lh5.ggpht.com/_W5yZS95Sbuw/SlSzdYnn7FI/AAAAAAAAAGQ/CerVoaJxeEM/thumb_20090708222449148.jpg?imgmax=800)](http://lh4.ggpht.com/_W5yZS95Sbuw/SlSzfWGu3zI/AAAAAAAAAGU/cp9ej-ntH1c/20090708222449148.jpg?imgmax=800)

安装后的效果图.

 [![](http://lh3.ggpht.com/_W5yZS95Sbuw/SlSzgi0IRzI/AAAAAAAAAGY/vh_9Oy9W-lA/thumb_20090708222520883.jpg?imgmax=800)](http://lh5.ggpht.com/_W5yZS95Sbuw/SlSzjpbOkSI/AAAAAAAAAGc/Gw_SsppfWCs/20090708222520883.jpg?imgmax=800)

是从WSS安装盘中提取出来的3.0版,网上有一个3.2的版本,没下到,有下到的朋友麻烦发一个给我,谢!
