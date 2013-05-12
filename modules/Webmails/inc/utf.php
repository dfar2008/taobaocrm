<?php
if(!defined("_UTF")){
   define("_UTF", 1, 1);

if(function_exists('mb_detect_encoding')) 
	define('MB_STRING', 1); 
else 
	define('MB_STRING', 0); 

function decode_utf7($utf, $ori = false)
{
	if (MB_STRING) {
		global $default_char_set;
		
		if ($ori)
			return mb_convert_encoding($utf, $default_char_set, 'UTF7');
		else
			return mb_convert_encoding($utf, $default_char_set, 'UTF7-IMAP');
	}
	return $utf;
}

function encode_utf7($text, $ori = false)
{
	if (MB_STRING) {
		global $default_char_set;
	
		if ($ori)
			return mb_convert_encoding($text, 'UTF7', $default_char_set);
		else
			return mb_convert_encoding($text, 'UTF7-IMAP', $default_char_set);
	}
	return $text;
	
}

function encode_utf8($text)
{
	if (MB_STRING) {
		global $default_char_set;
	
		return mb_convert_encoding($text, 'UTF8', $default_char_set);
	}
	return $text;
}

function decode_utf8($utf)
{
	$bUtf8 = true;
	if (MB_STRING)
		$bUtf8 = (strcasecmp(mb_detect_encoding($utf), "utf-8") == 0) ? true : false;
	
	if ($bUtf8){
		if (MB_STRING) {
			global $default_char_set;		
			return mb_convert_encoding($utf, $default_char_set, 'UTF8');
		}
	}
	else {
		return $utf;
	}
}

}
?>