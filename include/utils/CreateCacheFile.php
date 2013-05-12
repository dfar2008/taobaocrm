<?php
 /**
 * Function to write the tabid and name to a flat file ec_tabdata.txt so that the data
 * is obtained from the file instead of repeated queries
 * returns null
 */

function create_tab_data_file()
{
	global $log;
	$log->debug("Entering create_tab_data_file() method ...");
        $log->info("creating ec_tabdata file");
        global $adb;
        $sql = "select * from ec_tab";
        $result = $adb->query($sql);
        $num_rows=$adb->num_rows($result);
        $result_array=Array();
	$seq_array=Array();
        for($i=0;$i<$num_rows;$i++)
        {
                $tabid=$adb->query_result($result,$i,'tabid');
                $tabname=$adb->query_result($result,$i,'name');
		$presence=$adb->query_result($result,$i,'presence');
                $result_array[$tabname]=$tabid;
		$seq_array[$tabid]=$presence;

        }

	//Constructing the actionname=>actionid array
	$actionid_array=Array();
	$sql1="select * from ec_actionmapping";
	$result1=$adb->query($sql1);
	$num_seq1=$adb->num_rows($result1);
	for($i=0;$i<$num_seq1;$i++)
	{
		$actionname=$adb->query_result($result1,$i,'actionname');
		$actionid=$adb->query_result($result1,$i,'actionid');
		$actionid_array[$actionname]=$actionid;
	}		

	//Constructing the actionid=>actionname array with securitycheck=0
	$actionname_array=Array();
	$sql2="select * from ec_actionmapping where securitycheck=0";
	$result2=$adb->query($sql2);
	$num_seq2=$adb->num_rows($result2);
	for($i=0;$i<$num_seq2;$i++)
	{
		$actionname=$adb->query_result($result2,$i,'actionname');
		$actionid=$adb->query_result($result2,$i,'actionid');
		$actionname_array[$actionid]=$actionname;
	}
	$filename = 'tabdata.php';
        
	
	
if (is_file($filename)) {

        if (is_writable($filename))
        {

                if (!$handle = fopen($filename, 'w+')) {
                        echo "Cannot open file ($filename)";
                        exit;
                }
               

        }
        else
        {
                echo "The file $filename is not writable";
        }

}
else
{
	echo "The file $filename does not exist";
	$log->debug("Exiting create_tab_data_file method ...");
	return;
}
}


 /**
 * Function to write the ec_parenttabid and name to a flat file parent_tabdata.txt so that the data
 * is obtained from the file instead of repeated queries
 * returns null
 */

function create_parenttab_data_file()
{
	global $log;
	$log->debug("Entering create_parenttab_data_file() method ...");
	$log->info("creating parent_tabdata file");
	global $adb;
	$sql = "select parenttabid,parenttab_label from ec_parenttab order by sequence";
	$result = $adb->query($sql);
	$num_rows=$adb->num_rows($result);
	$result_array=Array();
	for($i=0;$i<$num_rows;$i++)
	{
		$parenttabid=$adb->query_result($result,$i,'parenttabid');
		$parenttab_label=$adb->query_result($result,$i,'parenttab_label');
		$result_array[$parenttabid]=$parenttab_label;

	}
	$filename = 'parent_tabdata.php';



	if (is_file($filename)) {

		if (is_writable($filename))
		{

			if (!$handle = fopen($filename, 'w+'))
			{
				echo "Cannot open file ($filename)";
				exit;
			}
			

			$parChildTabRelArray=Array();

			foreach($result_array as $parid=>$parvalue)
			{
				$childArray=Array();
				$sql = "select * from ec_parenttabrel where parenttabid=".$parid." order by sequence";
				$result = $adb->query($sql);
				$num_rows=$adb->num_rows($result);
				$result_array=Array();
				for($i=0;$i<$num_rows;$i++)
				{
					$tabid=$adb->query_result($result,$i,'tabid');
					$childArray[]=$tabid;
				}
				$parChildTabRelArray[$parid]=$childArray;

			}
			

		}
		else
		{
			echo "The file $filename is not writable";
		}

	}
	else
	{
		echo "The file $filename does not exist";
		$log->debug("Exiting create_parenttab_data_file method ...");
		return;
	}
}
?>