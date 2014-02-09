title: grub4dos .h
date: 2010-05-27 10:37:58
---

整理了一些，方便使用。目前最新版整理于2010-03-01。

使用方法。

直接

#include &quot;grub4dos.h&quot;

例子 :

<div style="background: #fdfdfd; color: black"><u>C语言</u>: echo.c</div>
<div style="background: #fdfdfd; color: black"><span style="color: #4c8317">#include &quot;grub4dos.h&quot;</span>

	<span style="color: #00aaaa">int</span> <span style="color: #000000">i</span> <span style="color: #000000">=</span> <span style="color: #009999">0x66666666</span>;

	<span style="color: #000000">asm</span>(<span style="color: #aa5500">&quot;.long 0x03051805&quot;</span>);

	<span style="color: #000000">asm</span>(<span style="color: #aa5500">&quot;.long 0xBCBAA7BA&quot;</span>);

	<span style="color: #00aaaa">int</span>

	<span style="color: #00aa00">main</span>()

	<span style="color: #000000">{</span>

	&nbsp;&nbsp; <span style="color: #00aaaa">void</span> <span style="color: #000000">*</span>p <span style="color: #000000">=</span> <span style="color: #000000">&amp;</span><span style="color: #000000">main</span>;

	&nbsp;&nbsp; <span style="color: #00aaaa">char</span> <span style="color: #000000">*</span><span style="color: #000000">arg</span><span style="color: #000000">=</span>p <span style="color: #000000">-</span> (<span style="color: #000000">*</span>(<span style="color: #00aaaa">int</span> <span style="color: #000000">*</span>)(p <span style="color: #000000">-</span> <span style="color: #009999">8</span>));

	&nbsp;&nbsp; <span style="color: #000000">printf</span>(<span style="color: #000000">arg</span>);</div>
<div style="background: #fdfdfd; color: black">}</div>
<div style="background: #fdfdfd; color: black">
	<div style="background: #fdfdfd; color: black"><u>C语言</u>: [grub4dos.h](http://fayaa.com/code/view/8714/)</div>
	<div class="source" jquery1274926702555="15" style="background-color: #f9f7ed; font-family: 'courier new', 'consolas', 'lucida console'; color: #000000"><span style="color: #008000">/*</span>

		<span style="color: #008000">* The C code for a grub4dos executable may have defines as follows:</span>

		<span style="color: #008000">* 用于编写外部命令的函数定义。</span>

		<span style="color: #008000">*/</span>

		<span style="color: #0000ff">#ifndef GRUB4DOS_2010_03_01</span>

		<span style="color: #0000ff">#define GRUB4DOS_2010_03_01</span>

		<span style="color: #2b91af">int</span> <span style="color: #000000">grub_main</span> (<span style="color: #2b91af">char</span> <span style="color: #000000">*</span><span style="color: #000000">arg</span><span style="color: #000000">,</span><span style="color: #2b91af">int</span> <span style="color: #000000">flags</span>);

		<span style="color: #0000ff">#undef NULL</span>

		<span style="color: #0000ff">#define NULL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((void *) 0)</span>

		<span style="color: #008000">/* Error codes (descriptions are in common.c) */</span>

		<span style="color: #0000ff">typedef</span> <span style="color: #0000ff">enum</span>

		<span style="color: #000000">{</span>

		&nbsp; <span style="color: #000000">ERR_NONE</span> <span style="color: #000000">=</span> <span style="color: #000000">0</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BAD_FILENAME</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BAD_FILETYPE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BAD_GZIP_DATA</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BAD_GZIP_HEADER</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BAD_PART_TABLE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BAD_VERSION</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BELOW_1MB</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BOOT_COMMAND</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BOOT_FAILURE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BOOT_FEATURES</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_DEV_FORMAT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_DEV_VALUES</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_EXEC_FORMAT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_FILELENGTH</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_FILE_NOT_FOUND</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_FSYS_CORRUPT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_FSYS_MOUNT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_GEOM</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NEED_LX_KERNEL</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NEED_MB_KERNEL</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NO_DISK</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NO_PART</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NUMBER_PARSING</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_OUTSIDE_PART</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_READ</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_SYMLINK_LOOP</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_UNRECOGNIZED</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_WONT_FIT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_WRITE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_BAD_ARGUMENT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_UNALIGNED</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_PRIVILEGED</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_DEV_NEED_INIT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NO_DISK_SPACE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NUMBER_OVERFLOW</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_DEFAULT_FILE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_DEL_MEM_DRIVE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_DISABLE_A20</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_DOS_BACKUP</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_ENABLE_A20</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_EXTENDED_PARTITION</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_FILENAME_FORMAT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_HD_VOL_START_0</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INT13_ON_HOOK</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INT13_OFF_HOOK</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_BOOT_CS</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_BOOT_IP</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_FLOPPIES</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_HARDDRIVES</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_HEADS</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_LOAD_LENGTH</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_LOAD_OFFSET</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_LOAD_SEGMENT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_SECTORS</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_SKIP_LENGTH</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_INVALID_RAM_DRIVE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_IN_SITU_FLOPPY</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_IN_SITU_MEM</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_MD_BASE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NON_CONTIGUOUS</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NO_DRIVE_MAPPED</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NO_HEADS</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_NO_SECTORS</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_PARTITION_TABLE_FULL</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_RD_BASE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_SPECIFY_GEOM</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_SPECIFY_MEM</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_SPECIFY_RESTRICTION</span><span style="color: #000000">,</span>

		<span style="color: #008000">//&nbsp; ERR_INVALID_RD_BASE,</span>

		<span style="color: #008000">//&nbsp; ERR_INVALID_RD_SIZE,</span>

		&nbsp; <span style="color: #000000">ERR_MD5_FORMAT</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_WRITE_GZIP_FILE</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">ERR_FUNC_CALL</span><span style="color: #000000">,</span>

		<span style="color: #008000">//&nbsp; ERR_WRITE_TO_NON_MEM_DRIVE,</span>

		&nbsp; <span style="color: #000000">ERR_INTERNAL_CHECK</span><span style="color: #000000">,</span>

		&nbsp; <span style="color: #000000">MAX_ERR_NUM</span>

		<span style="color: #000000">}</span> <span style="color: #000000">grub_error_t</span>;

		<span style="color: #0000ff">#define install_partition (*(unsigned long *)0x8208)</span>

		<span style="color: #0000ff">#define boot_drive (*(unsigned long *)0x8280)</span>

		<span style="color: #0000ff">#define pxe_yip (*(unsigned long *)0x8284)</span>

		<span style="color: #0000ff">#define pxe_sip (*(unsigned long *)0x8288)</span>

		<span style="color: #0000ff">#define pxe_gip (*(unsigned long *)0x828C)</span>

		<span style="color: #0000ff">#define filesize (*(unsigned long long *)0x8290)</span>

		<span style="color: #0000ff">#define saved_mem_upper (*(unsigned long *)0x8298)</span>

		<span style="color: #0000ff">#define saved_partition (*(unsigned long *)0x829C)</span>

		<span style="color: #0000ff">#define saved_drive (*(unsigned long *)0x82A0)</span>

		<span style="color: #0000ff">#define no_decompression (*(unsigned long *)0x82A4)</span>

		<span style="color: #0000ff">#define part_start (*(unsigned long long *)0x82A8)</span>

		<span style="color: #0000ff">#define part_length (*(unsigned long long *)0x82B0)</span>

		<span style="color: #0000ff">#define fb_status (*(unsigned long *)0x82B8)</span>

		<span style="color: #0000ff">#define is64bit (*(unsigned long *)0x82BC)</span>

		<span style="color: #0000ff">#define saved_mem_higher (*(unsigned long long *)0x82C0)</span>

		<span style="color: #0000ff">#define cdrom_drive (*(unsigned long *)0x82C8)</span>

		<span style="color: #0000ff">#define ram_drive (*(unsigned long *)0x82CC)</span>

		<span style="color: #0000ff">#define rd_base (*(unsigned long long *)0x82D0)</span>

		<span style="color: #0000ff">#define rd_size (*(unsigned long long *)0x82D8)</span>

		<span style="color: #0000ff">#define addr_system_functions (*(unsigned long *)0x8300)</span>

		<span style="color: #0000ff">#define next_partition_drive&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(unsigned long **)0x8304)[0])</span>

		<span style="color: #0000ff">#define next_partition_dest&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(unsigned long **)0x8304)[1])</span>

		<span style="color: #0000ff">#define next_partition_partition&nbsp;&nbsp;&nbsp; ((*(unsigned long ***)0x8304)[2])</span>

		<span style="color: #0000ff">#define next_partition_type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(unsigned long ***)0x8304)[3])</span>

		<span style="color: #0000ff">#define next_partition_start&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(unsigned long ***)0x8304)[4])</span>

		<span style="color: #0000ff">#define next_partition_len&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(unsigned long ***)0x8304)[5])</span>

		<span style="color: #0000ff">#define next_partition_offset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(unsigned long ***)0x8304)[6])</span>

		<span style="color: #0000ff">#define next_partition_entry&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(unsigned long ***)0x8304)[7])</span>

		<span style="color: #0000ff">#define next_partition_ext_offset&nbsp;&nbsp;&nbsp; ((*(unsigned long ***)0x8304)[8])</span>

		<span style="color: #0000ff">#define next_partition_buf&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(char ***)0x8304)[9])</span>

		<span style="color: #0000ff">#define quit_print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ((*(int **)0x8304)[10])</span>

		<span style="color: #008000">//#define buf_drive&nbsp;&nbsp;&nbsp; ((*(int **)0x8304)[11])</span>

		<span style="color: #008000">//#define buf_track&nbsp;&nbsp;&nbsp; ((*(int **)0x8304)[12])</span>

		<span style="color: #0000ff">#define filesystem_type ((*(int **)0x8304)[13])</span>

		<span style="color: #008000">//#define query_block_entries ((*(long **)0x8304)[14])</span>

		<span style="color: #008000">//#define map_start_sector ((*(unsigned long **)0x8304)[15])</span>

		<span style="color: #0000ff">#define buf_geom ((*(struct geometry ***)0x8304)[16])</span>

		<span style="color: #0000ff">#define tmp_geom ((*(struct geometry ***)0x8304)[17])</span>

		<span style="color: #0000ff">#define term_table ((*(struct term_entry ***)0x8304)[18])</span>

		<span style="color: #0000ff">#define current_term ((*(struct term_entry ***)0x8304)[19])</span>

		<span style="color: #0000ff">#define fsys_table ((*(struct fsys_entry ***)0x8304)[20])</span>

		<span style="color: #008000">//#define fsys_type ((*(int **)0x8304)[21])</span>

		<span style="color: #008000">//#define NUM_FSYS ((*(const int **)0x8304)[22])</span>

		<span style="color: #0000ff">#define graphics_inited ((*(const int **)0x8304)[23])</span>

		<span style="color: #0000ff">#define VARIABLE_GRAPHICS ((char *)(*(int ***)0x8304)[24])</span>

		<span style="color: #0000ff">#define font8x16 ((unsigned char *)(*(int ***)0x8304)[25])</span>

		<span style="color: #0000ff">#define fontx ((*(int **)0x8304)[26])</span>

		<span style="color: #0000ff">#define fonty ((*(int **)0x8304)[27])</span>

		<span style="color: #0000ff">#define graphics_CURSOR ((*(int **)0x8304)[28])</span>

		<span style="color: #0000ff">#define menu_broder ((*(struct broder ***)0x8304)[29])</span>

		<span style="color: #0000ff">#define cursorX (*(short *)(VARIABLE_GRAPHICS))</span>

		<span style="color: #0000ff">#define cursorY (*(short *)(VARIABLE_GRAPHICS + 2))</span>

		<span style="color: #0000ff">#define cursorBuf ((char *)(VARIABLE_GRAPHICS + 6))</span>

		<span style="color: #0000ff">#define free_mem_start (*(unsigned long *)0x82F0)</span>

		<span style="color: #0000ff">#define free_mem_end (*(unsigned long *)0x82F4)</span>

		<span style="color: #0000ff">#define saved_mmap_addr (*(unsigned long *)0x82F8)</span>

		<span style="color: #0000ff">#define saved_mmap_length (*(unsigned long *)0x82FB)</span>

		<span style="color: #0000ff">#define DRIVE_MAP_SIZE&nbsp;&nbsp;&nbsp; 8</span>

		<span style="color: #0000ff">#define PXE_DRIVE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0x21</span>

		<span style="color: #0000ff">#define INITRD_DRIVE&nbsp;&nbsp;&nbsp; 0x22</span>

		<span style="color: #0000ff">#define FB_DRIVE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0x23</span>

		<span style="color: #0000ff">#define SECTOR_SIZE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0x200</span>

		<span style="color: #0000ff">#define SECTOR_BITS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9</span>

		<span style="color: #0000ff">#define BIOSDISK_FLAG_BIFURCATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0x4</span>

		<span style="color: #0000ff">#define MB_ARD_MEMORY&nbsp;&nbsp;&nbsp; 1</span>

		<span style="color: #0000ff">#define MB_INFO_MEM_MAP&nbsp;&nbsp;&nbsp; 0x00000040</span>

		<span style="color: #0000ff">#define errnum (*(grub_error_t *)0x8314)</span>

		<span style="color: #0000ff">#define current_drive (*(unsigned long *)0x8318)</span>

		<span style="color: #0000ff">#define current_partition (*(unsigned long *)0x831C)</span>

		<span style="color: #0000ff">#define filemax (*(unsigned long long *)0x8320)</span>

		<span style="color: #0000ff">#define filepos (*(unsigned long long *)0x8328)</span>

		<span style="color: #0000ff">#define debug (*(int *)0x8330)</span>

		<span style="color: #0000ff">#define current_slice (*(unsigned long *)0x8334)</span>

		<span style="color: #0000ff">#define GRUB_READ 0xedde0d90</span>

		<span style="color: #0000ff">#define GRUB_WRITE 0x900ddeed</span>

		<span style="color: #0000ff">#define sprintf ((int (*)(char *, const char *, ...))((*(int **)0x8300)[0]))</span>

		<span style="color: #0000ff">#define printf(...) sprintf(NULL, __VA_ARGS__)</span>

		<span style="color: #0000ff">#define putstr ((void (*)(const char *))((*(int **)0x8300)[1]))</span>

		<span style="color: #0000ff">#define putchar ((void (*)(int))((*(int **)0x8300)[2]))</span>

		<span style="color: #0000ff">#define get_cmdline ((int (*)(struct get_cmdline_arg))((*(int **)0x8300)[3]))</span>

		<span style="color: #0000ff">#define getxy ((int (*)(void))((*(int **)0x8300)[4]))</span>

		<span style="color: #0000ff">#define gotoxy ((void (*)(int, int))((*(int **)0x8300)[5]))</span>

		<span style="color: #0000ff">#define cls ((void (*)(void))((*(int **)0x8300)[6]))</span>

		<span style="color: #0000ff">#define setcursor ((int (*)(int))((*(int **)0x8300)[7]))</span>

		<span style="color: #0000ff">#define nul_terminate ((int (*)(char *))((*(int **)0x8300)[8]))</span>

		<span style="color: #0000ff">#define safe_parse_maxint_with_suffix ((int (*)(char **str_ptr, unsigned long long *myint_ptr, int unitshift))((*(int **)0x8300)[9]))</span>

		<span style="color: #0000ff">#define safe_parse_maxint(str_ptr, myint_ptr) safe_parse_maxint_with_suffix(str_ptr, myint_ptr, 0)</span>

		<span style="color: #0000ff">#define substring ((int (*)(const char *s1, const char *s2, int case_insensitive))((*(int **)0x8300)[10]))</span>

		<span style="color: #0000ff">#define strstr ((char *(*)(const char *s1, const char *s2))((*(int **)0x8300)[11]))</span>

		<span style="color: #0000ff">#define strlen ((int (*)(const char *str))((*(int **)0x8300)[12]))</span>

		<span style="color: #0000ff">#define strtok ((char *(*)(char *s, const char *delim))((*(int **)0x8300)[13]))</span>

		<span style="color: #0000ff">#define strncat ((int (*)(char *s1, const char *s2, int n))((*(int **)0x8300)[14]))</span>

		<span style="color: #0000ff">#define strcmp ((int (*)(const char *s1, const char *s2))((*(int **)0x8300)[15]))</span>

		<span style="color: #0000ff">#define strcpy ((char *(*)(char *dest, const char *src))((*(int **)0x8300)[16]))</span>

		<span style="color: #0000ff">#define tolower ((int (*)(int))((*(int **)0x8300)[17]))</span>

		<span style="color: #0000ff">#define isspace ((int (*)(int))((*(int **)0x8300)[18]))</span>

		<span style="color: #0000ff">#define getkey ((int (*)(void))((*(int **)0x8300)[19]))</span>

		<span style="color: #0000ff">#define checkkey ((int (*)(void))((*(int **)0x8300)[20]))</span>

		<span style="color: #0000ff">#define sleep ((unsigned int (*)(unsigned int))((*(int **)0x8300)[21]))</span>

		<span style="color: #0000ff">#define memcmp ((int (*)(const char *s1, const char *s2, int n))((*(int **)0x8300)[22]))</span>

		<span style="color: #0000ff">#define memmove ((void *(*)(void *to, const void *from, int len))((*(int **)0x8300)[23]))</span>

		<span style="color: #0000ff">#define memset ((void *(*)(void *start, int c, int len))((*(int **)0x8300)[24]))</span>

		<span style="color: #0000ff">#define mem64 ((int (*)(int, unsigned long long, unsigned long long, unsigned long long))((*(int **)0x8300)[25]))</span>

		<span style="color: #0000ff">#define open ((int (*)(char *))((*(int **)0x8300)[26]))</span>

		<span style="color: #0000ff">#define read ((unsigned long long (*)(unsigned long long, unsigned long long, unsigned long))((*(int **)0x8300)[27]))</span>

		<span style="color: #0000ff">#define close ((void (*)(void))((*(int **)0x8300)[28]))</span>

		<span style="color: #0000ff">#define unicode_to_utf8 ((void (*)(unsigned short *, unsigned char *, unsigned long))((*(int **)0x8300)[29]))</span>

		<span style="color: #008000">/*</span>

		<span style="color: #008000">int</span>

		<span style="color: #008000">rawread (unsigned long drive, unsigned long sector, unsigned long byte_offset, unsigned long byte_len, unsigned long long buf, unsigned long write)</span>

		<span style="color: #008000">*/</span>

		<span style="color: #0000ff">#define rawread ((int (*)(unsigned long, unsigned long, unsigned long, unsigned long long, unsigned long long, unsigned long))((*(int **)0x8300)[30]))</span>

		<span style="color: #008000">/*</span>

		<span style="color: #008000">int</span>

		<span style="color: #008000">rawwrite (unsigned long drive, unsigned long sector, char *buf)</span>

		<span style="color: #008000">*/</span>

		<span style="color: #0000ff">#define rawwrite ((int (*)(unsigned long, unsigned long, char *))((*(int **)0x8300)[31]))</span>

		<span style="color: #008000">/*</span>

		<span style="color: #008000">int</span>

		<span style="color: #008000">devread (unsigned long drive, unsigned long sector, unsigned long byte_offset, unsigned long long byte_len, unsigned long long buf, unsigned long write)</span>

		<span style="color: #008000">*/</span>

		<span style="color: #0000ff">#define devread ((int (*)(unsigned long sector, unsigned long byte_offset, unsigned long long byte_len, unsigned long long buf, unsigned long write))((*(int **)0x8300)[32]))</span>

		<span style="color: #008000">/*</span>

		<span style="color: #008000">* int</span>

		<span style="color: #008000">* devwrite (unsigned long sector, unsigned long sector_count, char *buf)</span>

		<span style="color: #008000">*/</span>

		<span style="color: #0000ff">#define devwrite ((int (*)(unsigned long, unsigned long, char *))((*(int **)0x8300)[33]))</span>

		<span style="color: #0000ff">#define next_partition ((int (*)(void))((*(int **)0x8300)[34]))</span>

		<span style="color: #0000ff">#define open_device ((int (*)(void))((*(int **)0x8300)[35]))</span>

		<span style="color: #0000ff">#define real_open_partition ((int (*)(int))((*(int **)0x8300)[36]))</span>

		<span style="color: #0000ff">#define set_device ((char *(*)(char *))((*(int **)0x8300)[37]))</span>

		<span style="color: #0000ff">#define dir ((int (*)(char *))((*(int **)0x8300)[38]))</span>

		<span style="color: #0000ff">#define print_a_completion ((void (*)(char *))((*(int **)0x8300)[39]))</span>

		<span style="color: #0000ff">#define print_completions ((int (*)(int, int))((*(int **)0x8300)[40]))</span>

		<span style="color: #0000ff">#define parse_string ((int (*)(char *))((*(int **)0x8300)[41]))</span>

		<span style="color: #0000ff">#define hexdump ((void (*)(unsigned long, char *, int))((*(int **)0x8300)[42]))</span>

		<span style="color: #0000ff">#define skip_to ((char *(*)(int after_equal, char *cmdline))((*(int **)0x8300)[43]))</span>

		<span style="color: #0000ff">#define builtin_cmd ((int (*)(char *cmd, char *arg, int flags))((*(int **)0x8300)[44]))</span>

		<span style="color: #0000ff">#define get_datetime ((void (*)(unsigned long *date, unsigned long *time))((*(int **)0x8300)[45]))</span>

		<span style="color: #0000ff">#define lba_to_chs ((void (*)(unsigned long lba, unsigned long *cl, unsigned long *ch, unsigned long *dh))((*(int **)0x8300)[46]))</span>

		<span style="color: #0000ff">#define probe_bpb ((int (*)(struct master_and_dos_boot_sector *BS))((*(int **)0x8300)[47]))</span>

		<span style="color: #0000ff">#define probe_mbr ((int (*)(struct master_and_dos_boot_sector *BS, unsigned long start_sector1, unsigned long sector_count1, unsigned long part_start1))((*(int **)0x8300)[48]))</span>

		<span style="color: #0000ff">#define graphics_get_font ((unsigned char *(*)(void))((*(int **)0x8300)[51]))</span>

		<span style="color: #0000ff">#define RAW_ADDR(x) (x)</span>

		<span style="color: #0000ff">#define SCRATCHADDR&nbsp; RAW_ADDR (0x37e00)</span>

		<span style="color: #0000ff">#define MBR ((char *)0x8000)</span>

		<span style="color: #008000">//#define grub_memcmp memcmp</span>

		<span style="color: #0000ff">struct</span> <span style="color: #000000">get_cmdline_arg</span>

		<span style="color: #000000">{</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">char</span> <span style="color: #000000">*</span><span style="color: #000000">cmdline</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">char</span> <span style="color: #000000">*</span><span style="color: #000000">prompt</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">int</span> <span style="color: #000000">maxlen</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">int</span> <span style="color: #000000">echo_char</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">int</span> <span style="color: #000000">readline</span>;

		<span style="color: #000000">}</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));

		<span style="color: #0000ff">struct</span> <span style="color: #000000">geometry</span>

		<span style="color: #000000">{</span>

		&nbsp; <span style="color: #008000">/* The number of cylinders */</span>

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">cylinders</span>;

		&nbsp; <span style="color: #008000">/* The number of heads */</span>

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">heads</span>;

		&nbsp; <span style="color: #008000">/* The number of sectors */</span>

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">sectors</span>;

		&nbsp; <span style="color: #008000">/* The total number of sectors */</span>

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #2b91af">long</span> <span style="color: #000000">total_sectors</span>;

		&nbsp; <span style="color: #008000">/* Device sector size */</span>

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">sector_size</span>;

		&nbsp; <span style="color: #008000">/* Flags */</span>

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">flags</span>;

		<span style="color: #000000">};</span>

		<span style="color: #008000">/* fsys.h */</span>

		<span style="color: #0000ff">struct</span> <span style="color: #000000">fsys_entry</span>

		<span style="color: #000000">{</span>

		&nbsp; <span style="color: #2b91af">char</span> <span style="color: #000000">*</span><span style="color: #000000">name</span>;

		&nbsp; <span style="color: #2b91af">int</span> (<span style="color: #000000">*</span><span style="color: #000000">mount_func</span>) (<span style="color: #2b91af">void</span>);

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> (<span style="color: #000000">*</span><span style="color: #000000">read_func</span>) (<span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #2b91af">long</span> <span style="color: #000000">buf</span><span style="color: #000000">,</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #2b91af">long</span> <span style="color: #000000">len</span><span style="color: #000000">,</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">write</span>);

		&nbsp; <span style="color: #2b91af">int</span> (<span style="color: #000000">*</span><span style="color: #000000">dir_func</span>) (<span style="color: #2b91af">char</span> <span style="color: #000000">*</span><span style="color: #000000">dirname</span>);

		&nbsp; <span style="color: #2b91af">void</span> (<span style="color: #000000">*</span><span style="color: #000000">close_func</span>) (<span style="color: #2b91af">void</span>);

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> (<span style="color: #000000">*</span><span style="color: #000000">embed_func</span>) (<span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">*</span><span style="color: #000000">start_sector</span><span style="color: #000000">,</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">needed_sectors</span>);

		<span style="color: #000000">};</span>

		<span style="color: #008000">/* fsys.h */</span>

		<span style="color: #008000">/* shared.h */</span>

		<span style="color: #0000ff">struct</span> <span style="color: #000000">master_and_dos_boot_sector</span> <span style="color: #000000">{</span>

		<span style="color: #008000">/* 00 */</span> <span style="color: #2b91af">char</span> <span style="color: #000000">dummy1</span><span style="color: #000000">[</span><span style="color: #000000">0x0b</span><span style="color: #000000">];</span> <span style="color: #008000">/* at offset 0, normally there is a short JMP instuction(opcode is 0xEB) */</span>

		<span style="color: #008000">/* 0B */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">bytes_per_sector</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* seems always to be 512, so we just use 512 */</span>

		<span style="color: #008000">/* 0D */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">sectors_per_cluster</span>;<span style="color: #008000">/* non-zero, the power of 2, i.e., 2^n */</span>

		<span style="color: #008000">/* 0E */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">reserved_sectors</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* FAT=non-zero, NTFS=0? */</span>

		<span style="color: #008000">/* 10 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">number_of_fats</span>;<span style="color: #008000">/* NTFS=0; FAT=1 or 2&nbsp; */</span>

		<span style="color: #008000">/* 11 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">root_dir_entries</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* FAT32=0, NTFS=0, FAT12/16=non-zero */</span>

		<span style="color: #008000">/* 13 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">total_sectors_short</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* FAT32=0, NTFS=0, FAT12/16=any */</span>

		<span style="color: #008000">/* 15 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">media_descriptor</span>;<span style="color: #008000">/* range from 0xf0 to 0xff */</span>

		<span style="color: #008000">/* 16 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">sectors_per_fat</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* FAT32=0, NTFS=0, FAT12/16=non-zero */</span>

		<span style="color: #008000">/* 18 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">sectors_per_track</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* range from 1 to 63 */</span>

		<span style="color: #008000">/* 1A */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">total_heads</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* range from 1 to 256 */</span>

		<span style="color: #008000">/* 1C */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">hidden_sectors</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* any value */</span>

		<span style="color: #008000">/* 20 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">total_sectors_long</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* FAT32=non-zero, NTFS=0, FAT12/16=any */</span>

		<span style="color: #008000">/* 24 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">sectors_per_fat32</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* FAT32=non-zero, NTFS=any, FAT12/16=any */</span>

		<span style="color: #008000">/* 28 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #2b91af">long</span> <span style="color: #000000">total_sectors_long_long</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* NTFS=non-zero, FAT12/16/32=any */</span>

		<span style="color: #008000">/* 30 */</span> <span style="color: #2b91af">char</span> <span style="color: #000000">dummy2</span><span style="color: #000000">[</span><span style="color: #000000">0x18e</span><span style="color: #000000">];</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* Partition Table, starting at offset 0x1BE */</span>

		<span style="color: #008000">/* 1BE */</span> <span style="color: #0000ff">struct</span> <span style="color: #000000">{</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +00 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">boot_indicator</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +01 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">start_head</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +02 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">start_sector_cylinder</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +04 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">system_indicator</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +05 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">end_head</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +06 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">end_sector_cylinder</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +08 */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">start_lba</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +0C */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">total_sectors</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* +10 */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #000000">}</span> P<span style="color: #000000">[</span><span style="color: #000000">4</span><span style="color: #000000">];</span>

		<span style="color: #008000">/* 1FE */</span> <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">boot_signature</span> <span style="color: #000000">__attribute__</span> ((<span style="color: #000000">packed</span>));<span style="color: #008000">/* 0xAA55 */</span>

		<span style="color: #0000ff">#if 0</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; /* This starts at offset 0x200 */</span>

		<span style="color: #008000">/* 200 */ unsigned long probed_total_sectors __attribute__ ((packed));</span>

		<span style="color: #008000">/* 204 */ unsigned long probed_heads __attribute__ ((packed));</span>

		<span style="color: #008000">/* 208 */ unsigned long probed_sectors_per_track __attribute__ ((packed));</span>

		<span style="color: #008000">/* 20C */ unsigned long probed_cylinders __attribute__ ((packed));</span>

		<span style="color: #008000">/* 210 */ unsigned long sectors_per_cylinder __attribute__ ((packed));</span>

		<span style="color: #008000">/* 214 */ char dummy3[0x0c] __attribute__ ((packed));</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp; /* matrix of coefficients of linear equations</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; *</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp; C[n] * (H_count * S_count) + H[n] * S_count = LBA[n] - S[n] + 1</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; *</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; * where n = 1, 2, 3, 4, 5, 6, 7, 8</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; */</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; /* This starts at offset 0x130 */</span>

		<span style="color: #008000">/* 220 */ long long L[9] __attribute__ ((packed)); /* L[n] == LBA[n] - S[n] + 1 */</span>

		<span style="color: #008000">/* 268 */ long H[9] __attribute__ ((packed));</span>

		<span style="color: #008000">/* 28C */ short C[9] __attribute__ ((packed));</span>

		<span style="color: #008000">/* 29E */ short X __attribute__ ((packed));</span>

		<span style="color: #008000">/* 2A0 */ short Y __attribute__ ((packed));</span>

		<span style="color: #008000">/* 2A2 */ short Cmax __attribute__ ((packed));</span>

		<span style="color: #008000">/* 2A4 */ long Hmax __attribute__ ((packed));</span>

		<span style="color: #008000">/* 2A8 */ unsigned long Z __attribute__ ((packed));</span>

		<span style="color: #008000">/* 2AC */ short Smax __attribute__ ((packed));</span>

		<span style="color: #008000">/* 2AE */</span>

		<span style="color: #0000ff">#endif</span>

		&nbsp; <span style="color: #000000">};</span>

		<span style="color: #0000ff">struct</span> <span style="color: #000000">drive_map_slot</span>

		<span style="color: #000000">{</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* Remember to update DRIVE_MAP_SLOT_SIZE once this is modified.</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; * The struct size must be a multiple of 4.</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* X=max_sector bit 7: read only or fake write */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* Y=to_sector&nbsp; bit 6: safe boot or fake write */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* ------------------------------------------- */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* X Y: meaning of restrictions imposed on map */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* ------------------------------------------- */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* 1 1: read only=0, fake write=1, safe boot=0 */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* 1 0: read only=1, fake write=0, safe boot=0 */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* 0 1: read only=0, fake write=0, safe boot=1 */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* 0 0: read only=0, fake write=0, safe boot=0 */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">from_drive</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">to_drive</span>;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* 0xFF indicates a memdrive */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">max_head</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">max_sector</span>;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* bit 7: read only */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* bit 6: disable lba */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">to_cylinder</span>;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* max cylinder of the TO drive */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* bit 15:&nbsp; TO&nbsp; drive support LBA */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* bit 14:&nbsp; TO&nbsp; drive is CDROM(with big 2048-byte sector) */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* bit 13: FROM drive is CDROM(with big 2048-byte sector) */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">to_head</span>;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* max head of the TO drive */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">char</span> <span style="color: #000000">to_sector</span>;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* max sector of the TO drive */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* bit 7: in-situ */</span>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* bit 6: fake-write or safe-boot */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #2b91af">long</span> <span style="color: #000000">start_sector</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">//unsigned long start_sector_hi;&nbsp;&nbsp;&nbsp; /* hi dword of the 64-bit value */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #2b91af">long</span> <span style="color: #000000">sector_count</span>;

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">//unsigned long sector_count_hi;&nbsp;&nbsp;&nbsp; /* hi dword of the 64-bit value */</span>

		<span style="color: #000000">};</span>

		<span style="color: #008000">/* shared.h */</span>

		<span style="color: #0000ff">typedef</span> <span style="color: #0000ff">enum</span>

		<span style="color: #000000">{</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #000000">COLOR_STATE_STANDARD</span><span style="color: #000000">,</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* represents the user defined colors for normal text */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #000000">COLOR_STATE_NORMAL</span><span style="color: #000000">,</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* represents the user defined colors for highlighted text */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #000000">COLOR_STATE_HIGHLIGHT</span><span style="color: #000000">,</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* represents the user defined colors for help text */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #000000">COLOR_STATE_HELPTEXT</span><span style="color: #000000">,</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #008000">/* represents the user defined colors for heading line */</span>

		&nbsp;&nbsp;&nbsp; <span style="color: #000000">COLOR_STATE_HEADING</span>

		<span style="color: #000000">}</span> <span style="color: #000000">color_state</span>;

		<span style="color: #0000ff">struct</span> <span style="color: #000000">term_entry</span>

		<span style="color: #000000">{</span>

		&nbsp; <span style="color: #008000">/* The name of a terminal.&nbsp; */</span>

		&nbsp; <span style="color: #0000ff">const</span> <span style="color: #2b91af">char</span> <span style="color: #000000">*</span><span style="color: #000000">name</span>;

		&nbsp; <span style="color: #008000">/* The feature flags defined above.&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">long</span> <span style="color: #000000">flags</span>;

		&nbsp; <span style="color: #008000">/* Default for maximum number of lines if not specified */</span>

		&nbsp; <span style="color: #2b91af">unsigned</span> <span style="color: #2b91af">short</span> <span style="color: #000000">max_lines</span>;

		&nbsp; <span style="color: #008000">/* Put a character.&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">void</span> (<span style="color: #000000">*</span><span style="color: #000000">PUTCHAR</span>) (<span style="color: #2b91af">int</span> <span style="color: #000000">c</span>);

		&nbsp; <span style="color: #008000">/* Check if any input character is available.&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">int</span> (<span style="color: #000000">*</span><span style="color: #000000">CHECKKEY</span>) (<span style="color: #2b91af">void</span>);

		&nbsp; <span style="color: #008000">/* Get a character.&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">int</span> (<span style="color: #000000">*</span><span style="color: #000000">GETKEY</span>) (<span style="color: #2b91af">void</span>);

		&nbsp; <span style="color: #008000">/* Get the cursor position. The return value is ((X &lt;&lt; 8) | Y).&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">int</span> (<span style="color: #000000">*</span><span style="color: #000000">GETXY</span>) (<span style="color: #2b91af">void</span>);

		&nbsp; <span style="color: #008000">/* Go to the position (X, Y).&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">void</span> (<span style="color: #000000">*</span><span style="color: #000000">GOTOXY</span>) (<span style="color: #2b91af">int</span> <span style="color: #000000">x</span><span style="color: #000000">,</span> <span style="color: #2b91af">int</span> <span style="color: #000000">y</span>);

		&nbsp; <span style="color: #008000">/* Clear the screen.&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">void</span> (<span style="color: #000000">*</span><span style="color: #000000">CLS</span>) (<span style="color: #2b91af">void</span>);

		&nbsp; <span style="color: #008000">/* Set the current color to be used */</span>

		&nbsp; <span style="color: #2b91af">void</span> (<span style="color: #000000">*</span><span style="color: #000000">SETCOLORSTATE</span>) (<span style="color: #000000">color_state</span> <span style="color: #000000">state</span>);

		&nbsp; <span style="color: #008000">/* Set the normal color and the highlight color. The format of each</span>

		<span style="color: #008000">&nbsp;&nbsp;&nbsp;&nbsp; color is VGA&#39;s.&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">void</span> (<span style="color: #000000">*</span><span style="color: #000000">SETCOLOR</span>) (<span style="color: #2b91af">int</span> <span style="color: #000000">normal_color</span><span style="color: #000000">,</span> <span style="color: #2b91af">int</span> <span style="color: #000000">highlight_color</span><span style="color: #000000">,</span> <span style="color: #2b91af">int</span> <span style="color: #000000">helptext_color</span><span style="color: #000000">,</span> <span style="color: #2b91af">int</span> <span style="color: #000000">heading_color</span>);

		&nbsp; <span style="color: #008000">/* Turn on/off the cursor.&nbsp; */</span>

		&nbsp; <span style="color: #2b91af">int</span> (<span style="color: #000000">*</span><span style="color: #000000">SETCURSOR</span>) (<span style="color: #2b91af">int</span> <span style="color: #000000">on</span>);

		&nbsp; <span style="color: #008000">/* function to start a terminal */</span>

		&nbsp; <span style="color: #2b91af">int</span> (<span style="color: #000000">*</span><span style="color: #000000">STARTUP</span>) (<span style="color: #2b91af">void</span>);

		&nbsp; <span style="color: #008000">/* function to use to shutdown a terminal */</span>

		&nbsp; <span style="color: #2b91af">void</span> (<span style="color: #000000">*</span><span style="color: #000000">SHUTDOWN</span>) (<span style="color: #2b91af">void</span>);

		<span style="color: #000000">};</span>

		<span style="color: #0000ff">#endif</span></div>
</div>