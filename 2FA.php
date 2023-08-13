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
      
$regNo = $_SESSION["VregNo"];
$voterID = $_SESSION["VvoterID"];



if(isset($_POST['btn2FA'])){

$otp = $_POST['txtotp'];

 $sql = "SELECT * FROM otp_code WHERE otp='$otp' and regNo='$regNo' and voterID = '$voterID' and status='0'";
  $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
($row = mysqli_fetch_assoc($result));

//Update otpn status   
$edit = mysqli_query($conn,"update otp_code set status='1' where otp='$otp' and regNo='$regNo' and voterID = '$voterID'");
header("Location: vote.php"); 
}else { 

$msg_error = "Wrong OTP or OTP Already Used";
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>2FA Authentication</title>
  <link href="bitnami.css" media="all" rel="Stylesheet" type="text/css" /> 
  <link href="css/all.css" rel="stylesheet" type="text/css" />
  <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpeg">

  <style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #000000}
.style3 {font-size: 18px}
.style4 {color: #000000; font-size: 18px; }
-->
  </style>
</head>
<body>
  <div class="contain-to-grid">
    <nav class="top-bar" data-topbar>
      <ul class="title-area">
        <li class="name">
		
          <h1 class="style1">Secured Electoral System using 2FA </h1>
        </li>
        <li class="toggle-topbar menu-icon">
          <a href="#">
            <span>Menu</span>         
		  </a>        
		</li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
		          <li class=""><a href="index.php">Home </a></li>

          <li class=""><a href="Voter-register.php">Voter Registration</a></li>
		            <li class=""><a href="candidate-register.php">Candidate Registration</a></li>
          <li class=""><a href="vote.php">Vote</a></li>
          <li class=""><a href="result.php">Result</a></li>

       
          <li class=""><?php 
		  if(strlen($_SESSION['VregNo'])=="") {   
    								echo "<a href='login.php'>Login</a>";
   						 }else{
echo "<a href='logout.php'>Logout</a>"	;							}  
								   ?></a></li>
        </ul>
      </section>
	  <img src="images/logo.jpeg" alt="e-voting" width="66" height="66" id="img" />    </nav>
  </div>
  <div id="wrapper">
    <p align="center">&nbsp;</p>
    <p align="center">
		<form action="" method="post" name="f" class="form-horizontal contactform" id="f" >
                  <table width="505" border="0" align="center">
                    <tr>
                      <th width="499" scope="col"><div align="center"><p><h4><?php echo "<p> <font color=red font face='arial' size='3pt'>$msg_error</font> </p>"; ?></h4>  </p>
</div></th>
                    </tr>
                    <tr>
                      <td height="236"><table width="530" border="0" align="center">
                        <tr>
						<?php
						
$sql = "select * from voter where regNo ='$regNo'"; 
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
						
						?>
                          <td width="206" height="176"><div class="propic"> 
                            <div align="center"><img src="<?php echo $row['photo']?>"  width="221" height="200"/>                              </div>
                          </div></td>
                        </tr>
                        <tr>
                          <td height="95"><label>
                            <table width="505" border="0">
                              <tr>
                                <td width="95">&nbsp;</td>
                                <td width="400">  <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1"><strong>OTP:</strong>
          <input type="text"  id="pass1" class="form-control" name="txtotp"  value="<?php if (isset($_POST['txtotp']))?><?php echo $_POST['txtotp']; ?>" placeholder="Enter OTP from your phone" required="" />
        </label>
      </div></td>
                              </tr>
                            </table>
                            <div align="center"></div>
                            <div align="center"><a href="otp.php" class="style33">Resend OTP</a>
							    <p align="center">&nbsp;</p>
							            <button class="btn btn-primary" type="submit" name="btn2FA">Authenticate </button>

                            </div>
                          </label></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
                                </form>
    
    <p align="center">&nbsp;</p>
    <div id="lowerContainer" class="row">
      <div id="content" class="large-12 columns">
          <!-- @@BITNAMI_MODULE_PLACEHOLDER@@ -->
      </div>
    </div>
</div>
<footer>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p align="center"><?php  include('footer.php');?></p>
</footer>
</body>
</html>
