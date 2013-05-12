<?php
include('ecversion.php');


/* database configuration
      db_server
      db_port
      db_hostname
      db_username
      db_password
      db_name
*/

$dbconfig['db_server'] = 'localhost';
$dbconfig['db_port'] = ':3306';
$dbconfig['db_username'] = 'c3crm';
$dbconfig['db_password'] = 'c3crm';
$dbconfig['db_name'] = 'taobaocrm';
$dbconfig['db_type'] = 'mysql';
$dbconfig['db_status'] = 'true';

// TODO: test if port is empty
// TODO: set db_hostname dependending on db_type
$dbconfig['db_hostname'] = $dbconfig['db_server'].$dbconfig['db_port'];

// log_sql default value = false
$dbconfig['log_sql'] = false;

// persistent default value = true
$dbconfigoption['persistent'] = false;

// autofree default value = false
$dbconfigoption['autofree'] = false;

// debug default value = 0
$dbconfigoption['debug'] = 0;

// seqname_format default value = '%s_seq'
$dbconfigoption['seqname_format'] = '%s_seq';

// portability default value = 0
$dbconfigoption['portability'] = 0;

// ssl default value = false
$dbconfigoption['ssl'] = false;

$host_name = $dbconfig['db_hostname'];

$site_URL = 'http://www.c3crm.com/';

// root directory path
$root_directory = '/home/taobaocrm/';

// cache direcory path
$cache_dir = 'cache/';

// tmp_dir default value prepended by cache_dir = images/
$tmp_dir = 'cache/images/';

// import_dir default value prepended by cache_dir = import/
$import_dir = 'cache/import/';

// upload_dir default value prepended by cache_dir = upload/
$upload_dir = 'cache/upload/';

// mail server parameters
$mail_server = '';
$mail_server_username = '';
$mail_server_password = '';

// maximum file size for uploaded files in bytes also used when uploading import files
// upload_maxsize default value = 3000000
$upload_maxsize = 3000000;

// flag to allow export functionality
// 'all' to allow anyone to use exports 
// 'admin' to only allow admins to export 
// 'none' to block exports completely 
// allow_exports default value = all
$allow_exports = 'all';

// files with one of these extensions will have '.txt' appended to their filename on upload
// upload_badext default value = php, php3, php4, php5, pl, cgi, py, asp, cfm, js, vbs, html, htm
$upload_badext = array('php', 'php3', 'php4', 'php5', 'pl', 'cgi', 'py', 'asp', 'cfm', 'js', 'vbs', 'html', 'htm');

// full path to include directory including the trailing slash
// includeDirectory default value = $root_directory..'include/
$includeDirectory = $root_directory.'include/';

// list_max_entries_per_page default value = 20
$list_max_entries_per_page = '20';

// limitpage_navigation default value = 5
$limitpage_navigation = '5';

// history_max_viewed default value = 5
$history_max_viewed = '5';

// default_module default value = Home
$default_module = 'Home';

// default_action default value = index
$default_action = 'index';

// set default theme
// default_theme default value = blue
$default_theme = 'softed';

// show or hide time to compose each page
// calculate_response_time default value = true
$calculate_response_time = false;

// default text that is placed initially in the login form for user name
// no default_user_name default value
$default_user_name = '';

// default text that is placed initially in the login form for password
// no default_password default value
$default_password = '';

// create user with default username and password
// create_default_user default value = false
$create_default_user = false;
// default_user_is_admin default value = false
$default_user_is_admin = false;

// if your MySQL/PHP configuration does not support persistent connections set this to true to avoid a large performance slowdown
// disable_persistent_connections default value = false
$disable_persistent_connections = false;

// defined languages available. the key must be the language file prefix. (Example 'en_us' is the prefix for every 'en_us.lang.php' file)
// languages default value = en_us=>US English
$languages = Array('zh_cn'=>'Simplized Chinese',);

//Master currency name
$currency_name = '人民币';

// default charset
// default charset default value = ISO-8859-1
$default_charset = 'UTF-8';

// default language
// default_language default value = en_us
$default_language = 'zh_cn';

// add the language pack name to every translation string in the display.
// translation_string_prefix default value = false
$translation_string_prefix = false;

//Option to cache tabs permissions for speed.
$cache_tab_perms = true;

//Option to hide empty home blocks if no entries.
$display_empty_home_blocks = false;

// Generating Unique Application Key
$application_unique_key = 'b40df1f3fb10d36eafe32b67dafdc667';

$default_export_charset = "GB2312";
$default_email_charset = "GB2312";
//true for hosting server , false for dedicated servers or virtual private server
//2 for zend3.3.0 , 1 or true for hosting server(real_server_ip) ,false for dedicated servers or virtual private server
$ecustomer_hosting_type = '2';
//current_user or all_to_me
$default_viewscope = "current_user";
$default_activity_view = "day";
$display_latest_notes = true;
$default_use_internalmailer = 1;//1 -> use webmail to send mail ; 0 use out mailer(such outlook) to send mail
$is_disable_approve = false;
$default_reminder_interval = 1;
$is_disable_pm = true;
$monday_first = 1;
$default_number_digits = 2;
$default_number_grouping_seperator = ",";
$default_number_decimal_seperator = ".";
$default_percentseq = "3,5,2";
$default_timezone = "Asia/Shanghai";
if(isset($default_timezone) && function_exists('date_default_timezone_set')) {
	@date_default_timezone_set($default_timezone);
}
//$is_enable_create_deliverys = true;
//$is_enable_create_invoice = true;
//$invoice_approve = true;
$shopex_version == "4.8";
$is_showsubuserdata = true;
//$access_key = 'AKIAJAMHOVVAU5IU6MCA';
//$secret_key = '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';
?>