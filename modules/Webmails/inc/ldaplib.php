<?php
//ldap begin
function convertMD5Passwd_b64($passwd) {
	$tmp = substr($passwd, 0 , 5);
	if(strcasecmp($tmp, "{md5}") != 0)
		$passwd = md5($passwd);
	else
		$passwd = substr($passwd, 5);
		
	$tmp = "";
	for($i = 0; $i < 16; $i++)	{
		$str = substr($passwd, 2*$i, 2);
		$k = hexdec( $str );
		$tmp .= chr($k);
	}
	
	$tmp = base64_encode($tmp);	
	$tmp = "{md5}".$tmp;
	return $tmp;
}

function LDAPQueryResult($keyword, $flag = 0) {
	global $ldap_server;
	global $ldap_port;
	global $ldap_base_dn;
	global $ldap_root_dn;
	global $ldap_root_pwd;
	global $session_value;
	
	if (!function_exists('ldap_connect'))
		return false;

	$ln = @ldap_connect($ldap_server, $ldap_port);
	if($ln === false)
		return false;

	if(@ldap_bind($ln, $ldap_root_dn, $ldap_root_pwd) === false){
		ldap_close($ln);
		return false;		
	}

	if($keyword == "")	{
		$filter = "(|(cn=*))";	
	}
	else{
		$keyword = my_substr($keyword, 0, 64); 
		$keyword = str_replace("<", "", $keyword);
		$keyword = str_replace(">", "", $keyword);
		$keyword = str_replace("(", "", $keyword);
		$keyword = str_replace(")", "", $keyword);
	
		if($flag == 1)
			$filter = "(|(cn=$keyword*)(sn=$keyword*)(mail=$keyword*))";	
		else
			$filter = "(|(cn=*$keyword*)(sn=*$keyword*)(mail=*$keyword*))";	
	}
	$justthese = array("cn", "mail", "telephonenumber","sn", "uid");	

	$rs = ldap_search($ln, $ldap_base_dn, $filter, $justthese);
	
	if($rs === false)	{
		$ret = false;
	}
	else {
		$ret = ldap_get_entries($ln, $rs);		
		ldap_free_result($rs);
		
		$iPos = strpos($session_value["user"], '@');
		if ($iPos !== false)
			$userdomain = substr($session_value["user"], $iPos+1);
		else
			$userdomain = "";

		$newret = array();
		$domainlist = load_alldomain();
		$domaincount = count($domainlist);
		for ($n = 0; $n < $ret['count']; $n++) {
			$mail = $ret[$n]["mail"][0];
			$uid = $ret[$n]["mail"][0];
			
			if (substr($uid, 0, 1) == "@"){
				$newret[] = $ret[$n];
				continue;
			}
			
			$iPos = strpos($mail, '@');
			if ($iPos !== false)
				$domain = substr($mail, $iPos+1);
			else
				$domain = "";
			
			$bFound = false;
			for ($i = 0; $i < $domaincount; $i++){
				if (strtolower($domainlist[$i]["domain"]) == strtolower($domain)){
					if ($domainlist[$i]["pubuserinfoaccess"] != 0){
						if (strtolower($domain) == strtolower($userdomain)
							|| (empty($userdomain) && $domainlist[$i]["type"] == 1)){
							$newret[] = $ret[$n];
						}
					}
					else{
						$newret[] = $ret[$n];
					}
					
					$bFound = true;
					
					break;
				}
				
			}
			
			if (!$bFound)
				$newret[] = $ret[$n];
		}
		
		unset($ret);
		$ret = $newret;
		$ret['count'] = count($newret);
	}
	
	ldap_close($ln);
		
	return $ret;
}

function LDAPUserInfo($mail) {
	global $ldap_server;
	global $ldap_port;
	global $ldap_base_dn;
	global $ldap_root_dn;
	global $ldap_root_pwd;
	
	if($mail == "")
		return false;			

	$filter = "(|(uid=$mail))";	
	$justthese = array("cn", "sn", "mail", "homepostaladdress", "homephone", 
		"mobile", "ou", "title", "physicaldeliveryofficename", "telephonenumber");
	
	$ln = @ldap_connect($ldap_server, $ldap_port);
	if($ln === false)
		return false;
	
	if(@ldap_bind($ln, $ldap_root_dn, $ldap_root_pwd) === false ){
		ldap_close($ln);
		
		return false;		
	}		
	
	$rs = ldap_search($ln, $ldap_base_dn, $filter, $justthese);
	
	if($rs === false) {
		$ret = false;
	}
	else {
		$ret = ldap_get_entries($ln, $rs);		
		ldap_free_result($rs);
	}
	
	ldap_close($ln);
		
	return $ret;	
}

