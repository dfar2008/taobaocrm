<?php
require_once("modules/Webmails/inc/utf.php");
require_once("modules/Webmails/inc/ldaplib.php");
require_once("modules/Webmails/inc/commonlib.php");
require_once("modules/Webmails/inc/punycode.php");
require_once("modules/Webmails/inc/userlib.php");
require_once("modules/Webmails/inc/lib.lastvisit.php");

////////////////////////////////////////////////
function get_usage_graphic($used,$aval) {
	$max_graph_size = 200;
	
	if($used >= $aval) {
		$usedsize = $max_graph_size;
		$graph = "<img src=images/used.gif border=0 height=10 width=$usedsize>";
		$usedrate = "100%";
	} 
	elseif($used == 0) {
		$availsize = $max_graph_size;
		$graph = "<img src=images/avail.gif border=0 height=10 width=$availsize>";
		$usedrate = "0%";
	} 
	else  {
		$usedperc = $used*$max_graph_size/$aval;
		$usedsize = ceil($usedperc);
		$availsize = ceil($max_graph_size-$usedsize);
		
		$usedgraph = "<img src=images/used.gif border=0 height=10 width=$usedsize>";
		$availgraph = "<img src=images/avail.gif border=0 height=10 width=$availsize>";

		$graph = $usedgraph.$availgraph;
		$usedrate = round($used/$aval*100).'%';
	}
	
	return $graph.'&nbsp;'.$usedrate;
}

function load_alldomain(){
	global $domain_config_file;
	global $xml_database_comname;
	global $allow_register;
	
	$allow_register = false;
	
	$filename = encode_utf8($domain_config_file);
	
	$alldomains = array();
    $xml = simplexml_load_file($filename);
	foreach($xml->domain->item as $item) {
		$domain = array();
		foreach($item as $key=>$value)
		{
			$key = (string)$key;
			$value = (string)$value;
			switch($key){
					case "domain":
						$domain["domain"] = $value;
						$domain["dispdomain"] = decode_punycode_domain($value, true);
						break;
					case "type":
						$domain["type"] = $value;
						break;
					case "allowregister":
						if ($value == 1)
							$allow_register = 1;
					default:
						$domain[$key] = $value;
						break;
			}
		}
		$alldomains[] = $domain;
		unset($domain);
	}
	return $alldomains;
}

function load_prefs() {
	global 	$userfolder;
	global	$default_preferences;
	global	$userinfo_config_file;
	global 	$xml_database_comname;
	global  $session_value;
	
	extract($default_preferences);
	
	if (empty($session_value["fullname"])){
		$iPos = strpos($session_value["user"], '@');
		if ($iPos !== false)
			$prefs["realname"] = substr($session_value["user"], 0, $iPos);
		else
			$prefs["realname"] = $session_value["user"];
	}
	else{
		$prefs["realname"] = $session_value["fullname"];
	}
	
	$prefs["replyto"] = $session_value["email"];
	$prefs["savetotrash"] = $send_to_trash_default;
	$prefs["emptytrash"] = $empty_trash_default;
	$prefs["savetosent"] = $save_to_sent_default;
	$prefs["recodeperpage"] = $rpp_default;
	$prefs["displayimages"] = $display_images_deafult;
	$prefs["editormode"] = $editor_mode_default;
	$prefs["autosavedraft"] = $autosavedraft_default;
	$prefs["autosavetimespan"] = intval($autosave_timespan_default) * 60;
	$prefs["defaultpage"] = $login_defaultpage_default;
	$prefs["displaypubboard"] = $display_pubboard_default;
	$prefs["displayoptions"] = $display_options_default;
	$prefs["displayaddress"] = $display_address_default;

	$pref_file = $userfolder.$userinfo_config_file;
	if (!file_exists($pref_file)) 
		return $prefs;
	$pref_file = encode_utf8($pref_file);
	$xml = simplexml_load_file($pref_file);
	foreach($xml->preference as $item) {
		foreach($item as $key=>$value)
		{
			$key = (string)$key;
			$value = (string)$value;
			$prefs[strtolower($key)] = $value;			
		}
	}

	return $prefs;
}

function have_external_pop3() {
	global 	$userfolder;
	global	$userinfo_config_file;
	global 	$xml_database_comname;
	
	$pref_file = $userfolder.$userinfo_config_file;
	if (!file_exists($pref_file)) 
		return;
	$pref_file = encode_utf8($pref_file);
	$xml = simplexml_load_file($pref_file);
	if (isset($xml->pop3mail) && $xml->pop3mail){
		if(isset($xml->pop3mail->item) && $xml->pop3mail->item)
			return true;
	}	
	return false;
}




