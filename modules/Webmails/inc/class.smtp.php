<?php
class SMTPMailer {
	var $priority			= 3;
	
	var $charset			= "iso-8859-1";
	var $contenttype		= "plain";
	var $encoding			= "base64";
	
	var $from				= "#@[]";
	var $fromname			= "";
	
	var $subject			= "";
	var $body				= "";
	
	var $debug				= false;
	
	var $timezone			= "+0000";
	var $requestnotify		= false;

	// SMTP
	var $host        		= "localhost";
	var $port        		= 25;
	var $helo        		= "";
	var $timeout     		= 10; // Socket timeout in sec.

	/////////////////////////////////////////////////
	// PRIVATE VARIABLES
	/////////////////////////////////////////////////
	var $version        	= "";
	var $to             	= array();
	var $cc             	= array();
	var $bcc            	= array();
	var $replyto        	= array();
	
	var $attachment     	= array();
	var $embedfile     		= array();
	var $boundary			= false;
	
	var $authlogin 			= false;
	var $authuser       	= "";
	var $authpass       	= "";
	
	var $smimesign			= false;
	var $smimecrypt			= false;
	
	var $temp_folder		= "./";
	var $errormsg			= "";

	function SMTPMailer() {
		$this->version = "WebMail";
		$this->helo = "WebMail";
	}

	function UseAuthLogin($user, $pass) {
		$this->authlogin 	= true;
		$this->authuser 	= $user;
		$this->authpass 	= $pass;
	}
	
	function UseHTML($bool) {
		if($bool == true)
			$this->contenttype = "html";
		else
			$this->contenttype = "plain";
	}

	function SetHost($host, $port = 25) {
		$this->host = trim($host);
		if (!empty($port))
			$this->port = $port;
	}
	
	function SetFrom($address, $name = "") {
		$this->from = trim($address);
		$this->fromname = $name;
	}

	function AddTo($address, $name = "") {
		$cur = count($this->to);
		$this->to[$cur][0] = trim($address);
		$this->to[$cur][1] = $name;
	}

	function AddCc($address, $name = "") {
		$cur = count($this->cc);
		$this->cc[$cur][0] = trim($address);
		$this->cc[$cur][1] = $name;
	}

	function AddBcc($address, $name = "") {
		$cur = count($this->bcc);
		$this->bcc[$cur][0] = trim($address);
		$this->bcc[$cur][1] = $name;
	}

	function AddReplyTo($address, $name = "") {
		$cur = count($this->replyto);
		$this->replyto[$cur][0] = trim($address);
		$this->replyto[$cur][1] = $name;
	}

	function Send() {
		if(count($this->to) + count($this->cc) + count($this->bcc) == 0) {
			$this->errormsg = "You must provide at least one recipient address";
			return false;
		}
		
		$msgdata = $this->CreateMessage();

		if($this->_send_mail($msgdata) === false)
		   return false;
		
		return $msgdata;
	}

