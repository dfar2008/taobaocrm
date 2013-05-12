<?php
class ErrorHandler {
	var $_errorflags = null;
	var $_handlerflags = null;

	function ErrorHandler() {
		$this->_errorflags = E_ALL & ~E_NOTICE;
		$this->_handlerflags = E_ALL & ~E_ERROR;
	}

	function setHandlerFlags($Flags) {
		$this->_handlerflags = $Flags;
	}
	function setErrorFlags($Flags) {
		$this->_errorflags = $Flags;
	}

	function _FatalErrorHandler($buffer) {
		if (preg_match("/(error<\/b>:)(.+)(<br)/i", $buffer, $regs) ) {
			$err = preg_replace("/<.*?>/","",$regs[2]);
			preg_match('/^(.+) in (.+) on line ([0-9]+)/', $err, $regs);
			$errno = E_ERROR; 
			$errstr = $regs[1]; 
			$errfile = $regs[2]; 
			$errline = $regs[3];

			return '<hr size=1>FATAL ('.$errno.'): '.$errstr.' ('.basename($errfile).':'.$errline.')'.'<hr size=1>';
		}
		
		return $buffer;
	}

	function _NormalErrorHandler($errno, $errstr, $errfile, $errline) {
		if(error_reporting() == 0) 
			return false;
			
		if($errno & $this->_errorflags ) {
			echo '<hr size=1>ERROR ('.$errno.'): '.$errstr.' ('.basename($errfile).':'.$errline.')'.'<hr size=1>';
		}
	}

	function Listen() {
		if ($this->_handlerflags & E_ERROR) 
			ob_start(array(&$this, '_FatalErrorHandler'));
			
		if ($this->_handlerflags & E_WARNING)
			set_error_handler(array(&$this, '_NormalErrorHandler'));
		
		error_reporting($this->_errorflags);
	}
}

function err_handler($errno, $errstr, $errfile, $errline) {
    $errortype = array (
        E_ERROR			=> "Error",
        E_WARNING		=> "Warning",
        E_PARSE			=> "Parsing Error",
        E_NOTICE		=> "Notice",
        E_CORE_ERROR	=> "Core Error",
        E_CORE_WARNING	=> "Core Warning",
        E_COMPILE_ERROR	=> "Compile Error",
        E_COMPILE_WARNING	=> "Compile Warning",
        E_USER_ERROR	=> "User Error",
        E_USER_WARNING	=> "User Warning",
        E_USER_NOTICE	=> "User Notice",
        E_ALL			=> "All"
    );

	$errors = array(E_WARNING, E_NOTICE);
	
	if(!in_array($errno, $errors)) {
		echo "<font face='Courier New,Courier,monospace' size=2>
		<b>".$errortype[$errno].":</b> ".$errstr." (File: ".basename($errfile).", Line: ".$errline.")<br>
		</font>";
	}
}
?>