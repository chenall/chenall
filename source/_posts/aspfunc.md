title: "ASP函数语法速查表"
id: 51
date: 2009-04-01 00:05:30
tags: 
- ASP
- 函数
- 编程
categories: 
- 程序设计/ASP
---
{% raw %}
ASP函数语法速查表
<TABLE class="table table-bordered">
<TBODY>
<tr class="success">
<td>Abs(数值)</TD>
<td>绝对值。一个数字的绝对值是它的正值。空字符串 (null)   的绝对值，也是空字符串。未初始化的变数，其绝对为 0</TD>
<td>例子：ABS(-2000) <BR>
  结果：2000</TD>
</TR>
<tr class="danger">
<td>Array(以逗点分隔的数组元素)</TD>
<td>Array 函数传回数组元素的值。</TD>
<td>例子： <BR>
  A=Array(1,2,3)<BR>
  B=A(2)<BR>
  结果： 2<BR>
  说明：变量B为A数组的第二个元素的值。 </TD>
</TR>
<TR class="success">
<td>Asc(字符串)</TD>
<td>将字符串的第一字母转换成 ANSI(美国国家标准符号)字码。</TD>
<td>例子：Asc(＂Internet＂)<BR>
  结果：73<BR>
  说明：显示第一字母 I 的 ANSI 字码。 </TD>
</TR>
<tr class="danger">
<td>CBool(表达式)</TD>
<td>转换成布尔逻辑值变量型态(True 或False)</TD>
<td>例子：CBool(1+2)<BR>
  结果：True </TD>
</TR>
<TR class="success">
<td>CDate(日期表达式)</TD>
<td>换成日期变量型态。可先使用 IsDate 函数判断是否可以转换成日 期。</TD>
<td>例子： CDate (now( )+2) <BR>
  结果：2000/5/28 10:30:59 </TD>
</TR>
<tr class="danger">
<td>CDbl(表达式)</TD>
<td>转换成DOUBLE变量型态。</TD>
<td></TD>
</TR>
<TR class="success">
<td>Chr(ANSI 字码)</TD>
<td>将ASCII 字码转换成字符。</TD>
<td>例子： Chr(72)<BR>
  结果： H </TD>
</TR>
<tr class="danger">
<td>CInt(表达式)</TD>
<td>转换成整数变量型态。</TD>
<td>例子： CInt ("3.12") <BR>
  结果： 3 </TD>
</TR>
<TR class="success">
<td>CLng(表达式)</TD>
<td>转换成LONG 变量型态。</TD>
<td></TD>
</TR>
<tr class="danger">
<td>CSng(表达式)</TD>
<td>转换成SINGLE 变量型态。</TD>
<td></TD>
</TR>
<TR class="success">
<td>CStr(表达式)</TD>
<td>转换成字符串变量型态。</TD>
<td></TD>
</TR>
<tr class="danger">
<td>Date()</TD>
<td>传回系统的日期。</TD>
<td>例子： Date <BR>
  结果： 2000/5/13</TD>
</TR>
<TR class="success">
<td>DateAdd(I , N , D)</TD>
<td>将一个日期加上一段期间后的日期。 I ：设定一个日期( Date)所加上的一段期间的单位。譬如 interval="d" 表示   N的单位为日。 I的设定值如下： <BR>
  yyyy Year 年 <BR>
  q Quarter 季 <BR>
  m Month 月 <BR>
  d Day 日 <BR>
  w   Weekday 星期 <BR>
  h Hour 时 <BR>
  n Minute 分 <BR>
  s Second 秒 <BR>
  N   ：数值表达式，设定一个日期所加上的一段期间，可为正值或负值，正值表示加(结果为 &gt;date 以后的日期)，负值表示减(结果为 &gt;date   以前的日期)。 <BR>
  D ：待加减的日期。</TD>
<td>例子： DateAdd("m" , 1 , "31-Jan-98") <BR>
  结果： 28-Feb-98 <BR>
  说明：将日期   31-Jan-98 加上一个月，结果为 28-Feb-98 而非 31-Fe-98 。 <BR>
  例子： DateAdd("d" , 20 ,   "30-Jan-99") <BR>
  结果： 1999/2/9 <BR>
  说明：将一个日期 30-Jan-99 加上 20 天后的日期。</TD>
