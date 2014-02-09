title: "[原创] GRUB4DOS 通用模块之文件选择模块[2011-10-01 更新]"
id: 754
date: 2011-08-22 13:16:17
tags: 
- GRUB4DOS
- 批处理
- 文件列表
- 模块
- 原创
categories: 
- GRUB4DOS/批处理
---


本模块是一个GRUB4DOS的批处理

可用于搜索N级目录下的指定类型文件,并显示于菜单上

这是一个通用模块,可以通过参数直接调用或者通过预先设置变量的方法再调用,

使用方法请参考本站另一贴子

[[原创] GRUB4DOS 通用模块之分区选择](/post/grub4dos_hdpart/)

### 2011-08-22 (最终版）

1.  优化了检测代码．
2.  filpre支持子目录的检测．

### 2011-08-21 (变化比较大，请注意看更新说明，新的版本使用起来更加灵活．）

1.  菜单标题自动居中显示
2.  cmd的语法改变

    旧的版本`cmd=echo`要改成`cmd="echo %1"`

    在批处理中调用需要使用`%%1 `
    即，需要多一个`%1`的参数，这个参数用于接收文件参数．可以放在cmd参数的任意位置．
    并且支持类拟`%~dpnx1`的格式．

3.  新增`filpre`参数,指定文件名前辍.

    ~~注意:使用该参数时,`subdir`参数将不起作用,为了不影响其它情况下的检测速度,该参数只支持单级目录.~~

### 2011-08-16 更新:(新的版本处理的速度会慢一些,但精确度比较高,之前的版本会把带扩展名的目录当成文件显示在菜单上)

1.  添加了一个参数root,指定要从哪个目录开始找.例子:

    root=()/boot

    从只找/BOOT目录下的文件,注:前面的()是必须的,你也可以指定一个磁盘,代表从这个磁盘的这个目录开始查找比如

    root=(hd0,4)/boot

    则先从(hd0,4)/boot目录下查找文件,

    注:如果有带devs参数,必须确保上面的(hd0,4)磁盘有在在devs列表中.

2.  支持查找无扩展名的文件(之前的版本无扩展名的全部被当成一个子目录对待)
3.  新的ext参数只查找无扩展名的文件.`ext=.`会查找无扩展名的文件.
4.  菜单的注释新增了文件大小的提示(因为新的版本使用cat --locate=0来检测是否一个文件,就顺便把这个也利用上了.)

本模块支持的参数如下

*  `m.cmd`	指定每个菜单要执行的命令 ( 必须的其它的都是可选参数.)
*  `m.title`	 指定菜单标题
*  `m.return`	指定返回命令
*  `m.menu`	指定菜单位置(默认使用(md)0x210+16来存放菜单)
*  `m.subdir`	指定要查找的目录级数,默认1
*  `m.devs`	指定要查找的设备(find的参数)
*  `m.init`	 指定菜单的初始化命令
*  `m.ext`	指定扩展名(用于过滤),多个扩展名用双引号每个扩展名之间用空格分隔
		例: ext=".gho .txt"
*  `m.root`	指定根目录.(第一个被检查的目录)比如(hd0,4)/boot/或(hd0,5)
		注：该参数和m.devs参数配合使用时，将会只查找以上路径下的文件．例子:
		指定m.root=(hd0,4)/boot 或/boot
		只会查找符合条件的磁盘/BOOT目录下的文件．
*  `m.dirext`	   是否检测带扩展名的目录,设为任意值即启用,默认禁用,
		 除非有必要,否则不建议使用,启动这个参数会使得检测的速度变得很慢.
* `m.filpre`　  指定文件名前辍,过滤非以filpre参数开头的文件.(测试)


以下是使用的效果截图,欢迎反馈BUG或建议.(图片原链接已失效,以后再抽空重新弄)

1.  ### 当前分区,根目录

2.  ### 当前分区,3级目录

3.  ### 当前分区,二级目录,

4.  ### 二级目录,所有硬盘分区

5.  ### 2011-08-16更新的版本效果图.


