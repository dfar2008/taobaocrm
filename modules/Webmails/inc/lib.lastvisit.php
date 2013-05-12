<?php
function updateLastVisit($userid, $action, &$lastvisit){
	if ($userid == '')
		return;
		
	global $xml_database_comname;
	global $mailstore_directory;
	global $lastvisit_config_file;
	global $_SERVER;
	
	$userfolder = $mailstore_directory.strtolower($userid)."/";
	$lastvisitfile = $userfolder.$lastvisit_config_file;
	$lastvisitfile = encode_utf8($lastvisitfile);

	$xml = new COM($xml_database_comname, NULL, CP_UTF8) or die ("create com instance error");
	$xml->ReadDB($lastvisitfile);
	$xml->ResetPos();
		
	if (!$xml->FindElem("database")) {
		$xml->AddElem("database", "");
		$xml->IntoElem();
		$xml->AddElem("lastvisit", "");
	}
	else {
		$xml->IntoElem();
		if (!$xml->FindElem("lastvisit"))
			$xml->AddElem("lastvisit", "");
	}

	$timestamp = time();
	$visitip = $_SERVER['REMOTE_ADDR'];
	
	$lastvisit = array();
	$pop3 = 0;
	$imap = 0;
	$webmail = 0; 
	$xml->IntoElem();
	while($xml->FindElem("item")) {
		$xml->ResetChildPos();
		if ($xml->FindChildElem("timestamp")) {
			$value = $xml->GetChildData();
			
			if ($timestamp - $value > 7*24*3600)  //> 7 days
				$xml->RemoveElem();
		}

		$info = array();
		
		$xml->ResetChildPos();
		while($xml->FindChildElem(""))  {
			$name = $xml->GetChildTagName();
			$value = $xml->GetChildData();
			
			$info[strtolower($name)] = $value;
		}
		
		if (strcasecmp($info['type'], 'pop3') == 0) {
			$pop3++;
		}
		else if (strcasecmp($info['type'], 'imap') == 0) {
			$imap++;
		}
		else if (strcasecmp($info['type'], 'webmail') == 0){
			$webmail++;
			
			if ($info['timestamp'] > $result['timestamp'])
				$lastvisit = $info;
		}
	}
	
	$lastvisit['pop3'] = $pop3;
	$lastvisit['imap'] = $imap;
	$lastvisit['webmail'] = $webmail;
	
	$xml->AddElem("item", "");
	$xml->AddChildElem("timestamp", $timestamp);
	$xml->AddChildElem("visitip", $visitip);
	$xml->AddChildElem("action", $action);
	$xml->AddChildElem("type", "webmail");

	return $xml->WriteDB($lastvisitfile);
}

function listLastVisit(){
	global $xml_database_comname;
	global $userfolder;
	global $lastvisit_config_file;
	
	$lastvisitfile = $userfolder.$lastvisit_config_file;
	$lastvisitfile = encode_utf8($lastvisitfile);

	$xml = new COM($xml_database_comname, NULL, CP_UTF8) or die ("create com instance error");
	$xml->ReadDB($lastvisitfile);
	$xml->ResetPos();
		
	if (!$xml->FindElem("database"))
		return false;
		
	$xml->IntoElem();
	if (!$xml->FindElem("lastvisit"))
		return false;

	$lastvisit = array();
	while($xml->FindElem("item")) {
		$info = array();
		
		$xml->ResetChildPos();
		while($xml->FindChildElem(""))  {
			$name = $xml->GetChildTagName();
			$value = $xml->GetChildData();
			
			$info[strtolower($name)] = $value;
		}
		
		$lastvisit[] = $info;
	}
	
	return true;
}
?>