function LDAPAddUser($userinfo) {
	global $ldap_server;
	global $ldap_port;
	global $ldap_base_dn;
	global $ldap_root_dn;
	global $ldap_root_pwd;
	
	$uid = "uid=".$userinfo["uid"];
	$dn = $uid.",".$ldap_base_dn;

	$ldapuserinfo["objectclass"][0] = "top";
	$ldapuserinfo["objectclass"][1] = "person";
	$ldapuserinfo["objectclass"][2] = "organizationalPerson";
	$ldapuserinfo["objectclass"][3] = "inetorgperson";
	$ldapuserinfo["objectclass"][4] = "officeperson";
	
	$ldapuserinfo["uid"] = $userinfo["uid"];
	$ldapuserinfo["cn"] = $userinfo["user"];	
	$ldapuserinfo["mail"] = $userinfo["mail"];
	
	if($userinfo["userpassword"] == "")
		$ldapuserinfo["userpassword"] = " ";
	else
		$ldapuserinfo["userpassword"] = convertMD5Passwd_b64($userinfo["userpassword"]);
	
	if ($userinfo["fullname"] == "")
		$ldapuserinfo["sn"] = " ";
	else
		$ldapuserinfo["sn"] = $userinfo["fullname"];

	if ($userinfo["homeaddress"] == "")
		$ldapuserinfo["homepostaladdress"] = " ";
	else
		$ldapuserinfo["homepostaladdress"] = $userinfo["homeaddress"];
	
	if ($userinfo["homephone"] == "")
		$ldapuserinfo["homephone"] = " ";
	else
		$ldapuserinfo["homephone"] = $userinfo["homephone"];
	
	if ($userinfo["mobile"] == "")
		$ldapuserinfo["mobile"] = " ";
	else
		$ldapuserinfo["mobile"] = $userinfo["mobile"];
	
	if ($userinfo["organizationunit"] == "")
		$ldapuserinfo["ou"] = " ";
	else
		$ldapuserinfo["ou"] = $userinfo["organizationunit"];
	
	if ($userinfo["jobtitle"] == "")
		$ldapuserinfo["title"] = " ";
	else
	    $ldapuserinfo["title"] = $userinfo["jobtitle"];
	        
	if ($userinfo["office"] == "")
		$ldapuserinfo["physicaldeliveryofficename"] = " ";
	else
		$ldapuserinfo["physicaldeliveryofficename"] = $userinfo["office"];
	
	if ($userinfo["officephone"] == "")
		$ldapuserinfo["telephonenumber"] = " ";
	else
		$ldapuserinfo["telephonenumber"] = $userinfo["officephone"];
	
	$ln = @ldap_connect($ldap_server, $ldap_port);
	if($ln === false)
		return false;
	
	if(@ldap_bind($ln, $ldap_root_dn, $ldap_root_pwd) === false){		
		ldap_close($ln);

		return false;	
	}
	
	@ldap_delete($ln, $dn);
	$ret = @ldap_add($ln, $dn, $ldapuserinfo);

	ldap_close($ln);
		
	return $ret;
}

function LDAPModifyPass($userinfo) {
	global $ldap_server;
	global $ldap_port;
	global $ldap_base_dn;
	global $ldap_root_pwd;
	global $ldap_root_dn;
	
	$uid = "uid=".$userinfo["uid"];
	$dn = $uid.",".$ldap_base_dn;
	
	//echo "DN:".$dn."&nbsp;";
	$ln = @ldap_connect($ldap_server, $ldap_port);
	if($ln == false)
		return false;
	
	if(@ldap_bind($ln, $ldap_root_dn, $ldap_root_pwd) == false)	{
		ldap_close($ln);

		return false;	
	}
	
	if($userinfo["userpassword"] == "")
		$ldapuserinfo["userpassword"] = " ";
	else
		$ldapuserinfo["userpassword"] = convertMD5Passwd_b64($userinfo["userpassword"]);	
	
	$ret = @ldap_modify($ln, $dn, $ldapuserinfo);
		
	ldap_close($ln);
		
	return $ret;	
}