```bat
!BAT
setlocal
debug off
checkrange 20110918:-1 read 0x8278 || echo Please use grub4dos-0.4.5b-2011-09-18 or above! && exit 1
if "%1"=="" goto :参数检测
set *
:获取参数
if /i "%1"=="" && goto :参数检测
set m.%~1=%~2
shift 1
shift 1
goto :获取参数

:help
echo Usage: %0 cmd="cmd for each file" OPTIONS..
echo OPTIONS:
echo -e \t title="the main menu title"
echo -e \t menu="pre_set menu file"
echo -e \t subdir=n
echo -e \t devs="find parameters"
echo -e \t return="return cmd"
echo -e \t init="init cmd"
echo -e \t filpre=filepre
echo -e \t ext=fileext
echo -e \t root="root dir. e.g. ()/boot/"
echo -e \n\t for more please visit http://chenall.net
exit

:菜单居中
set title=屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯
set title=%title:~0,%1%%
exit

:参数检测
if not exist m.cmd && goto :help
if not exist m.title && set m.title=Please select a file
if not exist m.menu && set m.menu=(md)0x210+16 && echo -e default 1\ndebug off > (md)0x210+16
if not exist m.subdir && set m.subdir=1
if not exist m.devs && set m.devs=--set-root
if not exist m.root && set m.root=()
echo -e !BAT\necho %m.cmd% \>\> %m.menu% > (md)0x260+4
::获取标题字符数量用于标题居中
set title=%m.title%
set /a title=68-*0x4CB00>>1
call :菜单居中 %title%
::自动生成菜单
set ?_n=1
set m.info=File list menu for grub4dos by chenall.\n\t\t for more information please visit http://chenall.net
if exist m.init && echo %m.init% >> %m.menu%
echo title %title% %m.title% %title%\n\n\t%m.info% >> %m.menu%
echo pause %m.info% >> %m.menu%
echo -e $[0106] %m.info%
echo $[0102] Please wait ...
echo $[1105] Working......
root %m.root%
if exist m.debug echo %@time%
find %m.devs% call :生成文件列表 || echo Unknow Error.
if exist m.debug pause %@time%
echo title 屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯屯 http://chenall.net 屯 2011-08-22 屯\n\n\t%m.info% >> %m.menu%
echo pause %m.info% >> %m.menu%
set ?_n=
if not exist m.return && configfile %m.menu%
echo title   0. Return >>  %m.menu%
echo %m.return%  >> %m.menu%
echo boot >> %m.menu%
configfile %m.menu%
exit

:文件过滤
if "%~1"=="" exit
set tmp=%1
shift
if "%tmp:~-2,1%"=="~" && goto :文件过滤
if "%tmp:~0,1%"=="$" && goto :文件过滤
call :检测文件 %0
goto :文件过滤

:获取文件大小
calc *0x8290>>30 && set size=30GB && exit
calc *0x8290>>20 && set size=20MB && exit
calc *0x8290>>10 && set size=10KB && exit
set size=00B
exit

:检测文件
if exist m.debug1 && echo %~f1
::检测前辍
call Fn.10 "%m.filpre%" "%~n1"
if "%@retval%"=="1" && goto :检测目录
::检测后辍
if exist m.ext || goto :添加菜单
set f.type=%~x1
if not exist f.type set f.type=.
call :过滤 %m.ext% && goto :添加菜单

:检测目录
if %m.subdir%==0 && exit
if exist m.dirext || if "%~x1"=="" || exit
cat --length=0 /%1 && exit
if exist m.debug2 && echo $[0101] %~f1
goto :生成文件列表

:过滤
if "%1"=="" && exit 1
shift
if /i "%0"=="%f.type%" || goto :过滤
exit

:添加菜单
cat --length=0 /%1 || goto :检测目录
call :获取文件大小
if exist m.debug3 && echo $[0102] %~f1
calc *0x8290=*0x8290>>%size:~0,2%
set size=%@retval% %size:~2%
set m=1    %?_n%
echo title %m:~-3%. %~f1\n\n\t~%size% %~f1  >> %m.menu%
(md)0x260+4 %~f1
echo boot >> %m.menu%
set /a ?_n=%?_n%+1
exit

:生成文件列表
setlocal
if "%~1"=="" || root %~f1
set /a m.subdir=%m.subdir%-1
ls | call :文件过滤= || echo
endlocal
exit
```