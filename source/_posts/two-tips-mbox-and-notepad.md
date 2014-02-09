title: "[转载] 两个雕虫小技 - MessageBox & Notepad"
id: 10
date: 2008-05-25 21:18:14
tags: 
- notepad
- 技巧
- 转载
- 截图
categories: 
- 实用文集
---

### 两个雕虫小技 - MessageBox & Notepad 

不用其它工具快速复制对话框上的文字,使用记事本自动添加记录时间.快速截图.

<!--more-->

{% blockquote 半瓶墨水 http://www.2maomao.com/blog/two-tips-mbox-and-notepad/ 两个雕虫小技 – MessageBox & Notepad %}

作者：半瓶墨水   链接：<http://www.2maomao.com/blog/two-tips-mbox-and-notepad/>

曾经为了记录MessageBox上面的文字，开一个Notepad，一个个敲下来。

今天才知道自己有多土：完全可以直接在MessageBox上面按 Ctrl + C 进行复制！

举个例子：
1. 打开Notepad
2. 写入：兔毛猫很帅
3. 点击Notepad关闭按钮，好，一个对话框跳出来了，看清楚上面写的啥
4. Ctrl + C
5. 点击取消，回到Notepad
6. Ctrl + V
7. 好了，现在你应该可以看到，第三步跳出的对话框内容已经粘贴到Notepad中了

对所有用MessageBox API实现的对话框适用。

好了，下面说说Notepad，新建一个文本，在第一行写入：
.LOG
没错，就是这么简单的一行”.LOG”，注意大小写。
然后再在下面写点儿啥，保存，关闭，再打开
你会发现，文件的最后插入了一行时间，比如：
1:57 PM 1/8/2008
这样就可以记日记了

好吧，我承认，用Notepad写日记是差了一点儿，但至少可以show一把。

{% endblockquote %}

PS: 我也顺便写一个实用技巧.快速截图.

需要对屏幕进行截图,这时直接按一下键盘上的**PrintScreen**按键就行了,截下来的图片放在剪贴板中,你可以打开画图软件或WORD,直接粘贴(**Ctrl+C**)就行了

若是只想截某个对话框比如上面提到过`MessageBox`对话框或某个程序的界面,也很简单,热键是*Alt+PrintScreen*,即先按着**Alt**键不放,再按一下**PrintScreen**,这样子就行了.


