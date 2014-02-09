title: "[整理] Windows API 调用常量声明之按键篇"
id: 16
date: 2008-07-05 11:55:12
tags: 
- API
- WINDOWS
- VB
- 声明
categories: 
- 程序设计/VB
---

常用键盘虚拟码声明.

<!-- more -->

```vb
'Virtual Keys, Standard Set
Public Const VK_LBUTTON = &H1
Public Const VK_RBUTTON = &H2
Public Const VK_CANCEL = &H3  'Ctrl + Break 过程
Public Const VK_MBUTTON = &H4             '  NOT contiguous with L RBUTTON

Public Const VK_BACK = &H8 'BackSpace 键
Public Const VK_TAB = &H9

Public Const VK_CLEAR = &HC
Public Const VK_RETURN = &HD '回车键

Public Const VK_SHIFT = &H10
Public Const VK_CONTROL = &H11
Public Const VK_MENU = &H12 'ALT按键
Public Const VK_PAUSE = &H13 
Public Const VK_CAPITAL = &H14 'Caps Lock 键（大小写转换键）

Public Const VK_ESCAPE = &H1B

Public Const VK_SPACE = &H20
Public Const VK_PRIOR = &H21 '上翻页
Public Const VK_NEXT = &H22 '下翻页
Public Const VK_END = &H23
Public Const VK_HOME = &H24
Public Const VK_LEFT = &H25
Public Const VK_UP = &H26
Public Const VK_RIGHT = &H27
Public Const VK_DOWN = &H28
Public Const VK_SELECT = &H29
Public Const VK_PRINT = &H2A
Public Const VK_EXECUTE = &H2B
Public Const VK_SNAPSHOT = &H2C 'Print Screen键
Public Const VK_INSERT = &H2D
Public Const VK_DELETE = &H2E
Public Const VK_HELP = &H2F
Public Const VK_APPS As Long = &H5D 'Applications 键（相当于鼠标右键）

' VK_A thru VK_Z are the same as their ASCII equivalents: 'A' thru 'Z'
'使用ASC("A")-ASC("Z")可得到
' VK_0 thru VK_9 are the same as their ASCII equivalents: '0' thru '9′
'使用ASC("0")-ASC("9")可得到

'以下是小键盘.
Public Const VK_NUMPAD0 = &H60
Public Const VK_NUMPAD1 = &H61
Public Const VK_NUMPAD2 = &H62
Public Const VK_NUMPAD3 = &H63
Public Const VK_NUMPAD4 = &H64
Public Const VK_NUMPAD5 = &H65
Public Const VK_NUMPAD6 = &H66
Public Const VK_NUMPAD7 = &H67
Public Const VK_NUMPAD8 = &H68
Public Const VK_NUMPAD9 = &H69

Public Const VK_MULTIPLY = &H6A '乘号键 *
Public Const VK_ADD = &H6B '加号键 +
Public Const VK_SEPARATOR = &H6C'回车键 
Public Const VK_SUBTRACT = &H6D '减号键 -
Public Const VK_DECIMAL = &H6E '小数点 .
Public Const VK_DIVIDE = &H6F '除号键 /

'F1-F24
Public Const VK_F1 = &H70
Public Const VK_F2 = &H71
Public Const VK_F3 = &H72
Public Const VK_F4 = &H73
Public Const VK_F5 = &H74
Public Const VK_F6 = &H75
Public Const VK_F7 = &H76
Public Const VK_F8 = &H77
Public Const VK_F9 = &H78
Public Const VK_F10 = &H79
Public Const VK_F11 = &H7A
Public Const VK_F12 = &H7B
Public Const VK_F13 = &H7C
Public Const VK_F14 = &H7D
Public Const VK_F15 = &H7E
Public Const VK_F16 = &H7F
Public Const VK_F17 = &H80
Public Const VK_F18 = &H81
Public Const VK_F19 = &H82
Public Const VK_F20 = &H83
Public Const VK_F21 = &H84
Public Const VK_F22 = &H85
Public Const VK_F23 = &H86
Public Const VK_F24 = &H87

Public Const VK_NUMLOCK = &H90 
Public Const VK_SCROLL = &H91 'Scroll Lock键

'
'   VK_L VK_R – left and right Alt, Ctrl and Shift virtual keys.
'   Used only as parameters to GetAsyncKeyState() and GetKeyState().
'   No other API or message will distinguish left and right keys in this way.
'  /
Public Const VK_LSHIFT = &HA0
Public Const VK_RSHIFT = &HA1
Public Const VK_LCONTROL = &HA2
Public Const VK_RCONTROL = &HA3
Public Const VK_LMENU = &HA4 '左ALT键
Public Const VK_RMENU = &HA5 '右ALT键

Public Const VK_ATTN = &HF6
Public Const VK_CRSEL = &HF7
Public Const VK_EXSEL = &HF8
Public Const VK_EREOF = &HF9
Public Const VK_PLAY = &HFA
Public Const VK_ZOOM = &HFB
Public Const VK_NONAME = &HFC
Public Const VK_PA1 = &HFD
Public Const VK_OEM_CLEAR = &HFE
 

Private Const VK_OEM_1 As Long = &HBA 'Windows 2000：对于 US 标准键盘，是“;:”
Private Const VK_OEM_2 As Long = &HBF 'Windows 2000：对于 US 标准键盘，是“/?”键
Private Const VK_OEM_3 As Long = &HC0 'Windows 2000：对于 US 标准键盘，是“`~”键
Private Const VK_OEM_4 As Long = &HDB 'Windows 2000：对于 US 标准键盘，是“[{”键
Private Const VK_OEM_5 As Long = &HDC 'Windows 2000：对于 US 标准键盘，是“\|”键
Private Const VK_OEM_6 As Long = &HDD 'Windows 2000：对于 US 标准键盘，是“]}”键
Private Const VK_OEM_7 As Long = &HDE 'Windows 2000：对于 US 标准键盘，是“单/双引号”键
Private Const VK_OEM_COMMA As Long = &HBC 'Windows 2000：对于任何国家/地区，是“,”键
Private Const VK_OEM_MINUS As Long = &HBD 'Windows 2000：对于任何国家/地区，是“-”键
Private Const VK_OEM_PERIOD As Long = &HBE 'Windows 2000：对于任何国家/地区，是“.”键
Private Const VK_OEM_PLUS As Long = &HBB 'Windows 2000：对于任何国家/地区，是“+”键
```