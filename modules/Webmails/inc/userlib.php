<?php

//获取用户信息 返回$userinfo 数组
function getUserInfo($strEmail)
{
	global	$userauth_config_file;
	global 	$xml_database_comname;
	global 	$primary_domain;
	
	if (!file_exists($userauth_config_file)) 
		return false;
	$filename = encode_utf8($userauth_config_file);
	
	$userinfo = array();
	$xml = simplexml_load_file($filename);
	$i = 0;
	foreach($xml->user->item as $item) {

		$strUser = $xml->user->item[$i]->name;
		$strDomain = $xml->user->item[$i]->domain;
		if (!empty($strDomain) && $strDomain != "") {
			$strUser = $strUser.'@'.$strDomain;
		}
		if (strcasecmp($strUser, $strEmail) == 0) {
			foreach($item as $key=>$value)
			{
				$key = (string)$key;
				$value = (string)$value;
				$userinfo[strtolower($key)] = $value;
			}
			return $userinfo;
		}
		
		$i ++;
	}
	
	return false;
}

// 根据$userinfo数组修改帐号 返回值是布尔量 TRUE:成功 False:失败
function modifyUserInfo($userinfo)
{
	global	$userauth_config_file;
	global 	$xml_database_comname;

	if (!file_exists($userauth_config_file)) 
		return false;
	$filename = encode_utf8($userauth_config_file);
	
	$xml = simplexml_load_file($filename);
	$i = 0;
	foreach($xml->user->item as $item) {
		$strUser = $xml->user->item[$i]->name;
		$strDomain = $xml->user->item[$i]->domain;
		if (!empty($strDomain) && $strDomain != "") {
			$strUser = $strUser.'@'.$strDomain;
		}
		if (strcasecmp($strUser, $userinfo['user']) == 0) {
			foreach($item as $key=>$value)
			{
				$key = (string)$key;
				$value = (string)$value;
				$xml->user->item[$i]->$key = $userinfo[strtolower($key)];
			}
		}		
		$i ++;
	}
	$strContent = htmlspecialchars_decode($xml->asXML());
	$flag = save_file($filename,$strContent);
	unset($strContent);	
	return $flag;
}

function getPrimaryDomain()
{
	global $domain_config_file;
	global $xml_database_comname;
	
	if (!file_exists($domain_config_file)) 
		return "";
	$filename = encode_utf8($domain_config_file);
	$xml = simplexml_load_file($filename);
	$strDomain = "";
	$iDomainType = 0;
	foreach($xml->domain->item as $item) {
		$domain = array();
		foreach($item as $key=>$value)
		{
			$key = (string)$key;
			$value = (string)$value;
			switch(strtolower($key)){
				case "domain":
					$strDomain = strtolower($value);
					break;
				case "type":
					$iDomainType = intval($value);
					break;
			}
			
			if ($iDomainType == 1)
				return $strDomain;
		}
	}
	
	return "";
}

function convertList($arrList, $strDomain)
{
	$arrResult = array();
	$iSize = count($arrList);
	
	$allUser = load_alluser();
	$iUserCount = count($allUser);
	
	$k = 0;
	for ($i = 0; $i < $iSize; $i++){
		
		if(empty($arrList[$i]))
			continue;
		
		$pos = strpos($arrList[$i], "@");
		
		if ($pos === false){
			$member['name'] = $arrList[$i];
			$member['mail'] = $arrList[$i]."@".$strDomain;
		}
		else{
			$member['name'] = substr($arrList[$i], 0, $pos);
			$member['mail'] = $arrList[$i];
		}
		
		for ($j = 0; $j < $iUserCount; $j++){
			$uid = $allUser[$j]['name'];
			if (!empty($allUser[$j]['domain'])
				&& $allUser[$j]['domain'] != $strDomain){
				$uid .= '@';
				$uid .= $allUser[$j]['domain'];
			}

			if ($arrList[$i] == $uid && !empty($allUser[$j]['fullname'])){
				$member['name'] = $allUser[$j]['fullname'];
				break;
			}
		}
		
		$arrResult[$k] = $member;
		
		$k++;
	}
	
	return $arrResult;
}

