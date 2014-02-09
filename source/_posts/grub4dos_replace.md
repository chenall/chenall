title: "[GRUB4DOS] 通用模块之字符串替换"
id: 767
date: 2011-08-17 13:12:30
tags: 
- GRUB4DOS
- 批处理
- 原创
categories: 
- GRUB4DOS/编程
---


本程序使用GRUB4DOS批处理编写.

实现了以下功能.

1.  替换某个变量中指定的字符串.
2.  删除某个变量中指定的字符串.

使用方法:

把脚本另存为REPLACE

然后直接调用

replace 变量名 字符串1 字符串2 [起始位置]

变量名是GRUB4DOS的一个变量,必须已经存在.因为替换的是这个变量的内容.

字符串1 查找指定字符串

字符串2 找到之后要替换的字符串.

		起始位置是可选的,可以选择从指定字符开始进行替换.起始位置之前的字符不会被改变.默认是0.

如果需要的话可以直接集成到你的批处理中.只要把:replace标签(包含)之后的代码复制过去然后使用

call :replace 来调用就行了.

复制代码请点这里:
```
!BAT
setlocal
debug off
if exist %1 goto :replace
echo $[0101] Replace module for grub4dos by chenall 2011-08-17
echo $[0101] replace the string $[0103]find $[0101]with string $[0103]replacewith$[0101] in VARIABLE name VAR
echo $[0102] usage:
echo $[0106]     replace VAR find replacewith [start]
echo $[0106]             VAR           a valid VARIABLE name(must defined).
echo $[0106]             find          the string that will be replaced.
echo $[0106]             replacewith   The replacement substring
echo $[0106]             start         Specifies the start. Default is 0.
echo
echo $[0104]  for more please visit $[0105]http://chenall.net/post/grub4dos_replace/
exit

:replace
if not exist %1 exit
echo %%%1%% > (md)0x266+2
set skip=%2
set skip_l=%@retval%
set /a skip=%4
if %skip%==0 || cat (md)0x266+1,%skip% >> (md)0x267+1
:replace_loop
cat --locate=%2 --number=1 --skip=%skip% (md)0x266+1 | set n=
if not exist n goto :replace_ok
if %n%==0 || cat --skip=%skip% (md)0x266+1,%?% >> (md)0x267+1
set /a skip=0x%n%+%skip_l%
echo -n %~3 >> (md)0x267+1
goto :replace_loop
:replace_ok
cat --skip=%skip% (md)0x266+1 >> (md)0x267+1
cat (md)0x267+1 | set %1=
endlocal && set %1=%%%1%%
```