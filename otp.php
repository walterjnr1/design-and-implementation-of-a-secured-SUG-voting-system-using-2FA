<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

session_start();
error_reporting(0);
include('connect.php');
if(strlen($_SESSION['VregNo'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
	}
	
	date_default_timezone_set('Africa/Lagos');
 $current_date = date('Y-m-d H:i:s');
 
//generate oTP
function otp(){
$string = (uniqid(rand(), true));
return substr($string, 0, 5);
}
	
$otp = otp();
      
$regNo = $_SESSION["VregNo"];
$voterID = $_SESSION["VvoterID"];
$fullname = $_SESSION["voterName"];
$email = $_SESSION["voteremail"];


//send otp via email
$mail = new PHPMailer(true);
 
//Server settings
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'newleastpaysolution@gmail.com';                     //SMTP username
$mail->Password   = 'hjsktekphlhzsrbm';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('newleastpaysolution@gmail.com', 'SUG');
$mail->addAddress('newleastpaysolution@gmail.com', 'SUG');     //Add a recipient

$message = "
<html>
<head>
<title>OTP |Federal Polytechnic , Ukana</title>
</head>
<body>
<img height='90' src=\"http://localhost/Secured_SUG_electoral_system_2FA/images/logo.jpeg\" width='108'>
                      
<p> Dear$fullname, Your OTP is: </p>
</body>
</html>
";

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'OTP' ;
$mail->Body    = $message;
$mail->send();



//SEnd voterID  Via SMS
$username='info.autosyst@gmail.com';//Note: urlencodemust be added forusernameand 
$password='Integax.sms@2022';// passwordas encryption code for security purpose.
$sender='E-VOTING';

$message  = 'Hello '.$voterName.', Your OTP is '.$otp.'. Thanks';
$api_url  = 'https://portal.nigeriabulksms.com/api/';

//Create the message data
$data = array('username'=>$username, 'password'=>$password, 'sender'=>$sender, 'message'=>$message, 'mobiles'=>$phone);
//URL encode the message data
$data = http_build_query($data);
//Send the message
$request = $api_url.'?'.$data;
$result  = file_get_contents($request);
$result  = json_decode($result);

//insert otp
$query_otp = "INSERT INTO otp_code ( otp,datetime,regNo, voterID,status) VALUES ('$otp','$current_date','$regNo', '$voterID','0')";
 if ($conn->query($query_otp) === TRUE) {


header("Location: 2FA.php"); 
}

?>