</TR>
<tr class="danger">
<td>DateDiff (I , D1 , D2[,FW[,FY]])</TD>
<td>计算两个日期之间的期间。 <BR>
  I ：设定两个日期之间的期间计算之单位。譬如 &gt;I="m" 表示计算的单位为月。   &gt;I 的设定值如： <BR>
  yyyy &gt; Year 年 <BR>
  q Quarter 季 <BR>
  m Month 月 <BR>
  d Day 日 <BR>
  w Weekday 星期 <BR>
  h Hour 时 <BR>
  m Minute 分 <BR>
  s Second 秒 <BR>
  D1   ,D2：计算期间的两个日期表达式，若 &gt;date1 较早，则两个日期之间的期间结果为正值；若 &gt;date2 较早， 则结果为负值。 <BR>
  FW   ：设定每周第一天为星期几， 若未设定表示为星期天。 &gt;FW 的设定值如下： <BR>
  0 使用 &gt;API 的设定值。 <BR>
  1 星期天 <BR>
  2   星期一 <BR>
  3 星期二 <BR>
  4 星期三 <BR>
  5 星期四 <BR>
  6 星期五 <BR>
  7 星期六 <BR>
  FY ：设定一年的第一周，   若未设定则表示一月一日那一周为一年的第一周。 &gt;FY 的设定值如下： <BR>
  0 使用 &gt;API 的设定值。 <BR>
  1   一月一日那一周为一年的第一周 <BR>
  2 至少包括四天的第一周为一年的第一周 <BR>
  3 包括七天的第一周为一年的第一周</TD>
<td>例子： DateDiff ("d","25-Mar-99 ","30-Jun-99 ") <BR>
  结果： 97 <BR>
  说明：显示两个日期之间的期间为 97 天。</TD>
</TR>
<TR class="success">
<td>DatePart (I,D,[,FW[,FY]])</TD>
<td>传回一个日期的之部份。 <BR>
  &gt;I ：设定传回那一部份。譬如 &gt;I="d" 表示传回 部份为日。 &gt;I   的设定值如下： <BR>
  yyyy Year 年 <BR>
  q Quarter 季 <BR>
  m Month 月 <BR>
  d Day 日 <BR>
  w Weekday   星期 <BR>
  h Hour 时 <BR>
  m Minute 分 <BR>
  s Second 秒 <BR>
  D ：待计算的日期。 <BR>
  &gt;FW   ：设定每周第一天为星期几， 若未设定则表示为星期天。 &gt;FW 的设定值如下： <BR>
  0 使用 &gt;API 的设定值。 <BR>
  1 星期天 <BR>
  2   星期一&gt;3 星期二 <BR>
  4 星期三 <BR>
  5 星期四 <BR>
  6 星期五 <BR>
  7 星期六 <BR>
  FY ：设定一年的第一周，   若未设定则表示一月一日那一周为一年的第一周。 &gt;FY 的设定值如下： <BR>
  0 使用 &gt;API 的设定值。 <BR>
  1   一月一日那一周为一年的第一周 <BR>
  2 至少包括四天的第一周为一年的第一周 <BR>
  3 包括七天的第一周为一年的第一周</TD>
<td>例子： DatePart ("m","25-Mar-99 ") <BR>
  结果： 3 <BR>
  说明：显示传回一个日期   的月部份。</TD>
</TR>
<tr class="danger">
<td>Dateserial (year,month,day)</TD>
<td>转换(year,month,day) 成日期变量型态。</TD>
<td>例子： DateSerial (99,10,1) <BR>
  结果： 1999/10/1</TD>
</TR>
<TR class="success">
<td>DateValue ( 日期的字符串或表达式 )</TD>
<td>转换成日期变量型态，日期从 January 1,100 到 December 31,9999 。格式为 month,day,and   year 或 month/day/year 。譬如： December 30,1999 、 Dec 30,1999 、 12/30/1999 、   12/30/99</TD>
<td>例子： DateValue ("January 1,2002 ") <BR>
  结果： 2002/1/1</TD>
</TR>
<tr class="danger">
<td>Day( 日期的字符串或表达式 )</TD>
<td>传回日期的「日」部份。</TD>
<td>例子： Day(" 12/1/1999 ") <BR>
  结果： 1</TD>
</TR>
<TR class="success">
<td>Fix( 表达式 )</TD>
<td>转换字符串成整数数字型态。与 Int 函数相同。若为 null 时传回 null 。 <BR>
  Int (number) 与   Fix(number) 的差别在负数。如 Int (-5.6)=-6 ， Fix(-5.6)=-5 。</TD>
