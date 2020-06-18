<?php

include_once('../config.php');
$error = array();
$Username = $_REQUEST['Username'];
$conn = connect();
$Contact = getContact($Username, $conn);
if(!isset($Contact)){
    array_push($error, "The username you entered does not exist");
}
$antiForgeryToken = random_strings(30);
editData("tbl_User", array("ResetToken", $antiForgeryToken), "PK_ID", $Contact[0], $conn);
$reset_Url = "http://$_SERVER[HTTP_HOST]";
$message = "Reset your password here: $reset_Url/feesystemapi/resetpassword/index.php?token=$antiForgeryToken&user=$Contact[0]";


if(isset($error))
{
	require '../mail/class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = '587';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'shehzadattwork@gmail.com';					//Sets SMTP username
	$mail->Password = 'feesystem';					//Sets SMTP password
	$mail->SMTPSecure = 'tls';
	$mail->From = "shehzadattwork@gmail.com";
	$mail->FromName = "FeeSystem";				//Sets the From name of the message
	$mail->AddAddress($Contact[1]);
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->Subject = "Reset Password";
	$mail->Body = $message;
	if($mail->Send())
	{
		return true;
	}
	else
	{
		return $error;
	}
}


?>