//load init config
function load_initconfig() {
	//$config1 = load_system_config();
	//$config2 = load_service_config();
	//$config3 = load_license_config();
	
	//return array_merge($config1, $config2, $config3);
	return array();
}

function check_user($user, $pass, $domain, &$userinfo, &$lastvisit) {
    global $pop3_server;
	global $mail_servers;
	global $pop3_port;
	if(is_array($mail_servers) && isset($mail_servers[$domain])) {
		$pop3_server = $mail_servers[$domain]['pop3_server'];
		$pop3_port = $mail_servers[$domain]['pop3_port'];		
	}
	require("inc/class.pop3.php");
	$pop3Client = new POP3Mail;
	$pop3Client->hostname = $pop3_server;
	$pop3Client->port = $pop3_port;
	$apop = 0;
	if(($error = $pop3Client->Open()) == ""){
		if(($error = $pop3Client->Login($user, $pass, $apop)) == ""){
				return 0;
		} else {
			return 1;
		}
	} else {
		return 1;
	}
	return 0;	
}


function save_file($fname, $fcontent) {
	if($fname == "") 
		return false;
	
	$fp = fopen($fname, "w");
	if ($fp) {
		fwrite($fp, $fcontent);
		fclose($fp);
		
		return true;
	}
	else
		return false;
}


function create_userinfo_file($fname) {	
	$strContent = "";
	$strContent .= "<item>";
	$strContent .= "<username></username>";
	$strContent .= "<password></password>";
	$strContent .= "<host></host>";
	$strContent .= "<port></port>";
	$strContent .= "<name></name>";
	$strContent .= "<email></email>";
	$strContent .= "<mailfolder>INBOX</mailfolder>";
	$strContent .= "<enable>1</enable>";
	$strContent .= "<savecopy>1</savecopy>";
	$strContent .= "<lasterror>0</lasterror>";
	$strContent .= "<messageid></messageid>";
	$strContent .= "</item>";
	$strContent = '<?xml version="1.0" standalone="yes"?><database><charset>utf-8</charset><pop3mail>'.$strContent.'</pop3mail><expressaddress></expressaddress><preference></preference><filter></filter><addressbook></addressbook><addressgroup></addressgroup><signature></signature></database>';	
	//touch($fname);
	$flag = save_file($fname, $strContent);
	unset($strContent);
	return $flag;
}

function read_file($fname) {
	if($fname == "" || !file_exists($fname)) 
		return false;
	
	$size = filesize($fname); 
	$fp = fopen($fname, "r");
	if ($fp) {
		$content = fread($fp, $size);
		fclose($fp);
		
		return $content;
	}
	else
		return false;
}

//csubstr()ï¿½ï¿½ï¿½ï¿½ï¿½Ö·ï¿½ï¿½È¡ï¿½ï¿½ï¿½ï¿?(ï¿½Þ°ï¿½ï¿½ï¿½ï¿?) 
function csubstr($str, $start, $len) { 
	$leftchar = 0;
	
	for($i = 0; $i <= $start*2; $i++) { 
		if(ord(substr($str, $i, 1)) >= 0x80) 
			$i++;
		$leftchar++;
		
		if ($leftchar >= $start)
			break;
	}
	
	if ($start == 0) 
		$i = -1;
		
	$charcounter = 0;
	for($j = 0; $j < $len*2; $j++) { 
		if(ord(substr($str, $j+$i+1, 1)) >= 0x80) 
			$j++;
			
		$charcounter++;
		if ($charcounter >= $len)
			break;
	}
	
	return substr($str,$i+1,$j+1); 
} 

function B64_EncodeApp($strText) {
	return '{BASE64}'.base64_encode($strText);
}

function B64_DecodeApp($strText) {
	$strTag = substr($strText, 0, 8);
	
	if (strtoupper($strTag) == '{BASE64}')
		return base64_decode(substr($strText, 8));
	else
		return $strText;
}

function Crypt_Encode($strText) {
	$strResult = '';
	
	$iLen = strlen($strText);
	for ($i = 0; $i < $iLen; $i++) {
		$ch = ord($strText[$i]);
		$strResult .= chr(($ch & 0x0f) | 0xa0);
		$strResult .= chr((($ch >> 4)& 0x0f) | 0x80);
	}

	return base64_encode($strResult);
}

