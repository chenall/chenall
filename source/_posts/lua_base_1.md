title: "[学习] LUA脚本学习1"
id: 904
date: 2013-03-27 17:58:18
tags: 
- LUA
- 学习
categories: 
- 程序设计/LUA
---

1. 获取WINDOWS文件的文件名/路径/扩展名
   例子:
  ```lua
	file="c:\\Windows\\notepad.txt"
	FileName = file:match("([^\\]+)$") -- notepad.txt
	FilePath = file:sub(1,-FileName:len()-1) -- c:\Windows\
	FileExt = FileName:match("%.[^%.]*$") -- .txt
  ```

2. WINDOWS下环境变量扩展

  例子:
  ```lua
   path = "%WinDir%\\Notepad.exe"
   path = path:gsub("%%(%S+)%%",os.getenv) -- C:\Windows\notepad.exe
  ```
3. 获取CMD命令输出结果

  例子:
  ```lua
  local f = io.popen('dir /b /s')
  print(f:read("*a") -- 读取所有内容
  ```
  其中read参数可以如下
	*   *a 读取所有内容
	*   *n 读取为数据(当输出为数字时用,否则会得到空值)
	*   *l  读取一行 和 f:line() 一样(read不加参数时默认)
	*   数字 读取指定数量的字符. 比如输出 "123456" f:read(3) -- "123"
		
  使用以下命令可以循环读取每一行.
  ```lua
	for line in f:lines() do
	print(line)
	end
  ```

  f:lines()也可以用f:read("*l")
  或用下面语句读取每4个字节
  ```lua
  for line in f:read(4) do
  print(line)
  end
  ```

4. 字符串相关操作
 * 连接使用".."
 ```lua
  a="abcd"
  b=3456
  print(a..b.."test")  ---- abcd3456test
  ```
  * string.len   计算字符串长度
  ```
    a = "test"
    a:len()   -- 4 或
    string.len(a) -- 4
    --也可以直接用 `#`
    print(#a) --- 4
  ```
  * string.sub  字符串提取
  ```
    a="123456"
    a:sub(1,3)  或 string.sub(a,1,3)  下同 --- 123
    a:sub(-1) -- 6
    a:sub(1,-3) -- 1234
  ```
  * 相关资料参考: http://www.lua.org/manual/5.1/manual.html

代码在线调试器: http://www.lua.org/cgi-bin/demo