////////////////////////////////////////////////
// 取得用户有权限发信的组列表 以数组形式返回
////////////////////////////////////////////////
function getGroupList($uidmail)
{
	global	$mailgroup_config_file;
	global 	$xml_database_comname;
	
	if (!file_exists($mailgroup_config_file)) 
		return false;
	$filename = encode_utf8($mailgroup_config_file);
	
	$uidmail = strtolower(trim($uidmail));
	$glist = array();
	
	$primary_domain = getPrimaryDomain();
	
	$xml = new COM($xml_database_comname, NULL, CP_UTF8) or die ("create com instance error");
	$xml->ReadDB($filename);
	$xml->ResetPos();
		
	$xml->FindElem("database");
	$xml->IntoElem();

	$userdomain = strstr($uidmail, '@');
	if ($userdomain !== false)
		$userdomain = substr($userdomain, 1);
	else
		$userdomain = "";

	if ($xml->FindElem("group"))	{
		$xml->IntoElem();
		
		$i = 0;
		while($xml->FindElem("item")) {
			//初始化变量
			$name = "";
			$domain = "";
			$description = "";
			$memberlist = "";
			$mailright = 0;
			$sendmailmemberlist = "";
			$managerlist = "";
			$visibleright = 0;
			$sendervisible = 0;
			$gid = "";
			
			$xml->ResetChildPos();	
			while($xml->FindChildElem(""))	{
				$strTagName = $xml->GetChildTagName();
				$strTagValue = $xml->GetChildData();
					
				switch(strtolower($strTagName))	{
					case 'name':
						$name = strtolower($strTagValue);
						break;
					case 'domain':
						$domain = $strTagValue;						
						break;
					case 'description':		
						$description = $strTagValue;					
						break;
					case 'memberlist':		
						$memberlist = strtolower($strTagValue);					
						break;
					case 'sendmailright':
						$mailright = $strTagValue;
						break;
					case 'sendmailmember':
						$sendmailmemberlist = strtolower($strTagValue);
						break;				
					case 'managerlist':
						$managerlist = strtolower($strTagValue);
						break;				
					case 'visibleright':
						$visibleright = $strTagValue;
						break;
					case 'sendervisible':
						$sendervisible = $strTagValue;
						break;
				}
			}

			/////////////////////////////////
			// 数据转换 非主域的添加上域名
			/////////////////////////////////
			if($domain == "")
				$gid = $name."@".$primary_domain;
			else
				$gid = $name."@".$domain;
			
			$manager = 0;
			$sendmail = 0;
				
			$arrManagerList = explode(";", $managerlist);
			if(in_array($uidmail, $arrManagerList))	{
				$manager = 1;
			}
			
			if($mailright == 0)	{
				$sendmail = 1;
			}
			else if($mailright == 1){
				$arrList = explode(";", $memberlist);
				
				if(in_array($uidmail, $arrList))
					$sendmail = 1;
			}
			else if($mailright == 2){
				$arrList = explode(";", $sendmailmemberlist);
				
				if(in_array($uidmail, $arrList))
					$sendmail = 1;
			}
			
			if ($manager == 0){
				$listmember = false;
				$display = false;
				if ($visibleright == 0 || $visibleright == 1) {
					if ($visibleright == 0)
						$listmember = true;
					else
						$listmember = false;
						
					$display = true;
				}
				else if ($visibleright == 2 || $visibleright == 3) {
					if ($visibleright == 2)
						$listmember = true;
					else
						$listmember = false;

					if (strcasecmp($domain, $userdomain) == 0){
						$display = true;
					}
				}
				else if ($visibleright == 4 || $visibleright == 5) {
					if ($visibleright == 4)
						$listmember = true;
					else
						$listmember = false;

					$arrList = explode(";", $memberlist);
					
					if(in_array($uidmail, $arrList))
						$display = true;
				}
			}
			else {
				$listmember = true;
				$display = true;
			}

			if ($sendervisible == 1 && $sendmail == 1)
				$display = true;
			
			if ($display){
				$glist[$i]["gid"] = $gid;
				
				$glist[$i]["description"]= $description;
				$glist[$i]["memberlist"]= $memberlist;
				$glist[$i]["manager"]= $manager;
				$glist[$i]["sendmail"]= $sendmail;
				$glist[$i]["listmember"]= $listmember;
				
				$i++;
			}
		}
	}

	return $glist;
}