function Crypt_Decode($strText) {
	$strResult = '';
	
	$strText = base64_decode($strText);
	$iLen = strlen($strText);
	if (($iLen % 2) != 0)
		return '';
		
	for ($i = 0; $i < $iLen; ) {
		$ch = ord($strText[$i]);
		$ch1 = ($ch & 0x0f);
		
		$ch = ord($strText[$i+1]);
		$ch2 = ($ch & 0x0f);
		
		$i = $i+2;
		
		$strResult .= chr($ch1 | ($ch2 << 4));
	}
	
	return $strResult;
}

function FormatFilename($filename) {
	$filename = str_replace("\\", "_", $filename);
	$filename = str_replace("/", "_", $filename);
	$filename = str_replace("|", "_", $filename);
	$filename = str_replace("<", "_", $filename);
	$filename = str_replace(">", "_", $filename);
	$filename = str_replace(":", "_", $filename);
	$filename = str_replace("*", "_", $filename);
	$filename = str_replace("?", "_", $filename);
	$filename = str_replace("\"", "_", $filename);
	
	return $filename;
}

function EncodeFilename($filename) {
	$ipos = strrpos($filename, '.');
	if ($ipos === false){
		$preffix = $filename;
		$suffix = "";
	}
	else {
		$preffix = substr($filename, 0, $ipos);
		$suffix	= substr($filename, $ipos);
	} 
	
	$newfilename = base64_encode(substr($preffix, 0, 120)).$suffix;
	$newfilename = str_replace("/", "_", $newfilename);
	
	return $newfilename;
}

function sum_decode($str){
	$sum = unserialize($str); 
	
	$out = "";
	for($i = 0; $i < count($sum); $i++) 
		$out .= chr($sum[$i]);
	
	return $out;
}

function addEmailContact($lastname,$email) {
	global $adb;
	global $current_user;
	include_once("modules/Contacts/Contacts.php");
	$query = "SELECT contactid FROM ec_contactdetails WHERE deleted=0 and (email ='".$email."' or otheremail='".$email."' or yahooid='".$email."' or msn='".$email."')";		
	$result = $adb->query($query);
	if($adb->num_rows($result) == 0) {
		$focus = new Contacts();
		if (empty($lastname)){
			$iPos = strpos($email, '@');
			$lastname = substr($email, 0, $iPos);
		}
		$focus->column_fields['lastname'] = $lastname;
		$focus->column_fields['email'] = $email;
		$focus->column_fields['assigned_user_id'] = $current_user->id;
		$focus->save("Contacts");
		unset($focus);
	}
}

function get_localname($msgid,$folder,$userid='') {
	global $adb;
	//global $log;
	global $current_user;
	$query = "SELECT localname,userid FROM ec_webmails WHERE  deleted=0 and msgid='".$msgid."' and folder='".$folder."'";		
	$result = $adb->query($query);
	//$log->info("get_localname query:".$query);
	$localname = "";
	if($adb->num_rows($result) > 0) {
		$localname = $adb->query_result($result,0,"localname");
		$user_id = $adb->query_result($result,0,"userid");
		$userfolder = get_userfolder($user_id);
		$localname = $userfolder.$folder."/".$localname;
	}
	return $localname;
}

function get_userfolder($userid) {
	$key = "get_userfolder_".$userid;
	$userfolder = getSqlCacheData($key);
	if(!$userfolder) {
		global $adb,$mailstore_directory;
		//global $log;
		$userfolder = "";
		$current_username = getUserName($userid);
		if($current_username == "") return $mailstore_directory;
		require_once("include/utils/ChineseSpellUtils.php");
		$spell = new ChineseSpell();
		$length = str_len($current_username);
		$current_username = iconv_ec("UTF-8","GBK",$current_username);
		$current_username = $spell->getFullSpell($current_username,"");
		$current_username = strtolower($current_username);
		$userfolder = $mailstore_directory.$current_username."/";
		setSqlCacheData($key,$userfolder);
	}
	return $userfolder;
}

function build_regex($strSearch) {
	$strSearch = trim($strSearch);
	if($strSearch != "") {
		$strSearch = quotemeta($strSearch);
		$arSearch = split(" ",$strSearch);
		unset($strSearch);
		for($n = 0; $n < count($arSearch); $n++)
			if($strSearch != "") 
				$strSearch .= "|(".$arSearch[$n].")";
			else 
				$strSearch .= "(".$arSearch[$n].")";
	}
	
	return $strSearch;
}


?>