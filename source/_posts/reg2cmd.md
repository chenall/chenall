title: "[原创] 将REG文件转换成CMD/BAT文件（REG与CMD混合编程）"
id: 11
date: 2008-05-27 11:57:46
tags: 
- REG2BAT
- REG2CMD
- 批处理
categories: 
- 程序设计/批处理
- 实用文集
---

批处理中经常需要使用注册表文件。一般的作法是使用命令 regedit /s 注册表文件.reg 其实根据.REG文件和.CMD文件的特性，可以合二为一。 

`.REG`文件中`;`开头代表注释 `.CMD`文件中`;`开头并不影响执行。所以可以从这个方面入手。下面的注册表可以在右键菜单中添加一个`MAKECAB`项。

<!--more-->

```
REGEDIT4

[HKEY_CLASSES_ROOT\*\shell\MakeCab\Command] 
@="makecab /D CompressionType=LZX /D CompressionMemory=21 /D Cabinet=ON /D Compress=ON \"%1\""
```

将上面的注册表存为MCAB.REG使用以下命令就可以直接在添加

```
regedit /s mcab.reg
```

现在根据**注册表**和**批处理**文件的特性就可以合二为一。由于**注册表**文件第一行是标识符不可改变。所以就将**批处理**代码放在第二行。

```
REGEDIT4 
;regedit /s "%~f0"&&goto :eof

[HKEY_CLASSES_ROOT\*\shell\MakeCab\Command] 
@="makecab /D CompressionType=LZX /D CompressionMemory=21 /D Cabinet=ON /D Compress=ON \"%1\""
```

把上面的代码存为`MCAB.CMD`效果和上面的两个一样。上面的代码还可以用如下形式

```
REGEDIT4 
;cls&@echo off&goto :start

[HKEY_CLASSES_ROOT\*\shell\MakeCab\Command]
@="makecab /D CompressionType=LZX /D CompressionMemory=21 /D Cabinet=ON /D Compress=ON \"%1\"" 
:start 
;regedit /s "%~f0" 
;echo.注册成功 
;pause
```

其实后面的批处理脚本前面不加;也是可以的，当然为了保证不冲突最好还是加一下。

附：批处理代码解释

```
;regedit /s "%~f0"&&goto :eof %~f0
```

`%~f0`就是批处理文件本身的完整路径（为什么不用`%0`呢，因为`%0`虽然也是代表自身但有时是不完整的） 

`&&` 前面的语句执行成功后就执行后面的语句.（如果是一个`&`就不管前面的语句是否执行成功都会执行后面的语句。） 

`goto :eof` 转到文件未尾，一般代表执行结束。（后面的`goto :start`，转到标签`:start`执行）