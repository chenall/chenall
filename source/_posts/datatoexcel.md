title: "将数据输出到Excel的方法"
id: 787
date: 2011-11-09 14:35:20
tags: 
- EXCEL
- VBScript
- 原创
categories: 
- 程序设计/VB/VBScript
---


日常工作中经常需要把某一部份数据导出到EXCEL,通常情况都有软件提供类似方案.

但是这需要手工去打开软件然后导出,不能实现自动化.所以就编写了这个脚本方便实现自动化.

本脚本采用VBSCRIPT语言编写.可以在VB或VBS脚本中使用.

提供了两个过程调用方法rsToExcel,和sqltoexcel.

以下例子就可以把一个文本文档(CSV格式),转为EXCEL

```
sqlToExcel "TEXT;c:\test.txt","c:\test.xls",null
```

以下可以从一个SQL数据库中提取数据并输出到excel文件中

```
sqlToExcel "OLEDB;Provider=SQLOLEDB;data source=SQLSERVER;Initial Catalog=DB;User ID=sa;Password=pass","c:\test.xls","select * from mytable"
```

注:rstoexcel和sqltoexcel都可以生成EXCEL文件,可以看情况使用.一般情况下使用sqltoexcel就可以了,比较简单.

以下是使用rstoexcel的方法,会麻烦一些

```
Dim Conn, StrConn, RS, SQL
set Conn = CreateObject("ADODB.Connection")
set RS = CreateObject("ADODB.Recordset")
StrConn = "Provider=SQLOLEDB;data source=SQLSERVER;Initial Catalog=DB;User ID=sa;Password=passwd"
SQL = "select * from mytable"
Conn.Open StrConn
RS.Open SQL,conn,1,1
rstoexcel(RS,"c:\sql.xls")
```

参考资料: http://support.microsoft.com/kb/247412/zh-cn

```VB

Dim Conn, StrConn, RS, SQL
set Conn = CreateObject("ADODB.Connection")
set RS = CreateObject("ADODB.Recordset")
StrConn = "Provider=SQLOLEDB;data source=SQLSERVER;Initial Catalog=DB;User ID=sa;Password=passwd"
SQL = "select * from mytable"
Conn.Open StrConn
RS.Open SQL,conn,1,1
rstoexcel(RS,"c:\sql.xls")

'sqltoexcel "TEXT;c:\11.txt","c:\test.xls",null
'sqltoexcel "URL;http://amupdate.nxt.ru/","c:\url.xls",null
sqltoexcel "OLEDB;" & StrConn ,"c:\sql.xls",SQL

'RS记录导出到EXCEL文件 by chenall http://chenall.net
'使用方法
'rsToExcel Recordset,ExcelFileName
'rsToExcel rs,"c:\test.xls"
sub rsToExcel(rs,file)
	'on error resume next
	dim n,x
	dim xlApp,xlBook,xlSheet
	Set xlApp = CreateObject("Excel.Application")'创建EXCEL对象
	with xlApp.Workbooks.Add().Worksheets(1)'创建新的工作表对像
		n = 0
		for each x in rs.Fields
			n=n+1
			.Cells(1,n) = x.name 
			.Cells(1,n).Font.Bold   =   True '加粗
			.Cells(1,n).HorizontalAlignment=3 '居中
		next
		.Range("A2").CopyFromRecordset rs
		.Range("A1:" & chr(asc("A")+n-1) & rs.recordcount+1).Borders.LineStyle = 1'画表框
		.Range("A1:" & chr(asc("A")+n-1) & rs.recordcount+1).EntireColumn.AutoFit() '自动调整列宽
		xlApp.displayalerts=false'不显示覆盖文件的提示
		.SaveAs file'另存为新的文件名
		xlApp.displayalerts=true'恢复显示
	end with
	xlApp.Quit'退出excel
	set xlApp=nothing
end sub

'任意数据源导出到EXCEL文件 by chenall http://chenall.net
'使用方法,sql参数可以为null
'sqlToExcel conn,ExcelFileName,sql
'sqlToExcel conn,"c:\test.xls",sql
sub sqlToExcel(conn,file,sql)
'	on error resume next
	dim xlApp,xlBook,xlSheet,QryTable
	Set xlApp = CreateObject("Excel.Application")'创建EXCEL对象
	with xlApp.Workbooks.Add().Worksheets(1)'创建新的工作表对像
		if isnull(sql) then
			set QryTable = .QueryTables.add(conn,.Range("A1")) '导入数据
		else
			set QryTable = .QueryTables.add(conn,.Range("A1"),sql) '导入数据
		end if
		QryTable.Refresh false
		xlApp.displayalerts=false'不显示覆盖文件的提示
		.SaveAs file'另存为新的文件名
		xlApp.displayalerts=true'恢复显示
	end with
	xlApp.Quit'退出excel
	set xlApp=nothing
end sub
```
