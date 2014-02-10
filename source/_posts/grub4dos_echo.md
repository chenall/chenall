title: "[GRUB4DOS] 测试功能增强版ECHO"
id: 566
date: 2010-09-17 18:19:51
tags: 
- ECHO
- GRUB4DOS
categories: 
- GRUB4DOS/扩展
---

搞了一个增强版的ECHO命令,看看效用还有反应如何.可以在屏幕任意位置显示字符并且可以指定颜色.

颜色设置只支持console模式(文本模式).

使用方法(具体请下载附件研究)

注: `最新版本的GRUB4DOS已经内置此功能,并且功能得到了增强`,__想要编写GRUB4DOS扩展的可以下载源码研究一下__

本站所有GRUB4DOS扩展的源码都可以从这里下载: https://code.google.com/p/grubutils/

echo [-n] [-P:XXYY] MESSAGE
 其中MESSAGE中可以使用$[ABCD]来指定后面显示的字符使用的颜色.
 A 值为1时闪烁 (blinking foreground color).
 B 值为1时高亮(light)
 C [0-7]背景色(background color)
 D [0-7]前景色-字体颜色(foreground color)
 
截图效果.(随便弄的,对外观不是很感冒)_:)

注:图片就是附件执行的效果,未修改添加.
 嘻嘻,对于某些喜欢修改XXXX的爱好者来说可能会有用,因为你可以自定义整个屏幕上显示的信息.

![]([CDN_URL]:/upload/2010/09/B6860606576903B7DADE22718F1B8DA060588955.png)