<td>例子： Fix(5.6) <BR>
  结果： 5</TD>
</TR>
<tr class="danger">
<td>Hex( 表达式 )</TD>
<td>传回数值的十六进制值。若表达式为 null 时 Hex( 表达式 )=null ，若表达式 =Empty 时 Hex( 表达式   )=0 。 16 进位可以加「 &amp;H 」表示，譬如 16 进位 &amp;H10 表示十进制的 16 。</TD>
<td>例子： Hex(30) <BR>
  结果： 1E</TD>
</TR>
<TR class="success">
<td>Hour( 时间的字符串或表达式 )</TD>
<td>传回时间的「小时」部份。</TD>
<td>例子： Hour("12:30:54 ") <BR>
  结果： 12</TD>
</TR>
<tr class="danger">
<td>InStr   ([start,]string1,string2[,compare]) </TD>
<td>将一 个 字符串由左 而右与另一个比较，传回第一个相同的位置。 <BR>
  start 为从第几个字比较起，若省略 start   则从第一个字比较起， string1 为待寻找的字符串表达式， string2 为 待比较的字符串表达式， compare 为比较的方法， compare=0   表二进制比较法， compare=1 表文字比较法，若省略 compare 则为预设的二进制比较法。</TD>
<td>例子： InStr("abc123def123","12") <BR>
  结果： 4</TD>
</TR>
<TR class="success">
<td>InstrRev   ([start,]string1,string2[,compare])</TD>
<td>将一 个 字符串 由右而左与另一个比较，传回第一个相同的位置。 <BR>
  start 为从第几个字比较起，若省略 start   则从第一个字比较起， string1 为待寻找的字符串表达式， string2 为 待比较的字符串表达式， compare 为比较的方法， compare=0   表二进制比较法， compare=1 表文字比较法，若省略 compare 则为预设的二进制比较法。</TD>
<td>例子： InstrRev ("abc123def123","12") <BR>
  结果： 10</TD>
</TR>
<tr class="danger">
<td>Int ( 表达式 )</TD>
<td>传回一个数值的整数部份。与 Fix 函数相同。</TD>
<td>例子： Int (5.6) <BR>
  结果： 5</TD>
</TR>
<TR class="success">
<td>IsArray ( 变数 )</TD>
<td>测试变量是 (True) 否 (False) 是一个数组。</TD>
<td>例子： IsArray (3) <BR>
  结果： False <BR>
  说明：不是一个数组。</TD>
</TR>
<tr class="danger">
<td>IsDate ( 日期或字符串的表达式 )</TD>
<td>是否可以转换成日期。日期从 January 1,100 A.D. 到 December 31,9999 A.D 。</TD>
<td>例子： IsDate ("December 31,1999 ") <BR>
  结果： True <BR>
  说明：可以转换成日期。</TD>
</TR>
<TR class="success">
<td>IsEmpty ( 变数 )</TD>
<td>测试变量是 (True) 否 (False) 已经被初始化</TD>
<td>例子： IsEmpty (a) <BR>
  结果： True</TD>
</TR>
<tr class="danger">
<td>IsNull ( 变数 )</TD>
<td>测试变数是 (True) 否 (False) 不是有效的数据。</TD>
<td>例子： IsNull ("") <BR>
  结果： False <BR>
  说明：是有效的数据。</TD>
</TR>
<TR class="success">
<td>IsNumeric ( 表达式 )</TD>
<td>是 (True) 否 (False) 是数字。</TD>
<td>例子： IsNumeric ("abc123") <BR>
  结果： False <BR>
  说明：不是数字。</TD>
</TR>
<tr class="danger">
<td>LCase ( 字符串表达式 )<A href="#top" target="_blank"> top</A></TD>
<td>转换字符串成小写。将大写字母的部份转换成小写。字符串其余的部份不变。</TD>
<td>例子： LCase ("ABC123") <BR>
  结果： abc123</TD>
</TR>
<TR class="success">
<td>Left( 字符串表达式 ,length)</TD>
<td>取字符串左边的几个字。 length 为取个字。 Len 函数可得知字符串的长度。</TD>
<td>例子： Left("ABC123",3) <BR>
  结果： ABC</TD>
