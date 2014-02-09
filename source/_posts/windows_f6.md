title: "[原创] 利用GRUB4DOS安装SRS(SCSI,RAID,SATA)驱动免按F6,免软驱."
id: 70
date: 2010-11-22 13:03:39
tags: 
- F6
- GRUB
- GRUB4DOS
- SCSI
- TXTSETUP.OEM
- 服务器
categories: 
- GRUB4DOS/实用
---


这个在配合使用U盘安装系统碰到SCSI/RAID硬盘时特别有用,不需要在安装光盘上集成那个驱动了.

*2014-01-03 PS: 目前已经有很多工具根据此原理实现了自动化操作,本文作为实现的原理,只提供参考*

以下是一个实现方法的例子(具体如何使用可根据实际情况):
 1. 先制作一个需要的驱动软盘(IMG文件,可用GZIP压缩后一般1XXKB左右).
 2. 将以上文件放到U盘根目录下名为SCSI.IMG.
 3. 把GRUB4DOS引导写入U盘.(只要使用U盘启动时可以用GRUB即可)
 4. GRUB4DOS的启动命令
    ### 相关文章:
    <http://bbs.wuyou.com/viewthread.php?tid=121630&amp;extra=page%3D1>  
    <http://bbs.wuyou.com/viewthread.php?tid=121630&amp;page=5#pid1349207>   
    <http://bbs.znpc.net/viewthread.php?tid=4562>  

    ### GRUB4DOS菜单内容
    ```
    title 从光盘安装系统并自动加载S&amp;R&amp;S软盘驱动.
    find --set-root /SCSI.IMG
    map --mem (md)+2880 (fd0)
    map --mem /SCSI.IMG (fd1)
    cdrom --init
    map --hook
    dd if=(fd1)+1 of=(fd0)+1
    chainloader (cd0) </div> 
    ```

    注:以下两句是为了生成一个空白的`(fd0)`,即`A:`

    ```
    map --mem (md)+2880 (fd0)
    dd if=(fd1)+1 of=(fd0)+1
    ```

    可以使用其它软盘镜像代替,但是不可以用你要安装的SRS镜像,否则安装时会提示插入软盘. 这个`(fd0)`,如果使用`firadisk`驱动代替,那就可以直接用ISO镜像来安装系统.

 5. 现在就可以试下了,在光驱中放入XP/2003的安装盘.插上U盘,选择从U盘启动.

    这时就会自动加载U盘上的驱动,然后再开始安装系统,安装过程不需要按F6等,可以自动识别驱动.

    以上在安装系统时的实现方法.  
    注:由于GRUB4DOS对光驱的支持不是很好,以上方法并不适用所有电脑,为了解决这个问题可以制作一张使用GRUB4DOS作为引导的光盘,  
    启动后直接加载驱动并换掉光盘再进行安装就可以了.  
    菜单例子  
     ```
    title 加载F6软盘镜像
    find --set-root /SCSI.IMG
    map --mem (md)+2880 (fd0)
    map --mem /scsi.img (fd1)
    map --hook
    dd if=(fd1)+1 of=(fd0)+1
    pause 请更换光盘后按任意键继续.
    chainloader (cd)
    ```
 
 
 再说下基于PE 1.X的实现方法和上面差不多,但目前的PE大多没有此功能.

 添加此功能需要在DRIVERS目录下添加一个VOLSNAP.SY_,然后修改TXTSETUP.SIF文件即可.TXTSETUP.SIF的修改方法
 ```
 [HardwareIdsDatabase]
 STORAGE\Volume = "volsnap",{71A27CDD-812A-11D0-BEC7-08002BE2092F}

 [BusExtenders.Load]
 volsnap= volsnap.sys

 [BusExtenders]
 volsnap= "Volume Shadow Copy Manager",files.none,volsnap`
 ```
 
添加了以后就可以在启动PE之前将对应的驱动加载到fd1上然后再启动PE就可以自动识别了.

 从此不再需要集成驱动的系统安装盘/PE了....

 后记:此方法用于PE启动时使用(fd0)就可以加载了,用于系统安装时,一般使用(fd1)以实现免按F6安装.

其中TXTSETUP.OEM里面的[default]字段下SCSI的值必须是你本机对应的驱动,否则不会自动加载.

还有一种方式,使用GHOST像绿茶网吧版的.虽然也是GHOST方式,但是属于全新安装的.安装的时候如果出现7B蓝屏说明没有对应驱动,这时也可以使用这个方法来加载驱动后再重新启动安装就不会蓝屏了.(需要加载到(fd0)并按F6选择正确的驱动,最好同时加载到(fd1))

从此不再需要集成驱动的系统安装盘/PE了....

2010-11-22 更新一些说明.

2009-07-09 注:如果使用(fd0)不成功的朋友,可以尝试再加载一个非OEM F6镜像的IMG到(fd0),也就是(fd0)不要有TXTSETUP.OEM文件,一般就可以了.