	function CreateMessage() {
		$bConvert = false;
		
		if ($this->smimesign || $this->smimecrypt){
			$msgdata = $this->_create_header(true);
			$msgdata .= $this->_create_body();

			$fileid = md5(uniqid(""));
			$newmsgfile = $this->temp_folder."_attachments/".$this->authuser.'_'.$fileid."_newmsg.eml";
			$signfile = $this->temp_folder."_attachments/".$this->authuser.'_'.$fileid."_signmsg.eml";
			$cryptfile = $this->temp_folder."_attachments/".$this->authuser.'_'.$fileid."_cryptmsg.eml";

			if (save_file($newmsgfile, $msgdata)){
				$headerInfo = $this->_get_header_info(true);

				if ($this->smimesign){
					$bRet = read_my_acitve_cert($cert, $key);
					if ($bRet && openssl_pkcs7_sign($newmsgfile, $signfile, $cert, $key, $headerInfo)) {
						$newmsgfile = $signfile;
						$bConvert = true;
					}
				}
				
				if ($this->smimecrypt){
					$arrAddress[] = $this->from;
					for ($i = 0; $i < count($this->to); $i++){
						if (!in_array($this->to[$i][0], $arrAddress))
							$arrAddress[] = $this->to[$i][0];
					}
					for ($i = 0; $i < count($this->cc); $i++){
						if (!in_array($this->to[$i][0], $arrAddress))
							$arrAddress[] = $this->cc[$i][0];
					}
					for ($i = 0; $i < count($this->bcc); $i++){
						if (!in_array($this->to[$i][0], $arrAddress))
							$arrAddress[] = $this->bcc[$i][0];
					}

					$bRet = read_all_receiver_cert($arrAddress, $arrCert);
					if ($bRet && openssl_pkcs7_encrypt($newmsgfile, $cryptfile, $arrCert, $headerInfo)){
						$newmsgfile = $cryptfile;
						$bConvert = true;
					}
				}
				
				if ($bConvert){
					$msgdata = read_file($newmsgfile);
					$msgdata = str_replace("\r\n", "\n", $msgdata);
					$msgdata = str_replace("\n", "\r\n", $msgdata);
				}
			}
			
			@unlink($newmsgfile);
			@unlink($signfile);
			@unlink($cryptfile);
		}
		
		if (!$bConvert){
			$msgdata = $this->_create_header();
			$msgdata .= $this->_create_body();
		}
				
		return $msgdata;
	}

	/////////////////////////////////////////////////
	// ATTACHMENT METHODS
	/////////////////////////////////////////////////
	function AddAttachment($path, $name = "", $type= "application/octet-stream") {
		if(!@is_file($path)) {
			$this->errormsg = sprintf("Could not find %s", $path);

			return false;
		}
		
		$filename = basename($path);
		if($name == "")
		   $name = $filename;
		
		$cur = count($this->attachment);
		$this->attachment[$cur][0] = $path;
		$this->attachment[$cur][1] = $filename;
		$this->attachment[$cur][2] = $name;
		$this->attachment[$cur][3] = $type;

		return true;
	}

	function AddEmbedFile($path, $name, $filename, $type= "image/gif") {
		if(!@is_file($path)) {
			$this->errormsg = sprintf("Could not find %s", $path);
			return false;
		}
		
		$name = basename($name);

		$cur = count($this->embedfile);
		$this->embedfile[$cur][0] = $path;
		$this->embedfile[$cur][1] = $filename;
		$this->embedfile[$cur][2] = $name;
		$this->embedfile[$cur][3] = $type;
		$this->embedfile[$cur][4] = md5(uniqid(time()));

		return true;
	}

	/////////////////////////////////////////////////
	// S/MIME METHODS
	/////////////////////////////////////////////////
	function UseSecureMime($sign, $crypt){
		$this->smimesign = $sign;
		$this->smimecrypt = $crypt;
	}

	function Clear() {
	   $this->fromname = "";
	   $this->from = "";
	   $this->to = array();
	   $this->cc = array();
	   $this->bcc = array();
	   $this->subject = "";
	   $this->body = "";
	   $this->attachment = array();
	   $this->embedfile = array();
	}
	
	//Private method
	function _mime_encode($string) {
		if($string == "") 
			return;
			
        if(!eregi("^([[:print:]]*)$",$string)){
    		$string = "=?".$this->charset."?B?".base64_encode($string)."?=";
		}
		
		return $string;
	}
	
	function _get_boundary(){
		static $index = 0;
		
		$boundary = "__b_".sprintf("%03d", $index++)."_".md5(uniqid(time()));
		
		return $boundary;
	}
	
	function _encode_file($path) {
		require_once("modules/Webmails/inc/lib.php");
		$content = read_file($path);
		if ($content === false){
			$this->errormsg = sprintf("Could not find %s", $path);
			return "";
		}
		
		// chunk_split is found in PHP >= 3.0.6
		$encoded = chunk_split(base64_encode($content));
		unset($content);
		
		return trim($encoded);
	}

