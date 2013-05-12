<?php
include(dirname(__FILE__).'/class.errhandler.php');

//@ini_set('display_errors', 'off');
@ini_set('register_globals', '1');
@ini_set('magic_quotes_gpc', 'off');
@ini_set('upload_max_filesize', '120M');
@ini_set('post_max_size', '140M');
@ini_set('com.allow_dcom', '1');

$error_flags = E_ALL & ~E_NOTICE;
@ini_set('error_reporting', $error_flags);

$phpver = doubleval(phpversion());
if ($phpver < 5){
/*	
	$handler_flags = E_ALL & ~E_ERROR & ~E_NOTICE; 
	$error_flags = E_ALL & ~E_NOTICE; 
	
	$hError = new ErrorHandler();
	$hError->setHandlerFlags($handler_flags);
	$hError->setErrorFlags($error_flags);
	$hError->Listen();
*/
	@error_reporting($error_flags);
	@set_error_handler("err_handler");
}

if($phpver >= 4.1) {
	extract($_POST, EXTR_SKIP);
	extract($_GET, EXTR_SKIP);
	extract($_SERVER, EXTR_SKIP);
	extract($_FILES);
}

if (function_exists('mb_detect_encoding')) 
	define('MB_STRING', 1); 
else 
	define('MB_STRING', 0); 

function my_htmlspecialchars($strtext, $quote_style = ENT_COMPAT){
	if (MB_STRING){
		$strcharset = mb_detect_encoding($strtext);
		if (strcasecmp($strcharset, "JIS") == 0){
			$strtext = mb_convert_encoding($strtext, "SJIS", "JIS");
			$result = htmlspecialchars($strtext, $quote_style, "SJIS");
			$result = $strtext;
		}
		else{
			$result = htmlspecialchars($strtext, $quote_style);
		}
	}
	else{
		$result = htmlspecialchars($strtext, $quote_style);
	}
	
	return $result;
}

function my_htmlentities($strtext, $quote_style = ENT_COMPAT){
	if (MB_STRING){
		$strcharset = mb_detect_encoding($strtext);
		if (strcasecmp($strcharset, "JIS") == 0){
			$strtext = mb_convert_encoding($strtext, "SJIS", "JIS");
			$result = htmlentities($strtext, $quote_style, "SJIS");
			$result = $strtext;
		}
		else{
			$result = htmlentities($strtext, $quote_style);
		}
	}
	else{
		$result = htmlentities($strtext, $quote_style);
	}
	
	return $result;
}

function my_substr($strtext, $star, $len){
	if (MB_STRING){
		$strcharset = mb_detect_encoding($strtext);
		if ($strcharset != '')
			$result = mb_substr($strtext, $star, $len, $strcharset);
		else
			$result = substr($strtext, 0, $len);
	}
	else{
		$result = substr($strtext, 0, $len);
	}
	
	return $result;
}

function my_strlen($strtext){
	if (MB_STRING){
		$strcharset = mb_detect_encoding($strtext);
		if ($strcharset != '')
			$result = mb_strlen($strtext, $strcharset);
		else
			$result = strlen($strtext);
	}
	else{
		$result = strlen($strtext);
	}
	
	return $result;
}

function my_truncate($string, $length = 80, $etc = '...')
{
    if ($length == 0)
        return '';

    if (my_strlen($string) > $length) {
        $length -= my_strlen($etc);
      
        return my_substr($string, 0, $length).$etc;
    } 
    else
        return $string;
}

function array_sort(&$arrays)
{
	if (count($arrays) < 1 
		|| !is_array($arrays))
		return;
		
	$args = func_get_args();
	
	$code = 'return 0;';
	for ($n = 1; $n < count($args);) {
		$field = $args[$n];
		if ($field == '')
			break;
			
		$n++;
			
		if (in_array($args[$n], array('ASC' , 'DESC', 'ASC_NUM', 'DESC_NUM'))){
			$order = $args[$n];
			$n++;
		}
		else 
			$order = 'ASC';
		
		switch($order) {
		default:
		case 'ASC':
			$thiscode = '$retcode = strcasecmp($a["'.$field.'"], $b["'.$field.'"]); if ($retcode == 0) {return 0;} else {return $retcode;}';
			break;
		case 'DESC':
			$thiscode = '$retcode = strcasecmp($b["'.$field.'"], $a["'.$field.'"]); if ($retcode == 0) {return 0;} else {return $retcode;}';
			break;
		case 'ASC_NUM':
			$thiscode = '$retcode = ($a["'.$field.'"]-$b["'.$field.'"]); if ($retcode == 0) {return 0;} else {return $retcode;}';
			break;
		case 'DESC_NUM':
			$thiscode = '$retcode = ($b["'.$field.'"]-$a["'.$field.'"]); if ($retcode == 0) {return 0;} else {return $retcode;}';
			break;
		}
	
		$code = str_replace('return 0;', $thiscode, $code);
	}
	
	$compare = create_function('$a,$b', $code);
	usort($arrays, $compare);
}

