<?php
require_once('include/fusioncharts/Class/FusionCharts.php');

function pie_chart_fusion($datax,$datay,$groupdata,$title,$target_val,$cache_file_name,$width = 800,$height=400)
{
	if(!is_array($datax) || !is_array($datay)) {
		return "";
	} 
	$data_total = array();
	for($j=0;$j<count($datay);$j++) {
		if (!isset($data_total[$datay[$j]])) 
		{
			$data_total[$datay[$j]] = 0;
		}
		$data_total[$datay[$j]] += $datax[$j];
	}
	$datay_u = array_unique($datay);

	$fileContents = '';
	foreach($datay_u as $datay_item) {
		$fileContents .= "<set name='".$datay_item."' value='".$data_total[$datay_item]."'/>";
	}
	$fileContents = "<graph labelDisplay='WRAP' caption='".$title."' shownames='1' showvalues='1' decimalPrecision='0' outCnvBaseFontSize='12' baseFontSize='12' pieYScale='45' pieBorderAlpha='40' pieFillAlpha='70' pieSliceDepth='15' pieRadius='100'>".$fileContents."</graph>";
	$return = renderChartHTML("include/fusioncharts/Charts/FCF_Pie2D.swf","",$fileContents,"reportChart",$width,$height);
    return $return;
}

function pie_chart_fusion2($datax,$datay,$title,$width = 800,$height=400)
{
	if(!is_array($datax) || !is_array($datay)) {
		return "";
	} 
	$fileContents = '';
	foreach($datay as $datay_item) {
		$fileContents .= "<set name='".$datay_item."' value='".$datax[$datay_item]."'/>";
	}
	$fileContents = "<graph labelDisplay='WRAP' caption='".$title."' shownames='1' showvalues='1' decimalPrecision='0' outCnvBaseFontSize='12' baseFontSize='12' pieYScale='45' pieBorderAlpha='40' pieFillAlpha='70' pieSliceDepth='15' pieRadius='100'>".$fileContents."</graph>";
	$return = renderChartHTML("include/fusioncharts/Charts/FCF_Pie3D.swf","",$fileContents,"reportChart",$width,$height);
    return $return;
}

function line_chart_fusion($datax,$datay,$groupdata,$title,$target_val,$cache_file_name,$width=500,$height=369)
{
	if(!is_array($datax) || !is_array($datay)) {
		return "";
	} 
	$data_total = array();
	for($j=0;$j<count($datay);$j++) {
		if (!isset($data_total[$datay[$j]])) 
		{
			$data_total[$datay[$j]] = 0;
		}
		$data_total[$datay[$j]] += $datax[$j];
	}
	$datay_u = array_unique($datay);

	$fileContents = '';
	foreach($datay_u as $datay_item) {
		$fileContents .= "<set name='".$datay_item."' value='".$data_total[$datay_item]."'/>";
	}
	$fileContents = "<graph labelDisplay='WRAP' caption='".$title."' shownames='1' showvalues='1' decimalPrecision='0' outCnvBaseFontSize='12' baseFontSize='12' pieYScale='45' pieBorderAlpha='40' pieFillAlpha='70' pieSliceDepth='15' pieRadius='100'>".$fileContents."</graph>";
	$return = renderChartHTML("include/fusioncharts/Charts/FCF_Line.swf","",$fileContents,"reportChart",$width,$height);
    return $return;
}

function line_chart_fusion2($datax,$datay,$title,$width=500,$height=369)
{
	if(!is_array($datax) || !is_array($datay)) {
		return "";
	} 
	

	$fileContents = '';
	foreach($datay as $datay_item) {
		
		$fileContents .= "<set name='".$datay_item."' value='".$datax[$datay_item]."'/>";
	}
	$fileContents = "<graph labelDisplay='WRAP' caption='".$title."' shownames='1' showvalues='1' decimalPrecision='0' outCnvBaseFontSize='12' baseFontSize='12' pieYScale='45' pieBorderAlpha='40' pieFillAlpha='70' pieSliceDepth='15' pieRadius='100'>".$fileContents."</graph>";
	$return = renderChartHTML("include/fusioncharts/Charts/FCF_Line.swf","",$fileContents,"reportChart",$width,$height);
    return $return;
}

function pipe_chart_fusion($datax,$datay,$groupdata,$title,$target_val,$cache_file_name,$width = 800)
{
	if(!is_array($datax) || !is_array($datay)) {
		return "";
	} 
	global $pieChartColors;
	$data_total = array();
	for($j=0;$j<count($datay);$j++) {
		if (!isset($data_total[$datay[$j]])) 
		{
			$data_total[$datay[$j]] = 0;
		}
		$data_total[$datay[$j]] += $datax[$j];
	}
	$datay_u = array_unique($datay);

	$fileContents = '';
	$i = 0;
	foreach($datay_u as $datay_item) {
		$color = generate_graphcolor($datay_item,$i);
		$fileContents .= "<set name='".$datay_item."' value='".$data_total[$datay_item]."' color='".$color."' />";
		$i ++;
	}
	$return = create_chart_fusion('pipe',"<graph caption='".$title."' shownames='1' showvalues='1' decimalPrecision='0' outCnvBaseFontSize='12' baseFontSize='12' pieYScale='45' pieBorderAlpha='40' pieFillAlpha='70' pieSliceDepth='15' pieRadius='100'>".$fileContents."</graph>");
    return $return;
}
?>