function LDAPModifyUser($userinfo) {
	global $ldap_server;
	global $ldap_port;
	global $ldap_base_dn;
	global $ldap_root_pwd;
	global $ldap_root_dn;
	
	$uid = "uid=".$userinfo["uid"];
	$dn = $uid.",".$ldap_base_dn;
	
	//echo "DN:".$dn."&nbsp;";
	$ln = @ldap_connect($ldap_server, $ldap_port);
	if($ln == false)
		return false;
	
	if(@ldap_bind($ln, $ldap_root_dn, $ldap_root_pwd) == false)	{
		ldap_close($ln);

		return false;	
	}

	@ldap_delete($ln, $dn);
	
	$ldapuserinfo["objectclass"][0] = "top";
	$ldapuserinfo["objectclass"][1] = "person";
	$ldapuserinfo["objectclass"][2] = "organizationalPerson";
	$ldapuserinfo["objectclass"][3] = "inetorgperson";
	$ldapuserinfo["objectclass"][4] = "officeperson";
	
	$ldapuserinfo["uid"] = $userinfo["uid"];
	$ldapuserinfo["cn"] = $userinfo["user"];	
	$ldapuserinfo["mail"] = $userinfo["mail"];
	
	if($userinfo["userpassword"] == "")
		$ldapuserinfo["userpassword"] = " ";
	else
		$ldapuserinfo["userpassword"] = convertMD5Passwd_b64($userinfo["userpassword"]);
	
	if ($userinfo["fullname"] == "")
		$ldapuserinfo["sn"] = " ";
	else
		$ldapuserinfo["sn"] = $userinfo["fullname"];
	
	if ($userinfo["homeaddress"] == "")
		$ldapuserinfo["homepostaladdress"] = " ";
	else
		$ldapuserinfo["homepostaladdress"] = $userinfo["homeaddress"];
	
	if ($userinfo["homephone"] == "")
		$ldapuserinfo["homephone"] = " ";
	else
		$ldapuserinfo["homephone"] = $userinfo["homephone"];
	
	if ($userinfo["mobile"] == "")
		$ldapuserinfo["mobile"] = " ";
	else
		$ldapuserinfo["mobile"] = $userinfo["mobile"];
	
	if ($userinfo["organizationunit"] == "")
		$ldapuserinfo["ou"] = " ";
	else
		$ldapuserinfo["ou"] = $userinfo["organizationunit"];
	
	if ($userinfo["jobtitle"] == "")
		$ldapuserinfo["title"] = " ";
	else
	    $ldapuserinfo["title"] = $userinfo["jobtitle"];
	        
	if ($userinfo["office"] == "")
		$ldapuserinfo["physicaldeliveryofficename"] = " ";
	else
		$ldapuserinfo["physicaldeliveryofficename"] = $userinfo["office"];
	
	if ($userinfo["officephone"] == "")
		$ldapuserinfo["telephonenumber"] = " ";
	else
		$ldapuserinfo["telephonenumber"] = $userinfo["officephone"];
	
	$ret = @ldap_add($ln, $dn, $ldapuserinfo);
		
	ldap_close($ln);
		
	return $ret;	
}

function LDAPDelUser($userid) {
	global $ldap_server;
	global $ldap_port;
	global $ldap_base_dn;
	global $ldap_root_pwd;
	global $ldap_root_dn;
	
	$uid = "uid=".$userid;
	$dn = $uid.",".$ldap_base_dn;
	
	//echo "DN:".$dn."&nbsp;";
	$ln = @ldap_connect($ldap_server, $ldap_port);
	if($ln === false )
		return false;
	
	if(@ldap_bind($ln, $ldap_root_dn, $ldap_root_pwd) === false )	{
		ldap_close($ln);

		return false;	
	}
	
	$ret = @ldap_delete($ln, $dn);	
	ldap_close($ln);
		
	return $ret;	
}
?>