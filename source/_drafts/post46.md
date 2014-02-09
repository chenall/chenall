title: "[分享]在x86 Windows 中安装的基于 x 64 的版本的 Windows Server 2003"
id: 46
date: 2009-03-05 19:24:49
tags: 
- pe
- windows 2003
- x86
categories: 
- 好文推荐
---

文章来源：[http://support.microsoft.com/kb/925279/zh-cn](http://support.microsoft.com/kb/925279/zh-cn)

最近想体验一下64位系统，但没有光驱，只有系统的安装镜像ISO文件，还有X86系统的PE。

## <div class="kb_tabs_toggle kb_tabs_toggle_open">&nbsp;</div><span>[简介](javascript:void(0);)</span> 
<div class="sectionpreview_closed">

&nbsp;

本文介绍如何通过使用一个 x 86 基于 Microsoft Windows 预安装环境 (Windows PE) 安装 Microsoft Windows Server 2003 x 64 的版本。

&nbsp;
<div class="kb_tabs_toggle kb_tabs_toggle_open">&nbsp;</div><span>[更多信息](javascript:void(0);)</span></div>

## <div class="sectionpreview_closed"><span style="font-family: 宋体"><span><span style="font-size: medium">请注意 我们建议您使用 Windows Server 2003 Service Pack 1 (SP 1) x 86 Winnt 32.exe 文件安装在 x 64 的操作系统。<div class="topOfPage">&nbsp;</div><div class="topOfPage">安装 x 64 版本的 Windows Server 2003 没有语言包</div><script type="text/javascript">                loadTOCNode(2, 'moreinformation');            </script><h4 id="tocHeadRef">要求
<script type="text/javascript">            loadTOCNode(3, 'moreinformation');        </script>

*   **基本操作系统 **
    必须安装在计算机上的 x 86 Windows PE 启动磁盘。 或者您必须具有的 x 86 Windows PE 安装在计算机。
*   **产品密钥 **
    都需要两个产品密钥。 一个产品密钥是 x 86 Winnt 32.exe 文件。 其他产品关键字是为 x 64 的操作系统中。要安装 x 64 版本的 Windows Server 2003 没有语言包，请按这些步骤操作。

**请注意 **步骤 1 到 3 假设这些下面的条件为真：

*   **H:\x86 **包含 x 86 文件夹内容是从 Windows Server 2003 SP 1 集成 CD。
*   **I:\x64 **包含从 Windows Server 2003 原始发布版本 CD 的 x 64 的文件夹内容。
*   在基于 x 64 的版本的 Windows Server 2003 在要安装在驱动器 D 上器

1.  重新启动 x 86 Windows PE。
2.  在命令提示符下运行 <span class="userInput">H:\x86\i386\Winnt32.exe /Tempdrive:D /Makelocalsource:all / noreboot /S: &rdquo; i:\x64\Amd64 &rdquo; </span>命令。
3.  在退出 x 之前 86 Windows PE，修改 %SystemDrive%\$WIN_NT$.~BT\Winnt.sif 文件中的，以下项：
        *   在 **[UserData] **，修改 **ProductID **项，使此项包含 x 64 的操作系统安装的密钥。
        **请注意 **当前，在 **ProductID **项包含在 x 86 操作系统 **H:\x86 **文件夹中的产品密钥。
    *   在 **[UserData] **，修改 **ProductKey **项，使此项包含 x 64 的操作系统安装的密钥。
        **请注意 **当前，** ProductKey **项包含在 x 86 操作系统 **H:\x86 **文件夹中的产品密钥。
    *   退出 x 86 Windows PE。
    *   计算机重新启动在 x 64 的操作系统的文本模式安装。

### 使用语言 Pack 安装 Windows Server 2003 x 64 的版本
<script type="text/javascript">                loadTOCNode(2, 'moreinformation');            </script>

#### 要求
<script type="text/javascript">            loadTOCNode(3, 'moreinformation');        </script>

*   **基本操作系统 **
    您必须具有 x 86 Windows PE 启动磁盘。 或者您必须具有的 x 86 Windows PE 安装在计算机。
*   **产品密钥 **
    都需要两个产品密钥。 一个产品密钥是 x 86 Winnt 32.exe 文件。 其他产品关键字是为 x 64 的操作系统中。要使用语言 Pack，请安装在基于 x 64 的版本的 Windows Server 2003，请按这些步骤。

**请注意 **步骤 1 到 4 假定以下条件为真：

*   **H:\x86 **包含 x 86 文件夹内容是从 Windows Server 2003 SP 1 集成 CD。
*   **I:\x64 **包含从 Windows Server 2003 原始发布版本 CD 的 x 64 的文件夹内容。
*   在基于 x 64 的版本的 Windows Server 2003 在要安装在驱动器 D 上器

1.  重新启动 x 86 Windows PE。
2.  若要在 Winnt 32.exe 阶段安装语言包，运行在 <span class="userInput">H:\x86\i386\Winnt32.exe /Tempdrive:D /Makelocalsource:all / noreboot /S: &rdquo; i:\x64\Amd64 &rdquo; /Copydir： &rdquo; i386\Lang &rdquo; </span>命令在命令提示符下。
3.  若要通过使用 Unattend.txt 文件安装语言包，运行在 <span class="userInput">H:\x86\i386\Winnt32.exe /Tempdrive:D /Makelocalsource:all / noreboot /S: &rdquo; i:\x64\amd64 &rdquo; /Copydir： &rdquo; i386\Lang &rdquo; /Copydir： &rdquo; amd64\Lang &rdquo; </span>命令在命令提示符下。
4.  在退出 x 之前 86 Windows PE，修改 %SystemDrive%\$WIN_NT$.~BT\Winnt.sif 文件中的，以下项：
        *   在 **[UserData] **，修改 **ProductID **项，以包含 x 64 的操作系统安装该产品密钥。
        **请注意 **当前，在 **ProductID **项包含在 x 86 操作系统 **H:\x86 **文件夹中的产品密钥。
    *   在 **[UserData] **，修改 **ProductKey **项，以包含 x 64 的操作系统安装该产品密钥。
        **请注意 **当前，** ProductKey **项包含在 x 86 操作系统 **H:\x86 **文件夹中的产品密钥。
    *   退出 x 86 Windows PE。
    *   计算机重新启动在 x 64 的操作系统的文本模式安装。</span></span></span></div></h2>

&nbsp;

附,整理出来的安装脚本下载.
[http://www.brsbox.com/filebox/down/fc/77234903376333bd56e8329f8661977a](http://www.brsbox.com/filebox/down/fc/77234903376333bd56e8329f8661977a)