function gettimezone(){
	return date('O');
/*	
	$tmnow = time();
	$tmgmnow = gmmktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
	
	$diff = $tmgmnow-$tmnow;
	
	if ($diff >= 0 )
		$flag = '+';
	else
		$flag = '-';
	
	$diff = abs($diff);
	$hh = intval($diff/3600);
	$mm = intval(($diff-($hh*3600))/60);
	
	return sprintf("%s%02d%02d", $flag, $hh, $mm);
*/
}

function getlanguagetext($langfile, $tagname = ''){
	global $default_char_set;
	
	$intagspace = false;
	
	$lg = file($langfile);
	
	while(list($line, $value) = each($lg)) {
		if (empty($tagname)){
			if($value[0] == "[") 
				break;
			
			if(strpos(";#", $value[0]) === false 
				&& ($pos = strpos($value, "=")) != 0 
				&& trim($value) != "") {
				$varname  = trim(substr($value, 0, $pos));
				$varvalue = trim(substr($value, $pos+1));
				
			    $varvalue = mb_convert_encoding($varvalue, 'utf-8', $default_char_set);
				//$varvalue = iconv($default_char_set, 'utf-8', $varvalue);
				
				$GLOBALS[$varname] = $varvalue;
			}
		}
		else{
			if ($value[0] == "["){
				if ($intagspace)
					break;
					
				if(trim($value) == '['.$tagname.']') 
					$intagspace = true;
				else
					$intagspace = false;
			}
			
			if ($intagspace){
				if(strpos(";#", $value[0]) === false
					&& ($pos = strpos($value, "=")) != 0
					&& trim($value) != "") {
					$varname  = trim(substr($value, 0, $pos));
					$varvalue = trim(substr($value, $pos+1));
					
			    	$varvalue = mb_convert_encoding($varvalue, 'utf-8', $default_char_set);
					//$varvalue = iconv($default_char_set, 'utf-8', $varvalue);
					
					$GLOBALS[$varname] = $varvalue;
				}
			}
		}
	}
}

function formatcharset($charset){
	$charset = strtolower($charset);
	$newcharset = $charset;
	
	switch ($charset){
	case 'ks_c_5601-1987':
	case 'ks_c_5601_1987':
	case 'ks_c_5601':
		$newcharset = 'euc-kr';
		break;
	case 'gb':
	case 'gb2312':
		$newcharset = 'gbk';
		break;
	default:
		break;
	}
	
	return $newcharset;
}

function to_utf8($value, $charset){
	if (is_array($value)){
		while (list($key, $val) = each($value)) {
		    if (is_array($val)){
		    	$value[$key] = to_utf8($val, $charset);
		    }
			else if (is_string($val)){
		    	$value[$key] = mb_convert_encoding($val, 'utf-8', $charset);
//		    	$value[$key] = iconv($charset, 'utf-8', $val);
		    }
		}
	}
	else if (is_string($value)){
		if($charset == 'gb18030') $charset = "gbk";
    	$value = mb_convert_encoding($value, 'utf-8', $charset);
//    	$value = iconv($charset, 'utf-8', $value);
	}

	return $value;
}

function utf8_to($value, $charset){
	if (is_array($value)){
		while (list($key, $val) = each($value)) {
		    if (is_array($val)){
		    	$value[$key] = utf8_to($val, $charset);
		    }
			else if (is_string($val)){
		    	$value[$key] = mb_convert_encoding($val, $charset, 'utf-8');
//		    	$value[$key] = iconv('utf-8', $charset, $val);
		    }
		}
	}
	else if (is_string($value)){
    	$value = mb_convert_encoding($value, $charset, 'utf-8');
//    	$value = iconv('utf-8', $charset, $value);
	}

	return $value;
}

function convert($value, $toutf8 = true, $charset = ''){
	global $default_char_set;
	
	if (empty($value))
		return $value;
	
	if (empty($charset))
		$charset = $default_char_set;
		
	$charset = formatcharset($charset);
	
	if ($toutf8)	
		return to_utf8($value, $charset);
	else
		return utf8_to($value, $charset);
}

?>