///////////////////////////////////////////////////
// 获取给定组的所有成员，给出的是一个 邮件地址数组
//////////////////////////////////////////////////
function getGroupMemberList($groupid)
{
	global	$mailgroup_config_file;
	global 	$xml_database_comname;
	
	if (!file_exists($mailgroup_config_file)) 
		return false;
	$filename = encode_utf8($mailgroup_config_file);
	
	$primary_domain = getPrimaryDomain();

	$groupid = strtolower(trim($groupid));
	
	$xml = new COM($xml_database_comname, NULL, CP_UTF8) or die ("create com instance error");
	$xml->ReadDB($filename);
	$xml->ResetPos();
		
	$xml->FindElem("database");
	$xml->IntoElem();

	if ($xml->FindElem("group")){
		$xml->IntoElem();
		
		$i = 0;
		while($xml->FindElem("item")) {
			//初始化变量
			$name = "";
			$domain = "";
			$memberlist = "";
			$gid = "";
			
			$xml->ResetChildPos();	
			while($xml->FindChildElem("")) {
				$strTagName = $xml->GetChildTagName();
				$strTagValue = $xml->GetChildData();
					
				switch(strtolower($strTagName))	{
					case 'name':
						$name = strtolower($strTagValue);
						break;
					case 'domain':
						$domain = $strTagValue;						
						break;
					case 'memberlist':		
						$memberlist = strtolower($strTagValue);					
						break;
				}
			}

			if($domain == "")
				$gid = $name."@".$primary_domain;
			else
				$gid = $name."@".$domain;
			
			if($groupid == $gid){
				$arrMemberList = explode(";", $memberlist);
				return convertList($arrMemberList, $primary_domain);
			}
		}
	}

	return false;
}

function getGroupInfo_mail($strGroupID)
{
	global	$mailgroup_config_file;
	global 	$xml_database_comname;
	
	if (!file_exists($mailgroup_config_file)) 
		return false;
	$filename = encode_utf8($mailgroup_config_file);
	
	$groupinfo = array();

	$xml = new COM($xml_database_comname, NULL, CP_UTF8) or die ("create com instance error");
	$xml->ReadDB($filename);
	$xml->ResetPos();
		
	$xml->FindElem("database");
	$xml->IntoElem();

	if ($xml->FindElem("group")){
		$xml->IntoElem();
			
		while($xml->FindElem("item")) {
			$strGroup = "";
			$strDomain = "";

			$xml->ResetChildPos();
			if ($xml->FindChildElem("name"))
				$strGroup = $xml->GetChildData();
			
			$xml->ResetChildPos();
			if ($xml->FindChildElem("domain"))
				$strDomain = $xml->GetChildData();
				
			if (!empty($strDomain))
				$strGroup = $strGroup.'@'.$strDomain;

			if (strcasecmp($strGroup, $strGroupID) == 0) {
				$xml->ResetChildPos();	
				
				while($xml->FindChildElem("")){
					$strTagName = trim($xml->GetChildTagName());
					$strTagValue = $xml->GetChildData();
					
					$groupinfo[strtolower($strTagName)] = $strTagValue;
				}
				
				return $groupinfo;
			}
		}
	}
	
	return false;
}

function modifyGroupInfo($groupinfo)
{
	global	$mailgroup_config_file;
	global 	$xml_database_comname;
	
	if (!file_exists($mailgroup_config_file)) 
		return false;
	$filename = encode_utf8($mailgroup_config_file);
	
	$xml = new COM($xml_database_comname, NULL, CP_UTF8) or die ("create com instance error");
	$xml->ReadDB($filename);
	$xml->ResetPos();
		
	$xml->FindElem("database");
	$xml->IntoElem();

	if ($xml->FindElem("group")){
		$xml->IntoElem();
	
		while($xml->FindElem("item")) {
			$strGroup = "";
			$strDomain = "";
			
			$xml->ResetChildPos();
			if ($xml->FindChildElem("name"))
				$strGroup = $xml->GetChildData();
			
			$xml->ResetChildPos();
			if ($xml->FindChildElem("domain"))
				$strDomain = $xml->GetChildData();

			if (!empty($strDomain))
				$strGroup = $strGroup.'@'.$strDomain;

			if (strcasecmp($strGroup, $groupinfo['uid']) == 0) {
				$xml->ResetChildPos();

				while($xml->FindChildElem("")) {
					$strTagName = strtolower($xml->GetChildTagName());

					if (strcmp($strTagName, "description") == 0){
						$xml->SetChildData($groupinfo['description']);
					}
					else if (strcmp($strTagName, "memberlist") == 0){
						$xml->SetChildData($groupinfo['memberlist']);
					}
					else if (strcmp($strTagName, "sendmailright") == 0)	{
						$xml->SetChildData($groupinfo['sendmailright']);
					}
					else if (strcmp($strTagName, "sendmailmember") == 0){
						$xml->SetChildData($groupinfo['sendmailmember']);
					}
					else if (strcmp($strTagName, "managerlist") == 0){
						$xml->SetChildData($groupinfo['managerlist']);
					}
					else if (strcmp($strTagName, "visibleright") == 0)	{
						$xml->SetChildData($groupinfo['visibleright']);
					}
				}
				
				$xml->ResetChildPos();
				if (!$xml->FindChildElem("managerlist"))
					$xml->AddChildElem("managerlist", $groupinfo['managerlist']);
				
				$xml->ResetChildPos();
				if (!$xml->FindChildElem("visibleright"))
					$xml->AddChildElem("visibleright", $groupinfo['visibleright']);

				return $xml->WriteDB($filename);
			}
		}
	}
	
	return false;
}

