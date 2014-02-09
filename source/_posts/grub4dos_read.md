title: "[grub4dos] 尝试read命令使用外部命令来实现"
id: 119
date: 2010-01-05 20:53:46
tags: 
- GRUB4DOS
- read
categories: 
- GRUB4DOS/扩展
description: grub4dos外部命令测试 简单的 read 命令
---

grub4dos外部命令编写尝试

 read.o

 功能等同于内部命令read

 使用方法同样

 例子

 read.o 0x8290

使用的代码如下。保存为read.c

然后使用gcc编译就可以了。编译命令
<!--more-->

```
gcc -Wl,--build-id=none -m32 -mno-sse -nostdlib -fno-zero-initialized-in-bss -fno-function-cse -fno-jump-tables -Wl,-N -fPIE read.c -o read.o
```

最后得到的read.o就可以在GRUB4DOS的命令行中执行。

```
int i = 0x66666666;	/* this is needed, see the following comment. */
asm(".long 0x03051805");
asm(".long 0xBCBAA7BA");
#define printf(format...) ((int (*)(const char *, ...))((*(int **)0x8300)[0])) (0, format)
#define safe_parse_maxint(str_ptr,myint_ptr) ((int (*)(char **,unsigned long long *))((*(int **)0x8300)[9])) (str_ptr, myint_ptr)

int
main()
{

	void *p = &main;
	char *arg=p - (*(int *)(p - 8));
	unsigned long long addr, val;

	if ( safe_parse_maxint (&arg, &addr))
	{
		val = *(unsigned long *)(unsigned long)(addr);
		printf("Address 0x%lx: Value 0x%lx\n", addr, val);
		return val;
	}
	else 
		return 0;
}
```