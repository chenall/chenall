title: "[grub4dos]在GRLDR中内置超过4KB菜单的方法"
id: 47
date: 2009-03-08 17:14:21
tags: 
- GRUB4DOS
- 菜单
categories: 
- GRUB4DOS
- 实用文集
---

大家都知道GRLDR中的内置菜单不能超过4KB,如果超过就会被截断.

如果超过4KB的菜单想要内置怎么办呢?

之前有想过使用GZ压缩,可是内置菜单不支持GZ压缩的格式.

后来得知启动后内置菜单的位置在内存中是固定的0X800处.

所以就想了个折中的办法.在内置的菜单中加入GZ压缩的菜单文件.

原理我就不多说了,贴上代码.

使用方法,

把以下代码另存为批处理文件,把你的菜单文件用GZ压缩(压缩后不能超过3KB)

然后使用批处理加参数执行(或直接把压缩后的菜单文件拖放到批处理文件图标上)

再用GRUBMENU导入生成的menu.lst就可以了.

注意使用grubmenu导入时要加-r参数如下.

grubmenu -r import grldr menu.lst

```bat
@echo off
setlocal
cd /d "%~dp0"
if not exist "%~1" (
  echo.参数错误!!
  pause
  goto :eof
)
for %%i in (%1) do echo.configfile (md)5+7,%%~zi>menu.lst
for %%i in (menu.lst) do set /a ns=512-%%~zi
fsutil file createnew menu_ex.lst %ns%
copy /y /b menu.lst /b + menu_ex.lst /b + %1 /b
del menu_ex.lst
pause 15.
```