	function _adjust_embed_path($body){
		$iEmbedCount = count($this->embedfile); 
		for ($i = 0; $i < $iEmbedCount; $i++){
			$filename = $this->embedfile[$i][1];
			$cid = $this->embedfile[$i][4];
			
//			$body = eregi_replace("=[\"]?".$filename."+[\"]?", "=\"cid:".$cid."\"", $body);
			$body = str_replace($filename, "cid:".$cid, $body);
		}
		
		return $body;
	}

	function _create_address($address) {
		$strAddress = "";

		$iAddrCount = count($address); 
		for($i = 0; $i < $iAddrCount; $i++) {
			if (!empty($strAddress))
				$strAddress .= ", \r\n\t";
				
			if(trim($address[$i][1]) != "")
				$strAddress .= sprintf("\"%s\" <%s>", $this->_mime_encode($address[$i][1]), $address[$i][0]);
			else
				$strAddress .= sprintf("%s", $address[$i][0]);
		}
		
		return $strAddress;
	}

	function _get_header_info() {
		$headerInfo = array();
		
		$headerInfo["Date"] = sprintf("%s %s", date("D, j M Y G:i:s"), $this->timezone);
		$headerInfo["From"] = sprintf("\"%s\" <%s>", $this->_mime_encode($this->fromname), trim($this->from));

		if(count($this->to) > 0)
			$headerInfo["To"] = $this->_create_address($this->to);
		if(count($this->cc) > 0)
			$headerInfo["Cc"] = $this->_create_address($this->cc);
		if(count($this->replyto) > 0)
			$headerInfo["Reply-to"] = $this->_create_address($this->replyto);

		$headerInfo["Subject"] = $this->_mime_encode(trim($this->subject));
		$headerInfo["X-Priority"] = $this->priority;
		$headerInfo["X-Mailer"] = $this->version;

		$headerInfo["Message-ID"] = md5(uniqid(rand())).strstr($this->from, '@');
		
		if ($this->requestnotify){
			$headerInfo["Disposition-Notification-To"] = sprintf("\"%s\" <%s>\r", $this->_mime_encode($this->fromname), trim($this->from));
		}	
		
		return $headerInfo;
	}

	function _create_header($bLite = false) {
		$headerInfo = array();
		
		if (!$bLite){
			$headerInfo[] = sprintf("Date: %s %s\r\n", date("D, j M Y G:i:s"), $this->timezone);
			$headerInfo[] = sprintf("From: \"%s\" <%s>\r\n", $this->_mime_encode($this->fromname), trim($this->from));
	
			if(count($this->to) > 0)
				$headerInfo[] = sprintf("To: %s\r\n", $this->_create_address($this->to));
			if(count($this->cc) > 0)
				$headerInfo[] = sprintf("Cc: %s\r\n", $this->_create_address($this->cc));
			if(count($this->replyto) > 0)
				$headerInfo[] = sprintf("Reply-To: %s\r\n", $this->_create_address($this->replyto));
	
			$headerInfo[] = sprintf("Subject: %s\r\n", $this->_mime_encode(trim($this->subject)));
			$headerInfo[] = sprintf("X-Priority: %d\r\n", $this->priority);
			$headerInfo[] = sprintf("X-Mailer: %s\r\n", $this->version);
	
			$headerInfo[] = sprintf("Message-ID: <%s>\r\n", md5(uniqid(rand())).strstr($this->from, '@'));
		}
		
		$this->boundary = $this->_get_boundary();
		if ($this->contenttype == "html"){
			if(count($this->attachment) > 0){
				$headerInfo[] = sprintf("Content-Type: multipart/mixed;\r\n");
				$headerInfo[] = sprintf("\tboundary=\"--=%s\"\r\n", $this->boundary);
			}
			else if (count($this->embedfile) > 0){
				$headerInfo[] = sprintf("Content-Type: multipart/related; \r\n");
				$headerInfo[] = sprintf("\ttype=\"multipart/alternative\";\r\n");
				$headerInfo[] = sprintf("\tboundary=\"--=%s\"\r\n", $this->boundary);
			}
			else {
				$headerInfo[] = sprintf("Content-Type: multipart/alternative;\r\n");
				$headerInfo[] = sprintf("\tboundary=\"--=%s\"\r\n", $this->boundary);
			}
		}
		else{
			if(count($this->attachment) > 0){
				$headerInfo[] = sprintf("Content-Type: multipart/mixed;\r\n");
				$headerInfo[] = sprintf("\tboundary=\"--=%s\"\r\n", $this->boundary);
			}
			else {
				$headerInfo[] = sprintf("Content-Type: text/plain;\r\n\tcharset=\"%s\"\r\n", $this->charset);
				$headerInfo[] = sprintf("Content-Transfer-Encoding: %s\r\n", $this->encoding);
			}
		}
		
		if (!$bLite){
			$headerInfo[] = "MIME-Version: 1.0\r\n";
	
			if ($this->requestnotify){
				$headerInfo[] = sprintf("Disposition-Notification-To: \"%s\" <%s>\r\n", $this->_mime_encode($this->fromname), trim($this->from));
			}	
		}
		
		return join("", $headerInfo)."\r\n";
	}

