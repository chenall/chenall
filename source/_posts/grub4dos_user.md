title: "[grub4dos] grub4dos 运行外部命令[简介]"
id: 118
date: 2010-01-05 20:42:02
tags: 
- GRUB
- GRUB4DOS
- 命令
categories: 
- GRUB4DOS/扩展
---

grub4dos从0.4.5版开始可以运行用户自己写的外部命令了。


以下是例子是echo命令也就是相当于c语言的printf函数。

<!--more-->

```

/*
 * This is a simple ECHO command, running under grub4dos.
 */

int i = 0x66666666;	/* this is needed, see the following comment. */

/* gcc treat the following as data only if a global initialization like the
 * above line occurs.
 */

/* a valid executable file for grub4dos must end with these 8 bytes */
asm(".long 0x03051805");
asm(".long 0xBCBAA7BA");
/* thank goodness gcc will place the above 8 bytes at the end of the b.out
 * file. Do not insert any other asm lines here.
 */

int
main()
{
        void *p = &main;

	return
	/* the following line is calling the grub_sprintf function. */
	((int (*)(char *, const char *, ...))((*(int **)0x8300)[0]))
	/* the following line includes arguments passed to grub_sprintf. */
		(0, p - (*(int *)(p - 8)));
}

```

0x8300 是 grub4dos 系统函数(API)的入口点. 你可以在 asm.S 源码中找到它的定义.

目前可以使用的函数和变量:
	http://grubutils.googlecode.com/svn/trunk/src/include/grub4dos.h

另外为了方便使用也可以把上面的函数重新定义下，我根据自己的理解整理一下的代码如下。

```	
//重新定义printf和sprintf函数
#define sprintf ((int (*)(char *, const char *, ...))((*(int **)0x8300)[0]))
#define printf(...) sprintf(NULL, __VA_ARGS__)

int i = 0x66666666;//这个是必须的但数值可以随意

/* 以下两句不可更改后面也不要有其它ASM代码，文件签名EXEC */
asm(“.long 0×03051805″);
asm(“.long 0xBCBAA7BA”);

int main(char *arg,int flags)
{
		return printf("%s\n",arg);
}
```

很简单吧，你也可以自己写一个可以用于GRUB4DOS的外部命令。
