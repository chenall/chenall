title: "[整理] Windows Api 调用 keybd_event 相关资料(VB)"
id: 17
date: 2008-07-05 11:57:21
tags: 
- keybd_event
- 资料
- VB
categories: 
- 程序设计/VB
---

keybd_event VB声明.

### VB声明
```
Declare Sub keybd_event Lib "user32" Alias "keybd_event" (ByVal bVk As Byte, ByVal bScan As Byte, ByVal dwFlags As Long, ByVal dwExtraInfo As Long)
```
### 说明

这个函数模拟了键盘行动

### **参数类型及说明**

* `bVkByte` 欲模拟的虚拟键码
* `bScanByte` 键的OEM扫描码
* `dwFlagsLong` 零；或设为下述两个标志之一
   * **KEYEVENTF_EXTENDEDKEY=`&H1`**  指出是一个扩展键，而且在前面冠以0xE0代码
   * **KEYEVENTF_KEYUP=`&H2`**  模拟松开一个键
* dwExtraInfoLong，通常不用的一个值。api函数GetMessageExtraInfo可取得这个值。允许使用的值取决于特定的驱动程序

#### **注解**
这个函数支持屏幕捕获（截图）。在win95和nt4.0下这个函数的行为不同


