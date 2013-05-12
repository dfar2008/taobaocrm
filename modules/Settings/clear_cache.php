<?php
set_time_limit(0);
include_once("config.php");
include_once("include/utils/utils.php");
global $mod_strings;
$count = clear_cache_files();
create_tab_data_file();
create_parenttab_data_file();
RecalculateSharingRules();
//echo "<center><font siez=15><b>".$mod_strings["LBL_CLEAR_DATABASE_CACHE"]."</b></font></center>";
$category = getParentTab();
echo "<script language=javascript>alert('".$mod_strings["LBL_CLEARED_DATABASE_CACHE"]."');document.location.href='index.php?module=Settings&action=index&parenttab=".$category."';</script>";
?>