function load_alluser()
{
	global	$userauth_config_file;
	global 	$xml_database_comname;
	
	if (!file_exists($userauth_config_file)) 
		return false;
	$filename = encode_utf8($userauth_config_file);
	
	$xml = new COM($xml_database_comname, NULL, CP_UTF8) or die ("create com instance error");
	$xml->ReadDB($filename);
	$xml->ResetPos();
		
	$xml->FindElem("database");
	$xml->IntoElem();

	if ($xml->FindElem("user")){
		$xml->IntoElem();
			
		while($xml->FindElem("item")) {
			unset($userinfo);

			$xml->ResetChildPos();	
			while($xml->FindChildElem("")) {
				$strTagName = strtolower($xml->GetChildTagName());
				$strTagValue = $xml->GetChildData();
				
				$userinfo[$strTagName] = $strTagValue;
				
				if ($strTagName == 'accoutstatus')
					$userinfo['accountstatus'] = $strTagValue;
			}
			
			$userList[] = $userinfo;
		}
	}
	
	return $userList;
}

function getDomainInfo($domain)
{
	global $domain_config_file;
	global $xml_database_comname;
	
	$filename = encode_utf8($domain_config_file);
	/*
	$xml = new COM($xml_database_comname, NULL, CP_UTF8) or die ("create com instance error");
	$xml->ReadDB($filename);
	$xml->ResetPos();
	
	$xml->FindElem("database");
	$xml->IntoElem();

	if ($xml->FindElem("domain")){
		$xml->IntoElem();
	
		while($xml->FindElem("item")) {
			$strDomain = "";
			$iDomainType = 0;
			 
			$xml->ResetChildPos();	
			while($xml->FindChildElem("")) {
				$strTagName = strtolower($xml->GetChildTagName());
				$strTagValue = $xml->GetChildData();
				
				switch($strTagName){
					case "domain":
						$strDomain = $strTagValue;
						break;
					case "type":
						$iDomainType = intval($strTagValue);
						break;
				}
			}
			
			if (strcasecmp($strDomain, $domain) == 0
				|| (empty($domain) && $iDomainType == 1)){
				$domainInfo = array();
				
				$xml->ResetChildPos();	
				while($xml->FindChildElem("")) {
					$strTagName = strtolower($xml->GetChildTagName());
					$strTagValue = $xml->GetChildData();
					
					$domainInfo[$strTagName] = $strTagValue;
					
				}
				
				return $domainInfo;
			}
		}
	}
	*/
	
	$xml = simplexml_load_file($filename);
	foreach($xml->domain->item as $item) {
		$strDomain = "";
		$iDomainType = 0;
		foreach($item as $key=>$value)
		{
			$key = (string)$key;
			$value = (string)$value;
			switch($key){
					case "domain":
						$strDomain = $value;
						break;
					case "type":
						$iDomainType = intval($value);
						break;
			}			
		}
		if (strcasecmp($strDomain, $domain) == 0
				|| (empty($domain) && $iDomainType == 1)){
				$domainInfo = array();				
				foreach($item as $key=>$value) {
					$key = strtolower((string)$key);
					$value = (string)$value;
					$domainInfo[$key] = $value;					
				}
				
				return $domainInfo;
		}

	}
	
	return false;
}
?>