<?php
if(!$showinreport)
{
    $order=3;//相对位置
    $customreporttype=2;//完全自定义
    $fieldlabel="销售明细汇总 ";//显示的报表名称
    $fieldinf=array($fieldlabel);
    //ListView.php上显示的参数（必须格式与半自定义的一致）
    $returnval = array(array($order,$customreporttype),array("",$fieldinf,array()));
}
else
{
    //自定义报表内容
//    echo "This is the completely custom report";
    require_once("config.php");
    require_once("include/utils/utils.php");
    require_once('include/database/PearDatabase.php');
    global $listviewreport;
    $delimiter = stristr(PHP_OS,"WIN")?";":":";
    $dir = str_replace("\\","/",$root_directory);
    ini_set("include_path",ini_get("include_path").$delimiter.$dir."include/phpreports/");
    require_once("PHPReportMaker.php");
    global $mod_strings;
    global $app_strings;
    global $theme;
    global $adb;
    global $current_user;
    $theme_path="themes/".$theme."/";
    $image_path=$theme_path."images/";	
    
    $sGroup = 
	"<GROUP RESET_SUPPRESS_ON_PAGEBREAK='TRUE' REPRINT_HEADER_ON_PAGEBREAK='TRUE'>".
	"<HEADER>".
	"<ROW><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>签约日期</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>客户</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>合同订单编号</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>订单金额</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>负责人</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>审批人</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>产品名称</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>产品类别</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>型号</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>产品编号</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>数量</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>单位</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>成本价</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>单价</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>售价</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>差价</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>金额</COL><COL CELLCLASS='HEADER' TEXTCLASS='BOLD'>利润</COL></ROW>".
	"</HEADER>".
	"<FIELDS>".
	"<ROW>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>duedate</COL>".
	"<COL TYPE='EXPRESSION' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'><LINK TYPE='EXPRESSION' TARGET='blank' TITLE='Click'>\"".$site_URL."getCustomerInfo.php?record=\".\$this->getValue('accountid')</LINK>\$this->getValue('accountname')</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>subject</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>total</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>user_name</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>appuser_name</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>productname</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>catalogname</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>serialno</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>productcode</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>quantity</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>usageunit</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>cost_price</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>unit_price</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>listprice</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD'>profit_price</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD' NUMBERFORMATEX='2'>producttotal</COL>".
	"<COL TYPE='FIELD' CELLCLASSEVEN='EVEN' CELLCLASSODD='ODD' NUMBERFORMATEX='2'>profit</COL>".
	"</ROW>".
	"</FIELDS>".
	"<FOOTER>".
	"</FOOTER>".
	"</GROUP>";

    $sDoc = 
        "<DOCUMENT>".
        "<FOOTER>".
        "<ROW>".
        "<COL CELLCLASS='FOOTER' TEXTCLASS='BOLD' ALIGN='RIGHT' COLSPAN='14'></COL>".
        "<COL CELLCLASS='FOOTER' TEXTCLASS='BOLD' ALIGN='RIGHT'>总金额</COL>".
        "<COL TYPE='EXPRESSION' CELLCLASS='FOOTER' TEXTCLASS='BOLD' NUMBERFORMATEX='2'>\$this->getSum('producttotal')</COL>".
        "<COL CELLCLASS='FOOTER' TEXTCLASS='BOLD' ALIGN='RIGHT'>总利润</COL>".
        "<COL TYPE='EXPRESSION' CELLCLASS='FOOTER' TEXTCLASS='BOLD' NUMBERFORMATEX='2'>\$this->getSum('profit')</COL>".
        "</ROW>".
        "</FOOTER>".
        "</DOCUMENT>";	
    echo '<HTML>
            <HEAD>
            <meta http-equiv="Content-Type" content="text/html; charset=utf8">
            <TITLE>销售明细汇总</TITLE>
            <LINK REL="stylesheet" TYPE="text/css" HREF="include/phpreports/sales.css">
            <link href="themes/images/report.css" rel="stylesheet" type="text/css"/></head>';
    echo '<body BGCOLOR="#FFFFFF" marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" style="text-align:center;" align="center">';
    $query = "SELECT ec_account.accountname,ec_account.accountid,ec_salesorder.subject,ec_salesorder.duedate,ec_salesorder.total,ec_users.user_name,ec_salesorder.smownerid,ec_inventoryproductrel.listprice,ec_inventoryproductrel.quantity,ec_inventoryproductrel.listprice*ec_inventoryproductrel.quantity as producttotal,ec_products.productname,ec_products.productcode,ec_products.serialno,ec_products.usageunit,ec_products.unit_price,ec_products.cost_price,(ec_inventoryproductrel.listprice - ec_products.cost_price) AS profit_price,(ec_inventoryproductrel.listprice - ec_products.cost_price)*ec_inventoryproductrel.quantity as profit,ec_users2.user_name as appuser_name,ec_catalog.catalogname FROM ec_salesorder  left join ec_users on ec_users.id=ec_salesorder.smownerid left join ec_account on ec_account.accountid=ec_salesorder.accountid left join ec_inventoryproductrel on ec_inventoryproductrel.id=ec_salesorder.salesorderid left join ec_products on ec_products.productid=ec_inventoryproductrel.productid left join ec_catalog on ec_catalog.catalogid=ec_products.catalogid left join ec_users ec_users2 on ec_users2.id=ec_salesorder.approvedby where ec_salesorder.deleted=0 and ec_salesorder.approved=1 ";
    $query =$listviewreport->addSecurityParameter($query);
    $query =$listviewreport->getModifiedListQuery($query);
    $query .= " ORDER BY ec_salesorder.duedate";
//    echo $query;
    $oRpt = new PHPReportMaker();
    $oRpt->setDatabaseInterface($dbconfig['db_type']);
    $oRpt->setDatabase($dbconfig['db_name']);
    $oRpt->setUser($dbconfig['db_username']);
    $oRpt->setPassword($dbconfig['db_password']);
    $oRpt->setConnection($dbconfig['db_hostname']);
    $oRpt->setSQL($query);
    $oRpt->setBody(false);
    $oRpt->setPageSize(50000);
    $oRpt->createFromTemplate("销售明细汇总","include/phpreports/template.xml",null,$sDoc,$sGroup);
    $reportData = $oRpt->run();
    echo '</body></html>';
}

?>
