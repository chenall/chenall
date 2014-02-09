title: "[GRUB4DOS] chkpci for grub4dos"
id: 535
date: 2010-09-04 08:49:00
tags: 
- chkpci
- GRUB
- GRUB4DOS
categories: 
- GRUB4DOS/扩展
---

## [用途]

1. 在GRUB4DOS下直接检测PCI设备信息.

2. 待定.......

## [用法]

直接在GRUB4DOS下运行,可以加一个PCI信息库文件参数.[PCI信息库文件](http://d.chenall.net/upload/PCIDEVS.gz)

另: 因为GRUB4DOS是支持自动解压的.所以这个信息库文件可以使用GZIP压缩再调用(加快读取速度).

注意: 目前库文件限制在1MB以内(一般来说也够用了)

其它说明: 使用库文件时,会把库文件读取到内存6M-8M之间,使用时请注意不要冲突

## [下载]

CHKPCI(带源码)

http://code.google.com/p/grubutils/downloads/list

更新信息(changelog):

1. 尝试添加新的PCI信息显示格式（类似CHKPCI).

  文件内容格式:
  ```
    第一行固定`PCI$`
    固定输出内容（可选）
    $PCI设备信息1 匹配后显示内容1
    $PCI设备信息2  匹配后显示内容1
    匹配后要显示的内容1
    $pci设备信息3
    匹配后要显示的内容3

  ```

  一个例子:

  ```
    ===========CHKPCI.PCI=============
    PCI$
    $PCI\VEN_8086&DEV_7113
    Intel
    test
    $PCI\VEN_8086&DEV_7000&CC_020000&REV_00
    fat copy /IASTOR.SYS (fd0)/
    fat copy /iastor.inf (fd0)/
    fat copy /txtsetup.oem (fd0)/
    ===========CHKPCI.PCI=============
  ```
 
### 2010-08-28

 1. 添加帮助信息 -h 参数.

 2. 添加参数 -cc:CC,用于显示指定设备.

### 2010-08-27

  修正在实机使用时会造成卡机的问题.

### 2010-08-26

 添加读取PCIDEVS.TXT按格式显示设备信息的功能.

### 2010-08-25

 第一版,只能显示PCI信息.

## 【相关资料】

一些资料请看这里.

[http://chenall.net/post/scanpci/](http://chenall.net/post/scanpci/)
## Class Codes
<table border="1"><tbody><tr><th>Class</th><th>Description</th></tr><tr><td>0x00</td><td>Devices built before class codes</td></tr><tr><td>0x01</td><td>Mass storage controller</td></tr><tr><td>0x02</td><td>Network controller</td></tr><tr><td>0x03</td><td>Display controller</td></tr><tr><td>0x04</td><td>Multimedia device</td></tr><tr><td>0x05</td><td>Memory Controller</td></tr><tr><td>0x06</td><td>Bridge Device</td></tr><tr><td>0x07</td><td>Simple communications controllers</td></tr><tr><td>0x08</td><td>Base system peripherals</td></tr><tr><td>0x09</td><td>Inupt devices</td></tr><tr><td>0x0A</td><td>Docking Stations</td></tr><tr><td>0x0B</td><td>Processorts</td></tr><tr><td>0x0C</td><td>Serial bus controllers</td></tr><tr><td>0x0D-0xFE</td><td>Reserved</td></tr><tr><td>0xFF</td><td>Misc</td></tr></tbody></table>
更多资料请点这里查看

[https://docs.google.com/document/pub?id=1peDTGBLgsGa-qaX0JSeZUuI2Pu9Sl0FkCCk27cNi-wk](https://docs.google.com/document/pub?id=1peDTGBLgsGa-qaX0JSeZUuI2Pu9Sl0FkCCk27cNi-wk)

[截图]

![首先是帮助信息](http://d.chenall.net/upload/2010/08/158B5714E04F16AD5C39EF2BE35C76E70E0FAEA1.png)

![不加参数,只列出PCI设备信息.](http://d.chenall.net/upload/2010/08/AE12A9F981EA2C70F956A931B6A3108D5FCA6710.png)

![指定PCI信息库文件,按这个库文件显示详细的信息(呵呵,也不是很详细).](http://d.chenall.net/upload/2010/08/C73AE3560675211E38BA59F2CFEA75033D8569D3.png)

![只显示指定类型设备.](http://d.chenall.net/upload/2010/08/7CD00677B3EE4AEB967363AC49674B066C62F6E0.png)

![新的PCI格式截图](http://d.chenall.net/upload/2010/09/299DAA5B941BF396391CF607F2FFD92B58E5891B.png)