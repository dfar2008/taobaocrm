<?php
require_once('config.php');
require_once('include/fusioncharts/Class/FusionCharts.php');
function vertical_graph_fusion($datax,$datay,$groupdata,$title,$target_val,$cache_file_name,$width = 800,$height = 400)
{
	if(!is_array($datay) || !is_array($datax) || !is_array($groupdata)) {
		return;
	}
	$target = array();
	$data_total = array();
	for($j=0;$j<count($datay);$j++) {
		if (!isset($data_total[$datay[$j]])) 
		{
			$data_total[$datay[$j]] = 0;
		}
		$data_total[$datay[$j]] += $datax[$j];
	}
	$datay_u = array_unique($datay);
	$groupdata_u = array_unique($groupdata);
	$data = array();
	$aAlts = array();
	foreach($datay_u as $datay_item)
	{
		foreach ($groupdata_u as $groupdata_item) 
		{
			if (!isset($data[$groupdata_item])) 
			{
				$data[$groupdata_item] = array();
			}
			if (!isset($aAlts[$groupdata_item])) {
				$aAlts[$groupdata_item] = array();
			}
			for($j=0;$j<count($datay);$j++) {
				if($groupdata[$j] == $groupdata_item && $datay[$j] == $datay_item) {
					if (!isset($data[$groupdata_item][$datay_item])) {
						$data[$groupdata_item][$datay_item] = 0;
					}
					$data[$groupdata_item][$datay_item] += $datax[$j];
					$aAlts[$groupdata_item][$datay_item] = $datay_item."/".$groupdata_item.":".$datax[$j];
				} 
			}
			
		}
	}
	//datay is the values
	//datax is the status
    

	$fileContents = '';
	$i = 0;
	foreach($datay_u as $datay_item) {
		$color = generate_fusioncharts_color($datay_item,$i);
		$fileContents .= "<set name='".$datay_item."' value='".$data_total[$datay_item]."' color='".$color."' />";
		$i ++;
	}
	$fileContents = "<graph labelDisplay='WRAP' caption='".$title."' shownames='1' showvalues='1'  numDivLines='4' formatNumberScale='0' decimalPrecision='0'
anchorSides='10' anchorRadius='3' anchorBorderColor='009900' outCnvBaseFontSize='12' baseFontSize='12'>".$fileContents."</graph>";
	$return = renderChartHTML("include/fusioncharts/Charts/FCF_Column3D.swf","",$fileContents,"reportChart",$width,$height);
	return $return;
}

function vertical_graph_fusion2($datax,$datay,$title,$width = 800,$height = 400)
{
	if(!is_array($datay) || !is_array($datax)) {
		return;
	}
	$fileContents = '';
	$i = 0;
	foreach($datay as $datay_item) {
		$color = generate_fusioncharts_color($datay_item,$i);
		$fileContents .= "<set name='".$datay_item."' value='".$datax[$datay_item]."' color='".$color."' />";
		$i ++;
	}
	$fileContents = "<graph labelDisplay='WRAP' caption='".$title."' shownames='1' showvalues='1'  numDivLines='4' formatNumberScale='0' decimalPrecision='0'
anchorSides='10' anchorRadius='3' anchorBorderColor='009900' outCnvBaseFontSize='12' baseFontSize='12'>".$fileContents."</graph>";
	$return = renderChartHTML("include/fusioncharts/Charts/FCF_Column3D.swf","",$fileContents,"reportChart",$width,$height);
	return $return;
}
?>
