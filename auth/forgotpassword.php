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

$emailTemplate = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>

<head>
    <meta charset='UTF-8'>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <meta name='x-apple-disable-message-reformatting'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta content='telephone=no' name='format-detection'>
    <title></title>
    <style>
        *{font-family: calibri;}
    </style>
    <!--[if (mso 16)]>
    <style type='text/css'>
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>

<body>
    <div class='es-wrapper-color'>
        <!--[if gte mso 9]>
			<v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
				<v:fill type='tile' color='#fafafa'></v:fill>
			</v:background>
		<![endif]-->
        <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
            <tbody>
                <tr>
                    <td class='esd-email-paddings' valign='top'>
                       
                        <table cellpadding='0' cellspacing='0' class='es-header' align='center'>
                            <tbody>
                                <tr>
                                    <td class='es-adaptive esd-stripe' align='center' esd-custom-block-id='88593'>
                                        <table class='es-header-body' style='background-color: #3d5ca3;' width='600' cellspacing='0' cellpadding='0' bgcolor='#3d5ca3' align='center'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p20t es-p20b es-p20r es-p20l' style='background-color: #3d5ca3;' bgcolor='#3d5ca3' align='left'>
                                                        <!--[if mso]><table width='560' cellpadding='0' 
                        cellspacing='0'><tr><td width='270' valign='top'><![endif]-->
                                                        <table class='es-left' cellspacing='0' cellpadding='0' align='left'>
                                                            <tbody>
                                                                <tr>
                                                                    <td class='es-m-p20b esd-container-frame' width='270' align='left'>
                                                                        <table width='100%' cellspacing='0' cellpadding='0'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class='esd-block-image es-m-p0l es-m-txt-c' align='left' style='font-size:0'><a href='#' target='_blank'><h3>Fee Management System</h3></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                       
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='es-content' cellspacing='0' cellpadding='0' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe' style='background-color: #fafafa;' bgcolor='#fafafa' align='center'>
                                        <table class='es-content-body' style='background-color: #ffffff;' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p40t es-p20r es-p20l' style='background-color: transparent; background-position: left top;' bgcolor='transparent' align='left'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'>
                                                            <tbody>
                                                                <tr>
                                                                    <td class='esd-container-frame' width='560' valign='top' align='center'>
                                                                        <table style='background-position: left top;' width='100%' cellspacing='0' cellpadding='0'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class='esd-block-image es-p5t es-p5b' align='center' style='font-size:0'><a target='_blank'><img src='https://tlr.stripocdn.email/content/guids/CABINET_dd354a98a803b60e2f0411e893c82f56/images/23891556799905703.png' alt style='display: block;' width='175'></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class='esd-block-text es-p15t es-p15b' align='center'>
                                                                                        <h1 style='color: #333333; font-size: 20px;'><strong>FORGOT YOUR </strong></h1>
                                                                                        <h1 style='color: #333333; font-size: 20px;'><strong>&nbsp;PASSWORD?</strong></h1>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class='esd-block-text es-p35r es-p40l' align='left'>
                                                                                        <p style='text-align: center;'>There was a request to change your password!</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class='esd-block-text es-p25t es-p40r es-p40l' align='center'>
                                                                                        <p>If did not make this request, just ignore this email. Otherwise, please click the button below to change your password:</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class='esd-block-button es-p40t es-p40b es-p10r es-p10l' align='center'><span class='es-button-border'><a href='$reset_Url/feesystemapi/resetpassword/index.php?token=$antiForgeryToken&user=$Contact[0]' class='es-button' target='_blank'>RESET PASSWORD</a></span></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    
                        
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>";
$message = $emailTemplate;


if(isset($error))
{
	require '../mail/class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'feesystem027@gmail.com';					//Sets SMTP username
	$mail->Password = 'Impega@11';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';
	$mail->From = "feesystem027@gmail.com";
	$mail->FromName = "FeeSystem";				//Sets the From name of the message
	$mail->AddAddress($Contact[1]);
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->Subject = "Reset Password";
	$mail->Body = $message;
	if($mail->Send())
	{
		echo "true";
	}
	else
	{
		echo json_encode($error);
	}
}


?>