	function _create_body() {
		$body = $this->body;
		$boundary = $this->boundary;
		
		$iAttachCount = count($this->attachment); 
		$iEmbedCount = count($this->embedfile);

		$mimetag = "";
		$msgbodytag = "";
		$msgbody = "";
		$embedfilebodytag = "";
		$embedfilebody = "";
		$attachbody = "";
		
		if ($this->contenttype == 'html'){
			$mimetag = "This is a multi-part message in MIME format.\r\n\r\n";
			
			if ($iAttachCount > 0){
				$attachbody = $this->_create_attach_body($boundary);
			}
			 
			if ($iEmbedCount > 0){
				if (!empty($attachbody)){
					$newboundary = $this->_get_boundary();

					$embedfilebodytag .= sprintf("----=%s\r\n", $boundary);
					$embedfilebodytag .= sprintf("Content-Type: multipart/related;\r\n");
					$embedfilebodytag .= sprintf("\ttype=\"multipart/alternative\";\r\n");
					$embedfilebodytag .= sprintf("\tboundary=\"--=%s\"\r\n\r\n", $newboundary);
					
					$boundary = $newboundary;
				}
				
				$body = $this->_adjust_embed_path($body);
				$embedfilebody = $this->_create_embedfile_body($boundary);
			}
			
			if (!empty($attachbody) || !empty($embedfilebody)){
				$newboundary = $this->_get_boundary();

				$msgbodytag .= sprintf("----=%s\r\n", $boundary);
				$msgbodytag .= sprintf("Content-Type: multipart/alternative;\r\n");
				$msgbodytag .= sprintf("\tboundary=\"--=%s\"\r\n\r\n", $newboundary);

				$boundary = $newboundary;
			}
			
			$msgbody .= $this->_create_html_body($boundary, $body);
		}
		else {
			if ($iAttachCount > 0){
				$mimetag = "This is a multi-part message in MIME format.\r\n\r\n";
				$attachbody = $this->_create_attach_body($boundary);
			}
			else{
				$boundary = "";
			}

			$msgbody = $this->_create_plain_body($boundary, $body);
		}

		$body = $mimetag;
		$body .= $embedfilebodytag;
		$body .= $msgbodytag;
		$body .= $msgbody;
		$body .= $embedfilebody;
		$body .= $attachbody;
		
		return trim($body)."\r\n";		
	}

	function _encode_body($body) {
		if ($this->encoding == 'base64'){
			$mime = chunk_split(base64_encode($body));
		}
		else {
			$mime = wordwrap($body, 76, "\r\n");
		}
		
		return trim($mime);
	}

