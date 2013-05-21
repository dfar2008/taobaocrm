taobaocrm
=========

易客CRM淘宝专用版本
环境要求:php5.2,Mysql5.0<br>
表结构:taobaocrm.sql<br>
官方网站:http://www.c3crm.com<br>

安装教程：<br>
第一步：把php文件拷贝到www目录下；<br>
第二步：把taobaocrm.sql文件导入到mysql数据库中；<br>
第三步：修改config.inc.php文件里的数据库信息和目录信息，<br>
$dbconfig['db_server'] = 'localhost';<br>
$dbconfig['db_port'] = ':3306';<br>
$dbconfig['db_username'] = 'c3crm';<br>
$dbconfig['db_password'] = 'c3crm';<br>
$dbconfig['db_name'] = 'taobaocrm';<br>
$site_URL = 'http://www.c3crm.com/';<br>
$root_directory = '/home/www/';<br>
第四步：把Smarty/templates_c和cache目录权限设为777；<br>
第五步：祝贺你，安装成功！通过浏览器就可以使用淘宝CRM了！<br>