</TR>
<tr class="danger">
<td>Len( 字符串表达式 变量 )</TD>
<td>取得字符串的长度。</TD>
<td>例子： Len("ABC123") <BR>
  结果： 6</TD>
</TR>
<TR class="success">
<td>LTrim ( 字符串表达式 )</TD>
<td>除去字符串左边的空白字。 RTrim 除去字符串右边的空白字， Trim 函数除去字符串左右两边的空白字。</TD>
<td>例子： LTrim ("456+" abc ") <BR>
  结果： 456abc123</TD>
</TR>
<tr class="danger">
<td>Mid( 字符串表达式 ,start[,length]) </TD>
<td>取字符串中的几个字。 start 为从第几个 字取起， length 为取几个字， 若略 length 则从 start   取到最右底。由Len 函数可得知字符串的长度。</TD>
<td>例子： Mid("abc123",2,3) <BR>
  结果： c12</TD>
</TR>
<TR class="success">
<td>Minute( 日期的字符串或表达式 )</TD>
<td>传回时间的「分钟」部份。</TD>
<td>例子： Minute("12:30:54") <BR>
  结果：30</TD>
</TR>
<tr class="danger">
<td>Month(日期的字符串或表达式)</TD>
<td>传回日期的「月」部份。</TD>
<td>例子：Month("12/1/2001") <BR>
  结果：12</TD>
</TR>
<TR class="success">
<td>MonthName(month[,abbreviate])</TD>
<td>传回月的名称。 <BR>
  month ：待传回月名称的数字 1~12 。譬如， 1 代表一月， 7 代表七月。 <BR>
  abbreviate: 是 (True) 否 (False) 为缩写，譬如 March ，缩写为 Mar 。默认值为 False   。中文的月名称无缩写。</TD>
<td>例子： MonthName (7) <BR>
  结果：七月</TD>
</TR>
<tr class="danger">
<td>Now()</TD>
<td>传回系统的日期时间。</TD>
<td>例子： Now() <BR>
  结果： 2001/12/30 10:35:59 AM</TD>
</TR>
<TR class="success">
<td>Oct()</TD>
<td>传回数值的八进位值。八进位可以加「 &amp;O 」表示，譬如八进位 &amp;O10 表示十进制的 8 。</TD>
<td>例子： Oct(10) <BR>
  结果： 12</TD>
</TR>
<tr class="danger">
<td>Replace(   字符串表达式,findnreplacewith[,start[,count[,compare]]]) </TD>
<td>将一个字符串取代 部份字。寻找待取代的原字符串 (find) ， 若找到则被取代为新字符串 (replacewith) 。 <BR>
  find ：待寻找取代的原字符串。 <BR>
  replacewith ：取代后的字。 <BR>
  start ：从第几个字开始寻找取代，   若未设定则由第一个字开始寻找。 <BR>
  count ：取代的次数。 若未设定则所有寻找到的字符串取代字符 串全部被取代。 <BR>
  compare   ：寻找比较的方法， compare=0 表示二进制比较法， compare=1 表文字比较法， compare =2 表根据比较的 数据型态而定，若省略   compare 则为预设的二进制比较法。</TD>
<td>例子： Replace("ABCD123ABC","AB","ab") <BR>
  结果： abCD123abC</TD>
</TR>
<TR class="success">
<td>Right( 字符串表达式 ,length)</TD>
<td>取字符串右边的几个字， length 为取几个字。 Len 函数可得知字符串的长度。</TD>
<td>例子： Right("ABC123",3) <BR>
  结果： 123</TD>
</TR>
<tr class="danger">
<td>Rnd [(number)]</TD>
<td>0~1 的 随机随机数值。 number 是任何有效的数值表达式。若 number 小于 0 表示每次得到相同的 随机随机数值。   number 大于 0 或未提供时表示依序得到下一个 随机随机数值。 &gt;number=0 表示得到最近产生的   随机随机数值。为了避免得到相同的随机随机数顺序，可以于 Rnd 函数前加 Randomize 。</TD>
<td>例子： Rnd <BR>
  结果： 0.498498</TD>
</TR>
<TR class="success">
<td>Round( 数值表达式 [,D])</TD>
<td>四舍五入。 <BR>
  D ：为四舍五入到第几位小数，若省略则四舍五入到整数。</TD>
<td>例子： Round(30635,1) <BR>
  结果： 3.6</TD>
</TR>
<tr class="danger">
<td>RTrim ( 字符串表达式 )</TD>
<td>除去字符串右边的空白字。 LTrim 除去字符串左边的空白字， Trim 函数除去字符串左右两边的空白字。</TD>
<td>例子： RTrim ("abc123 ")+"456" <BR>
  结果： abc123456</TD>
</TR>
<TR class="success">
<td>Second( 时间的字符串或表达式 )</TD>
<td>传回时间的「秒」部份。</TD>
<td>例子：Second("12:30:54") <BR>
  结果：54</TD>
</TR>
<tr class="danger">
<td>Space( 重复次数 )</TD>
<td>得到重复相同的空白字符串。</TD>
<td>例子： A"+Space (5)+"B <BR>
  结果： A B <BR>
  说明： A 和 B   中间加入五个空白字。</TD>
</TR>
<TR class="success">
<td>String( 重复次数，待重复的字 )</TD>
<td>得到重复相同的字符串。</TD>
<td>例子： String(5,71) <BR>
  结果： GGGGG</TD>
</TR>
<tr class="danger">
<td>StrReverse (String(10,71))</TD>
<td>将一个字符串顺序颠倒。</TD>
<td>例子： StrReverse ("ABC") <BR>
  结果： CBA</TD>
</TR>
<TR class="success">
<td>Time()</TD>
<td>传回系统的时间。</TD>
<td>例子： Time <BR>
  结果： 10:35:59 PM</TD>
</TR>
<tr class="danger">
<td>TimeSerial (hour,minute,second)</TD>
<td>转换指定的 ( hour,minute,second) 成时间 变量型态。</TD>
<td>例子： TimeSerial (10,31,59) <BR>
  结果： 10:31:59</TD>
</TR>
<TR class="success">
<td>TimeValue ( 日期的字符串或表达式 )</TD>
<td>转换 成时间变量型态。日期的字符串或表达式从 0:00:00(12:00:00 A.M.) 到 23:59:59(11:59:59   P.M.) 。</TD>
<td>例子： TimeValue (" 11:59:59 ") <BR>
  结果： 11:59:59</TD>
</TR>
<tr class="danger">
<td>Trim( 字符串表达式 )</TD>
<td>除去字符串左右两边的空白字。</TD>
<td>例子： Trim(" abc123 ") <BR>
  结果： abc123</TD>
</TR>
<TR class="success">
<td>UCase ()</TD>
<td>转换字符串成大写。将小写字母的部份转换成大写，字符串其余部份不变。</TD>
<td>例子： UCase ("abc123") <BR>
  结果： ABC123</TD>
</TR>
<tr class="danger">
<td>VarType ( 变数 )</TD>
<td>传回一个变量类型。与 TypeName 函数相同， VarType 传回变量类型的代码， TypeName 传回变量类型的名称。</TD>
<td>例子： VarType ( "I love you!") <BR>
  结果： 8</TD>
</TR>
<TR class="success">
<td>Weekday( 日期表达式 ,[FW]) </TD>
<td>传回星期几的数字。 <BR>
  FW ：设定一周的第一天是星期几。若 省略则表 1( 星期日 ) 。 <BR>
  Firstdayfweek 设定值为： 1( 星期日 ),2( 星期一 ),3( 星期二 ),4( 星期三 ),5( 星期四 ),6( 星期五 ),7(   星期六 ) 。</TD>
<td>例子： Weekday(" 1/1/2000") <BR>
  结果： 7</TD>
</TR>
<tr class="danger">
<td>WeekDayName (W,A,FW)</TD>
<td>传回星期几的名称。 <BR>
  W ：是 (True) 否 (False) 为缩写。譬如 March ，缩写为 Mar 。预设为   False 。中文的星期几名称无缩写。 <BR>
  FW ：设定一周的第一天是星期几。 若省略表 1( 星期日 ) 。设定待传回星期几的名称，为一周中的第几天。 <BR>
  A ： 1( 星期日 ),2( 星期一 ),3( 星期二 ),4( 星期三 ),5( 星期四 ),6( 星期五 ),7( 星期六 ) 。</TD>
<td>例子： WeekDayName ("1/1/2000") <BR>
  结果：星期六</TD>
</TR>
<TR class="success">
<td>Year()</TD>
<td>传回日期的「年」部份。</TD>
<td>例子： Year(" 12/1/2000 ") <BR>
  结果：   2000</TD>
</TR>
</TBODY>
</TABLE>
{% endraw %}