	function _create_plain_body($boundary = "", $body) {
		$encodebody = $this->_encode_body($body);
		if (!empty($boundary)){
			$mime .= sprintf("----=%s\r\n", $boundary);
			$mime .= sprintf("Content-Type: text/plain;\r\n\tcharset=\"%s\"\r\n", $this->charset);
			$mime .= sprintf("Content-Transfer-Encoding: %s\r\n\r\n", $this->encoding);
		}
		
		$mime .= sprintf("%s\r\n\r\n", $encodebody);
		
		return $mime;
	}

	function _create_html_body($boundary, $body) {
		$encodebody = $this->_encode_body(strip_tags($body));
		$mime .= sprintf("----=%s\r\n", $boundary);
		$mime .= sprintf("Content-Type: text/plain;\r\n\tcharset=\"%s\"\r\n", $this->charset);
		$mime .= sprintf("Content-Transfer-Encoding: %s\r\n\r\n", $this->encoding);
		$mime .= sprintf("%s\r\n\r\n", $encodebody);
		
		$encodebody = $this->_encode_body($body);
		$mime .= sprintf("----=%s\r\n", $boundary);
		$mime .= sprintf("Content-Type: text/html;\r\n\tcharset=\"%s\"\r\n", $this->charset);
		$mime .= sprintf("Content-Transfer-Encoding: %s\r\n\r\n", $this->encoding);
		$mime .= sprintf("%s\r\n\r\n", $encodebody);
		
		$mime .= sprintf("----=%s--\r\n\r\n", $boundary);

		return $mime;
	}

	function _create_attach_body($boundary) {
		$iAttachCount = count($this->attachment); 

		for($i = 0; $i < $iAttachCount; $i++) {
			$path = $this->attachment[$i][0];
			$filename = $this->attachment[$i][1];
			$name = $this->attachment[$i][2];
			$type = $this->attachment[$i][3];
			
			if (file_exists($path)){
				$mime .= sprintf("----=%s\r\n", $boundary);
				$mime .= sprintf("Content-Type: %s; name=\"%s\"\r\n", $type, $this->_mime_encode($name));
				$mime .= "Content-Transfer-Encoding: base64\r\n";
				$mime .= sprintf("Content-Disposition: attachment; filename=\"%s\"\r\n\r\n", $this->_mime_encode($name));
				
				$mime .= sprintf("%s\r\n\r\n", $this->_encode_file($path));
			}
		}

		$mime .= sprintf("----=%s--\r\n\r\n", $boundary);

		return $mime;
	}

	function _create_embedfile_body($boundary) {
		$iEmbedCount = count($this->embedfile); 

		for($i = 0; $i < $iEmbedCount; $i++) {
			$path = $this->embedfile[$i][0];
			$filename = $this->embedfile[$i][1];
			$name = $this->embedfile[$i][2];
			$type = $this->embedfile[$i][3];
			$cid = $this->embedfile[$i][4];
			
			if (file_exists($path)){
				$mime .= sprintf("----=%s\r\n", $boundary);
				$mime .= sprintf("Content-Type: %s; name=\"%s\"\r\n", $type, $this->_mime_encode($name));
				$mime .= "Content-Transfer-Encoding: base64\r\n";
				$mime .= sprintf("Content-ID: <%s>\r\n", $cid);
				$mime .= sprintf("Content-Disposition: inline; filename=\"%s\"\r\n\r\n", $this->_mime_encode($name));

				$mime .= sprintf("%s\r\n\r\n", $this->_encode_file($path));
			}
		}

		$mime .= sprintf("----=%s--\r\n\r\n", $boundary);

		return $mime;
	}
		
