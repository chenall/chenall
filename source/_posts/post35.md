title: "一个文件处理的小工具"
id: 35
date: 2008-12-19 23:04:37
tags: 
- 软件
- str
- strw
categories: 
- 软件推荐/批处理
---
{% raw %}
STR [File] [Start] [Bytes] [/C|/I] [dstFile] [Address]

         File: A File to be Processed data.  //文件

        Start: Offset to Process data.  //文件中处理数据的起始位置  （文件的开头位置为0）

        Bytes: Bytes to Process. //要处理的字节数量 （如果输入0，则表示从Start开始到文件末尾）

           /C: Copy Bytes from File to dstFile.  //从源文件向目标文件复制数据

           /I: Insert Bytes to dstFile from File. //从源文件向目标文件插入数据，插入数据后目标文件增加 Bytes个字节

      dstFile: A File to Write Result data.  //目标文件

      Address: Offset to Write Result data.  //目标文件中要复制或插入数据的位置 （如果目标文件不存在，该值被忽略）

STR [File] [Start] [Bytes] [/D] [dstFile]

           /D: Delete Bytes from File &amp; Write Result to dstFile.  //从源文件删除数据并结果写入目标文件

STR [File] [Start] [Bytes] [/V] [/A] [/P]

           /V: View File In Hex Style.  //十六进制方式查看文件

           /A: Show ASCII Value. //显示ASCII码

           /P: Pause Echo Screen.  //满屏暂停

STR [File] [Start] [Bytes] [/F] [/Hex|/Asc]:[Value] [/I] [/A]

        Bytes: Must be 0.  //必须为0

           /F: Find String in File.  //在文件中查找字符串

         /Hex: Hex Style. //十六进制方式

         /Asc: ASCII Style.  //ASCII码方式

        Value: Hex_Digital/ASCII String (40 Characters Maximum).  //字符传真的值，最长40个字符 （如果是十六进制串长度应为双数）

           /I: Ignore Case. //忽略大小写 

           /A: Process All Value in File. //在文件中查找所有满足要求的字符串（默认查找1次）


STR [File] [Start] [Bytes] [/E] [/Hex|/Asc]:[Value]

        Bytes: Must be 0.  //必须为0

           /E: Edit File.  //编辑文件

STR [File] [Start] [Bytes] [/R] [SrcString] [DstString] [/I] [/A]

        Bytes: Must be 0.  //必须为0

           /R: Relace SrcString with DstString.  //字符常替换

    SrcString: [/Hex|/Asc]:[Value].   //源串，可以使用十六进制或ASCII码串

    DstString: [/Hex|/Asc]:[Value].  //目标串，可以使用十六进制或ASCII码串

           /A: Process All SrcString in File.  //在文件中查找所有源字符串（默认替换1次）

说明：
    1.  使用 /C 和 /I 命令时，如果目的文件不存在，Adress 的值将被忽略，直接执行将源文件从 Start 开始的 Bytes 个字节写入到新创建的目的文件中

    2.  使用 /C 和 /I 命令时，如果目的文件存在，并且不输入 Address，则Address 默认为0，也就是文件的起始位置。

    3.  目前处理的单个文件大小不超过 2G

例子：

str  1.exe 0x100  0x10 /d 2.bin  执行将文件1.exe 从位置256开始的16个字节删除，并将结果写入到2.bin，文件2.bin的长度将比1.exe长度小16

str  1.exe 0x100  0x10 /c 2.bin 20  执行将文件1.exe 从位置256开始的16个字节写入到2.bin的20位置,也就是文件2.bin从位置20开始的16字节被覆盖

str  1.exe 0x100  0x10 /i 2.bin 20  执行将文件1.exe 从位置256开始的16个字节插入到2.bin的20位置，结果文件2.bin的长度将增加16字节

str  1.exe 0x100  0 /v /p /a  从文件偏移位置256开始在屏幕上显示文件内容，如果Bytes输入为0，则表示从Start开始至文件末尾。

str  1.exe 0x100  0 /e /hex:11223344  将文件偏移位置256开始的4个字节修改为，0x11,0x22,0x33,0x44。

str  1.exe 0x100  0 /e /asc:1234  将文件偏移位置256开始的4个字节修改为，1234, 也就是0x31,0x32,0x33,0x34

查找替换算法使用的是 KMP 算法，不重复计数，如文件 1.txt 的内容为10个字符0：
0000000000

如执行命令： str 1.txt 0 0 /f /asc:0000 /a

则执行结果为：

   Find string At:
   
   0  0x0
   
   4  0x4

不会是：
   Find string At:
   0  0x0

   1  0x1

   2  0x2

   3  0x3

   4  0x4

   5  0x5

   6  0x6

压缩包中包含dos版本和win32版本
 {% endraw %}

程序处理返回值:
```
#define SUCCESS 0
#define COMMON_USE_ERROR 1
#define OPEN_FILE_ERROR 2
#define PRG_MODIFIED 3
#define FILE_READ_ERROR 4
#define PARAMETER_ERROR 5
#define CREATE_FILE_ERROR 6
#define FILE_WRITE_ERROR 7
#define SRCFILE_DSTFILE_SAME 8
#define USER_CANCEL 9
#define FILE_NOT_EXIST 10
#define FILE_SEEK_ERROR 11
#define STRING_NOT_FOUND 12 
```

[200812192314097256.rar]([CDN_URL]:/upload/2008/12/200812192314097256.rar)
