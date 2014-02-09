title: "[GRUB4DOS] root 命令介绍"
id: 113
date: 2009-11-16 15:36:31
tags: 
- GRUB
- GRUB4DOS
- root
- rootnoverify
categories: 
- GRUB4DOS/介绍
---


一、基本概念。
>  root中文解释就是“根”的意思。
  例子：
  一个磁盘文件列表如下
  ```
    X:\
    x:\test1\file1
    x:\test2\file1
    x:\boot\
    x:\boot\file1
    x:\boot\file2
    x:\boot\file3
    X:\boot\test\file1
    X:\boot\test\file2
    X:\boot\test\file3
  ```
  其中一开始X:\就是默认root
  现在要访问boot\file3 就可以使用 /boot/file3 来访问
  默认root是可以改变的比如我需要连续访问x:\boot\test\file1,file2,file3。
  这样每次访问都要使用/boot/test/file1这样的路径会比较麻烦，
  这时可以设置x:\boot\test为root 这样要访问上面的文件就只要 /file1就可以了

    root (hd0,0)/ 设置(hd0,0)/为当前根
    root () 在GRUB4DOS中()代表当前根磁盘(root drive)相当于上面的X:
    root (hd0,0)/boot/test 设置/boot/为当前根，以后要访问/boot/里面的文件就不要再写/boot/了，
    例子访问/boot/test/file1， 使用/test/file1
    如果这时要访问非boot目录下的就要使用()/了，例子访问/test1/file1 使用，()/test1/file1
 

二、命令介绍
 1. 查找定位并设定root

  ```
 find --set-root /boot/bcd # 在所有磁盘中查找/BOOT/BCD文件，有找到就把这个磁盘设为root
 find --set-root --ignore-floppies /boot/bcd # 查找时不找软盘设备
 find --set-root --ignore-cd /boot/bcd # 不找光盘设备。
 find --set-root --ignore-floppies --ignore-cd /boot/bcd # 不找光盘和软盘设备
  ```
 2. 设置默认root
    root (hd0,0)/windows 设置(hd0,0)/windows为root,以后要访问(hd0,0)/windows里面的文件直接使用 /xxx就可以了

 3. 把启动设备设为root
  root `bootdev`  把当前启动设备设置为ROOT,在某些情况下可用。
  应用：
  从U盘启动，
  find --set-root /boot/bcd 查找文件并设置为root,如果找到了这时的root 就是上面找到的磁盘分区
  root `bootdev` 返回U盘启动root

 4. 设置当前磁盘的最后一个分区为ROOT
   root `endpart` 设置当前硬盘的最后一个分区为root，同样应用在特殊场合。用于定位最后分区，如果当前root设备不是硬盘则会出错。
   这个命令在作一键还原的时候可能会比较有用，一般一键还原会装在最后一个分区。使用这个来定位就好了

 5. root 和 rootnoverify的区别
   `rootnoverify` 不会尝试`mount` 它所指向的分区,像一些特殊的软盘镜像启动，它里面的文件系统GRUB4DOS不认，这时如果使用root (fd0)就会出错