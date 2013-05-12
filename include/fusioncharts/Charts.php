<?php
function create_chart_fusion_old($chartName,$xmlFile,$width="650",$height="420") {
	$html ='<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
 codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
 WIDTH="'.$width.'" HEIGHT="'.$height.'" id="'.$chartName.'" ALIGN="middle">';
    $html .='<PARAM NAME=FlashVars VALUE="&dataURL='.$xmlFile.'&chartWidth=650&chartHeight=400">';
	$html .='<PARAM NAME=movie VALUE="include/fusioncharts/Charts/'.$chartName.'.swf">';
	$html .='<PARAM NAME=bgcolor VALUE=#FFFFFF>';
	$html .= '<PARAM NAME=quality VALUE=high>';
	$html .='<EMBED src="include/fusioncharts/Charts/'.$chartName.'.swf?chartWidth=650&chartHeight=400" FlashVars="&dataURL='.$xmlFile.'&chartWidth=650&chartHeight=400" quality=high bgcolor=#FFFFFF  WIDTH="650" HEIGHT="400" NAME="'.$chartName.'" ALIGN="middle"
 TYPE="application/x-shockwave-flash" PLUGINSPAGE="https://www.macromedia.com/go/getflashplayer">';
	$html .='</EMBED>';
	$html .='</OBJECT>';
	return $html;
}

function create_chart_fusion($chartName,$xmlFile,$width="650",$height="420") {
	$html ='<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
 codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
 WIDTH="'.$width.'" HEIGHT="'.$height.'" id="'.$chartName.'" ALIGN="middle">';
    $html .='<PARAM NAME=FlashVars VALUE="&dataURL='.$xmlFile.'&chartWidth=650&chartHeight=400">';
	$html .='<PARAM NAME=movie VALUE="include/fusioncharts/Charts/'.$chartName.'.swf">';
	$html .='<PARAM NAME=bgcolor VALUE=#FFFFFF>';
	$html .= '<PARAM NAME=quality VALUE=high>';
	$html .='<EMBED src="include/fusioncharts/Charts/'.$chartName.'.swf?chartWidth=650&chartHeight=400" FlashVars="&dataURL='.$xmlFile.'&chartWidth=650&chartHeight=400" quality=high bgcolor=#FFFFFF  WIDTH="650" HEIGHT="400" NAME="'.$chartName.'" ALIGN="middle"
 TYPE="application/x-shockwave-flash" PLUGINSPAGE="https://www.macromedia.com/go/getflashplayer">';
	$html .='</EMBED>';
	$html .='</OBJECT>';
	return $html;
}


function generate_graphcolor($input,$instance) {
	if ($instance <20) {
	$color = array(
	"FF0000",
	"00FF00",
	"0000FF",
	"FF6600",
	"42FF8E",
	"6600FF",
	"FFFF00",
	"00FFFF",
	"FF00FF",
	"66FF00",
	"0066FF",
	"FF0066",
	"CC0000",
	"00CC00",
	"0000CC",
	"CC6600",
	"00CC66",
	"6600CC",
	"CCCC00",
	"00CCCC");
	$out = $color[$instance];
	} else {
	$out = "" . substr(md5($input), 0, 6);

	}
	return $out;
}

function save_xml_file($filename,$xml_file) {
	global $app_strings;
	$handle = fopen($filename, 'w');
	//fwrite($handle,iconv("GBK","UTF-8",$xml_file));


	if (!$handle) {
		return;
	}
	// Write $somecontent to our opened file.)
	if ($app_strings['LBL_CHARSET'] == "GBK") {
		if(function_exists('iconv')) {			
			$xml_file = iconv_ec("GB2312","UTF-8",$xml_file);
		} else {
			$chs = new Chinese("GBK","UTF8",trim($xml_file));
			$xml_file = $chs->ConvertIT();
		}
		if (fwrite($handle,$xml_file) === FALSE) {
			return false;
		}
    } else if ($app_strings['LBL_CHARSET'] != "UTF-8") {
		//$xml_file = iconv("ISO-8859-1","UTF-8",$xml_file);
		if (fwrite($handle,utf8_encode($xml_file)) === FALSE) {
			return false;
		}
    } else {
		if (fwrite($handle,$xml_file) === FALSE) {
			return false;
		}
	}

	fclose($handle);
	return true;

}

function get_max($numbers) {
	if(0 == count($numbers)) {
		return 0;
	}
	/*
	$num_len =  strlen(floor(max($numbers)))-1;
	$whole=pow(10,$num_len);
	$dec=1/$whole;
	$max = ceil(max($numbers)*$dec)*$whole;
	*/
	$max_num = max($numbers);
	return $max_num;
}

//graph colors
$barChartColors = array(
"docBorder"=>"777777",
"docBg1"=>"fefefe",
"docBg2"=>"e1e1e1",
"xText"=>"666666",
"yText"=>"666666",
"title"=>"555555",
"misc"=>"666666",
"altBorder"=>"666666",
"altBg"=>"FFF9B7",
"altText"=>"666666",
"graphBorder"=>"444444",
"graphBg1"=>"CCCCCC",
"graphBg2"=>"efefef",
"graphLines"=>"EEEEEE",
"graphText"=>"222222",
"graphTextShadow"=>"FFFFFF",
"barBorder"=>"666666",
"barBorderHilite"=>"FFFFFF",
"legendBorder"=>"777777",
"legendBg1"=>"CCDFFF",
"legendBg2"=>"E0ECFF",
"legendText"=>"444444",
"legendColorKeyBorder"=>"777777",
"scrollBar"=>"999999",
"scrollBarBorder"=>"777777",
"scrollBarTrack"=>"eeeeee",
"scrollBarTrackBorder"=>"777777"
);

$pieChartColors = array(
"docBorder"=>"777777",
"docBg1"=>"fefefe",
"docBg2"=>"e1e1e1",
"title"=>"555555",
"subtitle"=>"666666",
"misc"=>"666666",
"altBorder"=>"666666",
"altBg"=>"FFF9B7",
"altText"=>"666666",
"graphText"=>"444444",
"graphTextShadow"=>"FFFFFF",
"pieBorder"=>"666666",
"pieBorderHilite"=>"FFFFFF",
"legendBorder"=>"777777",
"legendBg1"=>"CCDFFF",
"legendBg2"=>"E0ECFF",
"legendText"=>"444444",
"legendColorKeyBorder"=>"777777",
"scrollBar"=>"999999",
"scrollBarBorder"=>"777777",
"scrollBarTrack"=>"eeeeee",
"scrollBarTrackBorder"=>"777777"
);
// retrieve the translated strings.
global $current_language;
$app_strings = return_application_language($current_language);

if(isset($app_strings['LBL_CHARSET']))
{
	$charset = $app_strings['LBL_CHARSET'];
}
else
{
	global $sugar_config;
	$charset = $sugar_config['default_charset'];
}
?>
