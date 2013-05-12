<?php
require("modules/Emails/mail.php");
function sendmail($to,$from,$subject,$contents,$mail_server,$mail_server_username,$mail_server_password,$filename,$cc)
{
	send_mail('',$to,$from_name,$from,$subject,$contents,$cc);  
}
?>
