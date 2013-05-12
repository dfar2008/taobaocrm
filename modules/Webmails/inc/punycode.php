<?php
require_once("modules/Webmails/inc/class.punycode.php");

function decode_punycode_item($name, $useutf8 = true)
{
	if (substr($name, 0, 4) == "xn--") {
		$punycode = new Punycode;
		$name = $punycode->decode($name);
		
		if (!$useutf8)
			$name = decode_utf8($name);
	}
		
	return $name;
}

function encode_punycode_item($name, $useutf8 = true)
{
	if (substr($name, 0, 4) != "xn--") {
		if (!$useutf8)
			$name = encode_utf8($name);
		
		$punycode = new Punycode;
		$name = $punycode->encode($name);
	}
		
	return $name;
}

function decode_punycode_domain($domain, $useutf8 = true)
{
	$domainitem = explode(".", $domain);
	$icount = count($domainitem);
	for ($i = 0; $i < $icount; $i++){
		$domainitem[$i] = decode_punycode_item($domainitem[$i], $useutf8);
	}
	
	return implode(".", $domainitem);
}

function encode_punycode_domain($domain, $useutf8 = true)
{
	$domainitem = explode(".", $domain);
	$icount = count($domainitem);
	for ($i = 0; $i < $icount; $i++){
		$domainitem[$i] = encode_punycode_item($domainitem[$i], $useutf8);
	}

	return implode(".", $domainitem);
}

function decode_punycode_mail($mail, $useutf8 = true)
{
	$iPos = strpos($mail, "@");
	
	if($iPos !== false){
	    $mailbox = substr($mail, 0, $iPos);
	    $domain = substr($mail, $iPos+1);
	    
	    return $mailbox.'@'.decode_punycode_domain($domain, $useutf8);
	}
	else{
		return $mail;
	}
}

function encode_punycode_mail($mail, $useutf8 = true)
{
	$iPos = strrpos($mail, "@");
	
	if($iPos !== false){
	    $mailbox = substr($mail, 0, $iPos);
	    $domain = substr($mail, $iPos+1);
	    
	    return $mailbox.'@'.encode_punycode_domain($domain, $useutf8);
	}
	else{
		return $mail;
	}
}

?>