	function _send_mail($msgdata) {
		$smtp = new SMTP;
		$smtp->debug = $this->debug;

		if(!$smtp->Connect($this->host, $this->port, $this->timeout)) {
			$this->errormsg = "SMTP Error: could not connect to SMTP host server";
			$this->errormsg .= "[".$this->host.":".$this->port."]";
			return false;
		}

		if($this->authlogin) {
			if(!$smtp->AuthHello($this->helo, $this->authuser, $this->authpass)) {
				$this->errormsg = "SMTP Error: Invalid username/password";
				if ($smtp->errormsg)
					$this->errormsg .= "<br/>".$smtp->errormsg;
					
				return false;
			}
		} 
		else {
			$smtp->Hello($this->helo);
		}
		
		if (!$smtp->MailFrom(sprintf("<%s>", $this->from))){
			$this->errormsg = "SMTP Error: Mail from [".$this->from."] not accepted.";
			if ($smtp->errormsg)
				$this->errormsg .= "<br/>".$smtp->errormsg;
				
			return false;
		}
		
		$iToCount = count($this->to); 
		for($i = 0; $i < $iToCount; $i++){
			if(!$smtp->Recipient(sprintf("<%s>", $this->to[$i][0]))) {
				$this->errormsg = "SMTP Error: Recipient [".$this->to[$i][0]."] not accepted.";
				if ($smtp->errormsg)
					$this->errormsg .= "<br/>".$smtp->errormsg;
					
				return false;
			}
		}
			
		$iCcCount = count($this->cc); 
		for($i = 0; $i < $iCcCount; $i++){
			if(!$smtp->Recipient(sprintf("<%s>", $this->cc[$i][0]))) {
				$this->errormsg = "SMTP Error: Recipient [".$this->cc[$i][0]."] not accepted.";
				if ($smtp->errormsg)
					$this->errormsg .= "<br/>".$smtp->errormsg;

				return false;
			}
		}

		$iBccCount = count($this->bcc); 
		for($i = 0; $i < $iBccCount; $i++){
			if(!$smtp->Recipient(sprintf("<%s>", $this->bcc[$i][0]))) {
				$this->errormsg = "SMTP Error: Recipient [".$this->bcc[$i][0]."] not accepted.";
				if ($smtp->errormsg)
					$this->errormsg .= "<br/>".$smtp->errormsg;

				return false;
			}
		}

		if(!$smtp->Data($msgdata)) {
			$this->errormsg = "SMTP Error: Data not accepted";
			if ($smtp->errormsg)
				$this->errormsg .= "<br/>".$smtp->errormsg;

		   	return false;
		}

		$smtp->Quit();
	}
}

class SMTP {
    var $port = 25; 		

    var $debug;          	
    var $errormsg;       	

    var $_smtp_conn;      	
    var $CRLF = "\r\n";  	

    function SMTP() {
        $this->_smtp_conn = 0;
        $this->errormsg = "";
        $this->debug = 0;
    }

    function Connect($host, $port = 0, $tval = 30) {
        $this->errormsg = "";

        if($this->_connected()) {
            $this->errormsg = "Already connected to a server";
            return false;
        }

        if(empty($port))
            $port = $this->port;
		if($port == "465" || $port == "587") {
			$host = "ssl://".$host;
		}
        $this->_smtp_conn = fsockopen($host, $port, $errno, $errstr, $tval);   
        if(empty($this->_smtp_conn)) {
            $this->errormsg = "Failed to connect to server ($errno $errstr)";
            return false;
        }

        $announce = $this->_get_lines();

        return true;
    }

    function Close() {
        $this->errormsg = ""; 
        if(!empty($this->_smtp_conn)) { 
            fclose($this->_smtp_conn);
            $this->_smtp_conn = 0;
        }
    }

    function Hello($host = "") {
        $this->errormsg = "";
        if(!$this->_connected()) {
            $this->errormsg = "Called HELO without being connected";
            return false;
        }
        
        if(empty($host)) {
            $host = "SMTP Client";
        }

		$this->_send_line("HELO ".$host);
		
        $rply = $this->_get_lines();
        $code = substr($rply,0,3);

        if($code != 250) {
            $this->errormsg = $rply;
            return false;
        }

        return true;
    }

