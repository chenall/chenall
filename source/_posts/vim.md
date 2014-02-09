title: "[转] Vim入门图解说明."
id: 128
date: 2010-03-01 10:41:11
tags: 
- vim
categories: 
- 实用文集
---


来源:[http://blog.vgod.tw/2009/12/08/vim-cheat-sheet-for-programmers/](http://blog.vgod.tw/2009/12/08/vim-cheat-sheet-for-programmers/)

感谢作者(vgod)用心绘制的[Vim入门图解说明](http://blog.vgod.tw/2009/12/08/vim-cheat-sheet-for-programmers/)

![](http://blog.vgod.tw.s3.amazonaws.com/wp-content/uploads/2009/12/vim-cheat-sheet-full-thumb.png?9d7bd4)

![](http://blog.vgod.tw.s3.amazonaws.com/wp-content/uploads/2009/12/vim-cheat-sheet-diagram-thumb.png?9d7bd4)

[PDF版下载](http://blog.vgod.tw/wp-content/uploads/2009/12/vgod-vim-cheat-sheet-full.pdf)

这个图把vim中基本的移动方法都画上去了，为了方便programmer，特别列出了很多只有写程式才会用的按键。除了这些以外，其实还有一些好用的东西我还没想到怎么画上去比较好(像是tags、没有标准快速键的tab、man..)，如果大家有idea欢迎提供。

这些图示依照移动的单位大小分为以下几个种类，分别用不同颜色标示：

（注意，这不是完整的vim快速键列表，只是我觉得比较常用的键而已。）

<table>
	<tbody>
		<tr>
			<th colspan="2">字元(character)</th>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #7b7b00; WIDTH: 1.5em; COLOR: white">h</div>
			</td>
			<td>左</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #7b7b00; WIDTH: 1.5em; COLOR: white">j</div>
			</td>
			<td>下</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #7b7b00; WIDTH: 1.5em; COLOR: white">k</div>
			</td>
			<td>上</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #7b7b00; WIDTH: 1.5em; COLOR: white">l</div>
			</td>
			<td>右</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<th colspan="2">单字(word)</th>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #a19700; WIDTH: 1.5em">w</div>
			</td>
			<td>下一个word</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #a19700; WIDTH: 1.5em">W</div>
			</td>
			<td>下一个word(跳过标点符号)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #a19700; WIDTH: 1.5em">b</div>
			</td>
			<td>前一个word</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #a19700; WIDTH: 1.5em">e</div>
			</td>
			<td>跳到目前word的尾端</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<th colspan="2">行(line)</th>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #fff105; WIDTH: 1.5em">0</div>
			</td>
			<td>跳到目前行的开头</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #fff105; WIDTH: 1.5em">^</div>
			</td>
			<td>跳到目前行第一个非空白字元</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #fff105; WIDTH: 1.5em">$</div>
			</td>
			<td>跳到行尾</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<th colspan="2">段落(paragraph)、区块(block)</th>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff6500; WIDTH: 1.5em">{</div>
			</td>
			<td>上一段(以空白行分隔)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff6500; WIDTH: 1.5em">}</div>
			</td>
			<td>下一段(以空白行分隔)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff6500; WIDTH: 1.5em">[{</div>
			</td>
			<td>跳到目前区块开头</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff6500; WIDTH: 1.5em">]}</div>
			</td>
			<td>跳到目前区块结尾</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff6500; WIDTH: 1.5em">%</div>
			</td>
			<td>跳到目前对应的括号上(适用各种括号,有设定好的话连HTML tag都能跳)</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<th colspan="2">萤幕(screen)、绝对位置</th>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #00c100; WIDTH: 1.5em">H</div>
			</td>
			<td>萤幕顶端</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #00c100; WIDTH: 1.5em">M</div>
			</td>
			<td>萤幕中间</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #00c100; WIDTH: 1.5em">L</div>
			</td>
			<td>萤幕底部</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #00c100; WIDTH: 1.5em">:**x**</div>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #00c100; MARGIN-TOP: 3px; WIDTH: 1.5em">**x**G</div>
			</td>
			<td>跳到第x行(x是行号)</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<th colspan="2">搜寻(search)</th>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #008fff">/xxxx</div>
			</td>
			<td>搜寻xxxx</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #008fff; WIDTH: 1.5em">#</div>
			</td>
			<td>往前搜寻目前游标所在的字(word)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #008fff; WIDTH: 1.5em">*</div>
			</td>
			<td>往后搜寻目前游标所在的字(word)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #008fff; WIDTH: 1.5em">f**x**</div>
			</td>
			<td>在目前行往后搜寻字元x</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #008fff; WIDTH: 1.5em">gd</div>
			</td>
			<td>跳到目前游标所在的字(word)的定义位置(写程式用, 跳到定义变数/函式的地方)</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<th colspan="2">分割视窗</th>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff0024">:split</div>
			</td>
			<td>分割视窗(可加档名顺便开启另一档案)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff0024">:diffsplit xxx</div>
			</td>
			<td>以分割视窗和档案xxx做比较(diff)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff0024">Ctrl-W p</div>
			</td>
			<td>跳到前一个分割视窗(在两个分割窗来回切换)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff0024">Ctrl-W j</div>
			</td>
			<td>跳到下面的分割窗</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff0024">Ctrl-W h</div>
			</td>
			<td>跳到左边的分割窗</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff0024">Ctrl-W k</div>
			</td>
			<td>跳到上面的分割窗</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #ff0024">Ctrl-W l</div>
			</td>
			<td>跳到右边的分割窗</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
			<th colspan="2">自动补齐(Auto-completion) (在Insert Mode中使用)</th>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #f98cff">Ctrl-N</div>
			</td>
			<td>自动补齐档案内的下一个可能字(word)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #f98cff">Ctrl-P</div>
			</td>
			<td>自动补齐档案内的上一个可能字(word)</td>
		</tr>
		<tr>
			<td>
				<div style="TEXT-ALIGN: center; BACKGROUND-COLOR: #f98cff">Ctrl-X Ctrl-F</div>
			</td>
			<td>自动补齐档名</td>
		</tr>
	</tbody>
</table>

