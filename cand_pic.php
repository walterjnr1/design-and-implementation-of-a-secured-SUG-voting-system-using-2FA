<?php
session_start();
error_reporting(0);
//include 'header.php';
include('connect.php');

if(strlen($_SESSION['regNo'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
	}
      
$regNo = $_SESSION["regNo"];

$sql = "select * from candidate where regNo='$regNo'"; 
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);

if(isset($_POST['btnupload'])){
$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
	$image_size= getimagesize($_FILES['image']['tmp_name']);
	move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/" . $_FILES["image"]["name"]);			
			$location="uploads/" . $_FILES["image"]["name"];

 $sql = " update candidate set photo='$location' where regNo='".$_SESSION['regNo']."'";
   if (mysqli_query($conn, $sql)) {

    ?>
									
<script>
alert('Photo has been Uploaded successfully ');
window.location = "cand_pic.php";

</script>

	<?php	
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Upload Candidate Image</title>
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
          <li class=""><a href="choose-result.php">Result</a></li>

       
          <li class=""><?php 
		  if(strlen($_SESSION['regNo'])=="") {   
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
    <p align="center"><form  method="post"  enctype="multipart/form-data">
                  <table width="505" border="0" align="center">
                    <tr>
                      <th width="499" scope="col"><div align="center"><span class="style12">CANDIDATE'S PHOTO </span>&nbsp;</div></th>
                    </tr>
                    <tr>
                      <td height="236"><table width="530" border="0" align="center">
                        <tr>
						<?php
						
$sql = "select * from candidate where regNo ='".$_SESSION['regNo']."'"; 
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
						
						?>
                          <td width="206" height="176"><div class="propic"> 
                            <div align="center"><img src="<?php echo $row['photo']?>"  width="221" height="200"/>                              </div>
                          </div></td>
                        </tr>
                        <tr>
                          <td><p align="center">&nbsp;</p>
                            <p align="center"><strong><span class="style30"> <span class="style31">CANDIDATE NAME</span>:</span> <?php echo " <strong><font face='Verdana' size='3' color=blue>".$rowaccess['candName']." </font></strong>";  ?></strong></p>
                            <p align="center"><strong><span class="style30"><span class="style31">REG NO </span>:</span> <?php echo " <strong><font face='Verdana' size='3' color=blue>".$regNo." </font></strong>";  ?></strong> </p></td>
                        </tr>
                        <tr>
                          <td><p align="center"><strong><span class="style32">CANDIDATE ID </span>: <?php echo " <strong><font face='Verdana' size='3' color=blue>".$rowaccess['candID']." </font></strong>";  ?></strong></p>                          </td>
                        </tr>
                        <tr>
                          <td height="40">
                            <div align="right"></div></td></tr>
                        <tr>
                          <td height="95"><label>
                            <table width="505" border="0">
                              <tr>
                                <td width="95">&nbsp;</td>
                                <td width="400"><input name="image" type="file" id="image" /></td>
                              </tr>
                            </table>
                            <div align="center"></div>
                            <div align="center"><a href="index.php" class="style33">Home</a>
                              <input name="btnupload" type="submit" class="ed" id="upload" value="Upload image" />
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