    function AuthHello($host = "", $user = "", $pass = "") {
        $this->errormsg = null; 
        if(!$this->_connected()) {
            $this->errormsg = "Called EHLO without being connected";
            return false;
        }

        if(empty($host))
            $host = "SMTP Client";

        $this->_send_line("EHLO ".$host);

        $rply = $this->_get_lines();
        $code = substr($rply, 0, 3);
        if($code != 250) {
            $this->errormsg = $rply;
            return false;
        }
        
        $this->_send_line("AUTH LOGIN");
        $rply = $this->_get_lines();
        $code = substr($rply,0,3);

        if($code != 334) {
            $this->errormsg = $rply;
            return false;
        }

        $this->_send_line(base64_encode($user));
        $rply = $this->_get_lines();
        $code = substr($rply, 0, 3);

        if($code != 334) {
            $this->errormsg = $rply;
            return false;
        }

        $this->_send_line(base64_encode($pass));
        $rply = $this->_get_lines();
        $code = substr($rply, 0, 3);
        if($code != 235) {
            $this->errormsg = $rply;
            return false;
        }
        
        return true;
    }

    function MailFrom($from) {
        $this->errormsg = null; 

        if(!$this->_connected()) {
            $this->errormsg = "Called MAIL without being connected";
            return false;
        }

        $this->_send_line("MAIL FROM:".$from);

        $rply = $this->_get_lines();
        $code = substr($rply,0,3);

        if($code != 250) {
            $this->errormsg = $rply;
            return false;
        }
        
        return true;
    }

    function Recipient($to) {
        $this->errormsg = null; 

        if(!$this->_connected()) {
            $this->errormsg = "Called RCPT without being connected";
            return false;
        }

        $this->_send_line("RCPT TO:".$to);

        $rply = $this->_get_lines();
        $code = substr($rply,0,3);

        if($code != 250 && $code != 251) {
            $this->errormsg = $rply;
            return false;
        }
        
        return true;
    }

    function Data($msg_data) {
        $this->errormsg = ""; 

        if(!$this->_connected()) {
            $this->errormsg = "Called DATA without being connected";
            return false;
        }

		$this->_send_line("DATA");

        $rply = $this->_get_lines();

        $code = substr($rply, 0, 3);

        if($code != 354) {
            $this->errormsg = $rply;
            return false;
        }

		$this->_send_line($msg_data);
		$this->_send_line(".");

        $rply = $this->_get_lines();
        $code = substr($rply,0,3);

        if($code != 250) {
            $this->errormsg = $rply;
            return false;
        }
        
        return true;
    }

    function Quit($close_on_error = true) {
        $this->errormsg = null; 

        if(!$this->_connected()) {
            $this->errormsg = "Called QUIT without being connected";
            return false;
        }

        $this->_send_line("QUIT");

        $byemsg = $this->_get_lines();

        $rval = true;
        $e = null;

        $code = substr($byemsg,0,3);
        if($code != 221) {
            $e = $byemsg;
            $this->errormsg = $byemsg;
            $rval = false;
        }

        if(empty($e) || $close_on_error)
            $this->Close();

        return $rval;
    }

	//private method
    function _connected() {
        if(!empty($this->_smtp_conn)) {
            $sock_status = socket_get_status($this->_smtp_conn);
            if($sock_status["eof"]) {
                $this->Close();
                
                return false;
            }
            
            return true;
        } 
        
        return false;
    }

    function _get_lines() {
		$data = "";
		
        while($str = fgets($this->_smtp_conn, 512)) {
            $data .= $str;
            if(substr($str, 3, 1) == " ")
            	break;
		}
		
		if($this->debug) {
			$tmp = ereg_replace("(\r|\n)", "", $data);
			echo("<b>".htmlspecialchars($tmp)."</b><br/>\r\n");
			flush();
		}
		
        return $data;
    }

    function _send_line($data) {
		fputs($this->_smtp_conn, $data.$this->CRLF);
		
		if($this->debug) {
			$data = htmlspecialchars($data);
			echo(nl2br($data)."<br/>\r\n");
			flush();
		}
    }
}

?>