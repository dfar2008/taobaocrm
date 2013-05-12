配置易客CRM自动备份
linux下配置步骤：
1）修改backup.sh，http://localhost:81/换成正确的访问地址；
2）配置cronjob执行backup.sh脚本。
windows下配置步骤：
1）修改backup.bat，http://localhost:81/换成正确的访问地址；
2）执行autotasks.bat，然后执行：开始->附件->系统工具->任务计划，根据公司备份需求修改里面的CRMONE Backup DB任务计划。
配置完毕，系统备份数据后会在storage目录下保存数据库备份文件。