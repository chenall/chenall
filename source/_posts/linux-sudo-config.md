title: linux sudo 命令和配置文件/etc/sudoers介绍
date: 2014-02-26 17:40:34
id: 1402261740
tags:
- linux
- sudo
categories: 
- 系统相关/linux

---

`sudo` 是**linux**下常用的允许普通用户使用超级用户权限的工具。 它的配置文件 **sudoers** 一般在 **/etc** 目录下。

不过不管 **sudoers** 文件在哪儿，`sudo` 都提供了一个编辑该文件的命令：**visudo** 来对该文件进行修改。强烈推荐使用该命令修改 **sudoers**，因为它会帮你校验文件配置是否正确，如果不正确，在保存退出时就会提示你哪段配置出错的。 

以下是 **sudoers** 的默认配置文件内容。

<!--more-->

```
#
# This file MUST be edited with the 'visudo' command as root.
#
# Please consider adding local content in /etc/sudoers.d/ instead of
# directly modifying this file.
#
# See the man page for details on how to write a sudoers file.
#
Defaults        env_reset
Defaults        secure_path="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"

# Host alias specification

# User alias specification

# Cmnd alias specification

# User privilege specification
root    ALL=(ALL:ALL) ALL

# Members of the admin group may gain root privileges
%admin ALL=(ALL) ALL

# Allow members of group sudo to execute any command
%sudo   ALL=(ALL:ALL) ALL

```

### 基本配置格式

```
<user list> <host list> = <operator list> <tag list> <command list>
```

* *user list*       用户/组，或者已经设置的用户的别名列表, 用户名直接 `username`，用户组加上`%`，比如`%admin`,
* *host list*       主机名或别名列表
* *operator list*   runas用户，即可以以哪个用户、组的权限来执行
* *command list*    可以执行的命令或列表
* *tag list*        这个经常用到的是 **NOPASSWD:** ，添加这个参数之后可以不用输入密码。

再来看看默认配置里面的对应配置的说明

```
## root 用户可以在任意主机上以任意用户、组的权限执行任意命令，说明root用户具有最高级的权限。
root    ALL=(ALL:ALL) ALL

## admin组的用户都拥有最高级权限。
%admin ALL=(ALL) ALL

## sudo 组用户和root用户权限一样
%sudo   ALL=(ALL:ALL) ALL
```

**tag list** 如果是 **NOPASSWD:** 则运行时不需要输入密码例子:

```
## test 用户可以不用输入密码运行 **/sbin/reboot** 命令
test ALL=(ALL) NOPASSWD: /sbin/reboot
```

 **operator list** 和 **tag list** 都是可选的，比如下面的：

```
test ALL=/sbin/reboot
```

实用例子， 在`PHP`上使用`system` 调用系统命令时，由于是`php`一般都是使用`www`用户运行的，如果要特别的需要，需要处理某个用户的文件时就可以指定某个目录或命令，使用某个用户权限免密码运行。

例子： 目录 **/mnt/sudodir** 里面的程序可以使用root权限来执行。

```
www ALL=(root) NOPASSWD: /mnt/sudodir
```

使用时，直接`sudo -u root /mnt/sudodir/cmd`，不需要输入密码。

为了安全起见，这个 **/mnt/sudodir** 除了`root`用户之外其它人应该只有运行的权限。

查看当前用户的`sudo`权限可以使用命令 `sudo -l`

PS： 我整理这些资料，主要是为了通过[github](https://github.com/)的webhook功能, 配和我的VPS上的PHP脚本来实现 `hexo` 站点的自动更新，这样我只需要更新源文件到github上，它就自动生成站点内容，并且自动同步到多个不同的地方，有空我会再整一篇文章来介绍这个。

参考资料： <https://help.ubuntu.com/community/Sudoers>

