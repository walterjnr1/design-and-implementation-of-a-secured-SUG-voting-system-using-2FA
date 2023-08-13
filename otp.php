<?php
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


//SEnd voterID  Via SMS
$username='rexrolex0@gmail.com';//Note: urlencodemust be added forusernameand 
$password='admin123';// passwordas encryption code for security purpose.

$sender='SLT-RITMAN';
$url = "http://portal.nigeriabulksms.com/api/?username=".$username."&password=".$password."&message="."Dear $voterName, Your OTP is: ".$otp."&sender=".$sender."&mobiles=".$phone;


//$sender='SUG-RITMAN';

//$url="https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=6qQBmEf2xX9PX6KbMknkvtEORgRNJJSMhFFUhlFvpR72KNOgakaFbblVc3ti&from=".$sender."&to=".$phone."&body=Dear $voterName, Your OTP is: ".$otp."&dnd=2";


$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, 0);
$resp = curl_exec($ch);

//insert otp
$query_otp = "INSERT INTO otp_code ( otp,datetime,regNo, voterID,status) VALUES ('$otp','$current_date','$regNo', '$voterID','0')";
 if ($conn->query($query_otp) === TRUE) {


header("Location: 2FA.php"); 
}

?>
