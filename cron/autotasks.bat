@echo off

schtasks /create /tn "CRMONE getBuyNums" /tr D:\xampp\htdocs\cron\getBuyNums.bat /sc DAILY /mo 1 /RU SYSTEM

schtasks /create /tn "CRMONE getSendMailNums" /tr D:\xampp\htdocs\cron\getSendMailNums.bat /sc DAILY /mo 1 /RU SYSTEM

schtasks /create /tn "CRMONE getSendMessNums" /tr D:\xampp\htdocs\cron\getSendMessNums.bat /sc DAILY /mo 1 /RU SYSTEM

