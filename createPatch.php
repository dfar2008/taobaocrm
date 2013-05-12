<?php
/*
step1:read file 
step2:check whether the line contains "Index:"
step3:parse substring of the line after Index
step4:create folders which does not exist
step5:copy source file to folder created now
step6:close file
*/
$patchFile = "0520.diff";
$path = "D:/CRMONE/home/localhaote/";//
//$path = "E:/release/bin/ecustomer350/www";
$appName = "C3CRM3.0";
$fd = fopen($patchFile,'r');
while(!feof($fd)) {
	$line = trim(fgets($fd));
	if(substr_count($line,"Index:") > 0) {
		$line = trim(substr($line,strpos($line,"Index:") + 6));
		$filePath = $line;
		//$pos = strpos($line,$appName) + strlen($appName) + 1;
		//$filePath = substr($line,$pos);
		//$patchPath = substr($line,0,$pos);
		$patchPath = $path."/patch";
		if(!is_dir($patchPath)) {
			if(!mkdir($patchPath)){
				echo "patchPath:".$patchPath."<br>";
			}
			
		}
		$folderArray = explode("/",$filePath);
		$length = count($folderArray);

		$i = 0;
		foreach ($folderArray as $folder) {			
			$patchPath .= "/".$folder;
			$i ++;
			if($i == $length) break;
			if(!is_dir($patchPath)) {
				if(!mkdir($patchPath)){
					echo "patchPath:".$patchPath."<br>";
				}
			}
			
		}
		if(is_file($path."/".$line) && copy($path."/".$line,$patchPath)) {
			echo 'copy successfully!<br>';
		} else {
			echo 'copy failed!<br>';
		}
		

	}
}

?>