title: "[分享] LuaJIT的FFI调用WINDOWS API功能示例"
id: 939
date: 2013-12-15 18:12:05
tags: 
- FFI
- LUA
- WINDOWS
- API
categories: 
- 程序设计/LUA
---

# 关于LuaJIT,以下是官网的介绍.

<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px;">LuaJIT is a </span>**Just-In-Time Compiler**<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px;"> (JIT) for the </span>[Lua](http://www.lua.org/)<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px;"> programming language. Lua is a powerful, dynamic and light-weight programming language. It may be embedded or used as a general-purpose, stand-alone language.</span>

LuaJIT is Copyright © 2005-2013 Mike Pall, released under the [MIT open source license](http://www.opensource.org/licenses/mit-license.php).

<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px;">LuaJIT对原版LUA进行了一些扩展,功能更强大,实用,速度也更快.本文主要介绍一下</span><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small;"><span style="line-height: 20px;">FFI扩展功能.</span></span>

<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small;"><span style="line-height: 20px;">FFI库允许调用外部C函数以及使用C数据结构.这意味着我们可以通过它来调用一些系统API或DLL的函数,像调用LIBCURL来实现网络功能.等...</span></span>

<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small;"><span style="line-height: 20px;">比如以下来自官网最简单的应用代码</span></span>

```lua
--Load the FFI library.
local ffi = require("ffi")

--Add a C declaration for the function. The part inside the double-brackets (in green) is just standard C syntax.
ffi.cdef[[
    int printf(const char *fmt, ...);
]]

--Call the named C function — Yes, it's that simple!
ffi.C.printf("Hello %s!", "world")
```
```lua
local ffi = require("ffi")
ffi.cdef[[
    int MessageBoxA(void *w, const char *txt, const char *cap, int type);
]]
ffi.C.MessageBoxA(nil, "Hello world!", "Test", 0)
```

看起来很简单不是吗?

这里给一个稍微复杂一些的例子,这是我在是学习过程中碰到的一些问题的总结,里面包括了一些常用的操作,像ffi.new 创建一个C的类型,ffi.cast数据类型转换,等.有兴趣的可以通过这个例子来学习一下如何应用.少走一些弯路.希望对大家有用.

本代码要保存为ANSI格式才可以正常运行
```lua
local ffi = require("ffi")
ffi.cdef[[
    typedef char TCHAR;
    typedef unsigned int UINT;
    typedef TCHAR _LPTSTR;
    typedef const TCHAR *LPCTSTR;
    typedef LPCTSTR LPCSTR;
    typedef UINT WPARAM;
    typedef unsigned long LPARAM;
    typedef UINT HWND;
    typedef struct {
        long x;
        long y;
    } POINT,_PPOINT;
    void* malloc(size_t size);
    void* free(void* memblock);
    bool GetCursorPos(PPOINT lpPoint);
    HWND WindowFromPoint(POINT Point);
    int GetWindowTextA(HWND hWnd, LPTSTR lpString, int nMaxCount);
    bool SetWindowTextA(HWND hWnd, LPCTSTR lpString);
    int SendMessageA(HWND hwnd, UINT msg, WPARAM wParam, LPARAM lParam);
    int MessageBoxA(HWND hWnd,LPCSTR lpText,LPCSTR lpCaption,UINT uType);
]]
local user32 = ffi.load("User32.dll")--WINDOWS API函数所在DLL文件
local win32 = ffi.load('msvcrt.dll')--malloc和free函数
local pos=ffi.new("POINT");
local oks = user32.GetCursorPos(pos)--获取当前鼠标位置
local IDYES = 6
local IDNO = 7
local WM_SETTEXT = 0x000C
local WM_GETTEXT = 0x000D
if oks then
local hwnd = user32.WindowFromPoint(pos)--获取指定位置下窗体的句柄
local lpString = ffi.new("char*",win32.malloc(1024))--分配内存
local test = user32.GetWindowTextA(hwnd,lpString,1023)--获取文本
local str1 = ffi.string(lpString);
local strtest ="FFI 调用SetWindowText功能测试"
local t = user32.MessageBoxA(0,"是否把以下窗体\n&lt;"..str1.."&gt;\n的标题修改为以下内容:\n"..strtest,"LUAJIT FFI 调用WINAPI测试",0x44)--MB_ICONINFORMATION || 0x00000004L
if t == IDYES then
    if user32.SetWindowTextA(hwnd,strtest) == true then
        user32.MessageBoxA(0,"修改成功","测试",0x40)
    end
end
--[[注: Windows API 的SendMessage就是SendMessageA或SendMessageW
    像MessageBox也是类型的MessageBoxA和MessageBoxW
    本文例子使用了ffi.cast进行了数据类型的转换,如果不想转换可以修改一下SendMessageA的定义改为如下(我最早就是不知道有ffi.cast所以用的修改定义的方法)
    int SendMessageA(HWND hwnd, UINT msg, WPARAM wParam, LPCTSTR lParam);
    就可以直接使用了,例:
    user32.SendMessageA(hwnd,WM_SETTEXT,1024,"用SendMessage和WM_SETTEXT功能改写目标字符串")
    这个SendMessage是WINDOWS一个很重要的API,后面的两个参数很灵活,根据不同的功能需求,可以是这符串/数字或指针,数组之类的.--]]
user32.MessageBoxA(0,"测试使用SendMessage来实现同样的功能","测试2",0x40)
user32.SendMessageA(hwnd,WM_GETTEXT,1024,ffi.cast("LPARAM",lpString))--通过ffi.cast功能进行类型转换
user32.MessageBoxA(0,"用SendMessage和WM_GETTEXT功能获取到的窗体标题为\n"..ffi.string(lpString),"测试2",0x40);
user32.SendMessageA(hwnd,WM_SETTEXT,1024,ffi.cast("LPARAM","用SendMessage和WM_SETTEXT功能改写目标字符串"))
user32.MessageBoxA(0,"目标标题已改变","测式2",0x40)
win32.free(lpString)--释放内存
end
```