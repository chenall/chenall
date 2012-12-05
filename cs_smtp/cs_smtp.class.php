<?php
/*
	简易的SMTP发送邮件类，代码比较少，有助于学习SMTP协议，
	可以带附件，支持需要验证的SMTP服务器（目前的SMTP基本都需要验证）
	编写: chenall
	时间: 2012-12-04
	网址: http://chenall.net/post/cs_smtp/
	修订记录:
		2012-12-04
		   第一个版本

	使用方法:
		
		1. 初始化：连接到服务器（默认是QQ邮箱）
		   $mail = new cs_smtp('smtp.qq.com',25)
		   if ($mail->errstr) //如果连接出错
			   die($mail->errstr;
		2. 登录到服务器验证,如果失败返回FALSE;
		   if (!$mail->login('USERNAME','PASSWORD'))
				die($mail->errstr;
		3. 添加附件如果不指定name自动从指定的文件中取文件名
		   $mail->AddFile($file,$name) //服务器上的文件，可以指定文件名;
		4. 发送邮件
			$mail->send($to,$subject,$body)
			$to 收件人，多个使用','分隔
			$subject 邮件主题，可选。
			$body  邮件主体内容，可选
*/
class cs_smtp
{
	private $CRLF = "\r\n";
	private $from;
	private $smtp = null;
	private $attach = array();
	public $debug = false;
	public $errstr = '';

	function __construct($host='smtp.qq.com',$port = 25) {
		if (empty($host))
			die('SMTP服务器未指定!');
		$this->smtp = fsockopen($host,$port,$errno,$errstr,5);
		if (empty($this->smtp))
		{
			$this->errstr = '错误'.$errno.':'.$errstr;
			return;
		}
		$this->smtp_log(fread($this->smtp, 515));
		if (intval($this->smtp_cmd('EHLO LOCALHOST')) != 250 && intval($this->smtp_cmd('HELO LOCALHOST')))
			$this->errstr = '服务器不支持！';
	}

	function __destruct()
	{
		if ($this->smtp)
			$this->smtp_cmd('QUIT');//发送退出命令
	}

	private function smtp_log($msg)//即时输出调试使用
	{
		if ($this->debug == false)
			return;
		echo $msg."\r\n";
		ob_flush();
		flush();
	}

	function smtp_cmd($msg)//SMTP命令发送和收收
	{
		fputs($this->smtp,$msg.$this->CRLF);
		$this->smtp_log('SEND:'. substr($msg,0,80));
		$res = fread($this->smtp, 515);
		$this->smtp_log($res);
		return $res;
	}

	function AddFile($file,$name = '')//添加文件附件
	{
		if (file_exists($file))
		{
			if (!empty($name))
				return $this->attach[$name] = $file;
			$fn = pathinfo($file);
			return $this->attach[$fn['basename']] = $file;
		}
		return false;
	}

	private function attachment($file,$name)
	{
		$msg = "Content-Type: application/octet-stream; name=".$name."\n";
		$msg .= "Content-Disposition: attachment; filename=".$name."\n";
		$msg .= "Content-transfer-encoding: base64\n\n";
		$msg .= chunk_split(base64_encode(file_get_contents($file)));//使用BASE64编码，再用chunk_split大卸八块（每行76个字符）
		return $msg;
	}

	function send($to,$subject='',$body = '')
	{
		$this->smtp_cmd("MAIL FROM: ".$this->from);
		$mailto = explode(',',$to);
		foreach($mailto as $email_to)
			$this->smtp_cmd("RCPT TO: $email_to");
		$boundary = '--BY_CHENALL_'.uniqid("");
		$headers = "MIME-Version: 1.0".$this->CRLF;
		$headers .= "From: <".$this->from.">".$this->CRLF;
		$headers .= "Content-type: multipart/mixed; boundary= $boundary".$this->CRLF;
		$message = "--$boundary\nContent-Type: text/html;charset=\"ISO-8859-1\"\nContent-Transfer-Encoding: base64\n\n";
		$message .= chunk_split(base64_encode($body));
		$files = '';
		foreach($this->attach as $name=>$file)
		{
			$files .= $name;
			$message .= "--$boundary\n--$boundary\n".$this->attachment($file,$name);
		}
		empty($subject) && $subject = $files;
		$message .= "--$boundary--\n";
		$this->smtp_cmd("DATA");
		$this->smtp_cmd("To:$to\nFrom: ".$this->from."\nSubject: $subject\n$headers\n\n$message\r\n.");
	}

	function login($su,$sp)
	{
		if (empty($this->smtp))
			return false;
		$res = $this->smtp_cmd("AUTH LOGIN");
		if (intval($res)>400)
			return !$this->errstr = $res;
		$res = $this->smtp_cmd(base64_encode($su));
		if (intval($res)>400)
			return !$this->errstr = $res;
		$res = $this->smtp_cmd(base64_encode($sp));
		if (intval($res)>400)
			return !$this->errstr = $res;
		$this->from = $su;
		return true;
	}
}
?>