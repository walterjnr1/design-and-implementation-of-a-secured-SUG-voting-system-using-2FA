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


date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d ');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Select Result</title>
  <link href="bitnami.css" media="all" rel="Stylesheet" type="text/css" /> 
  <link href="css/all.css" rel="stylesheet" type="text/css" />
  <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpeg">
<script type="text/javascript">
		function vote(election_name){
if(confirm("ARE YOU SURE YOU WISH TO SELECT " + " " + election_name+ " " + " FROM THE LIST?"))
{
return  true;
}
else {return false;
}
	 
}

</script>
  <style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #000000}
.style3 {font-size: 18px}
.style36 {color: #0000FF; font-weight: bold; font-size: 24px; }
.style38 {font-size: 16px}
.style40 {font-size: 16px; font-weight: bold; color: #000033; }
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
		          <li class="active"><a href="index.php">Home </a></li>

          <li class=""><a href="Voter-register.php">Voter Registration</a></li>
		            <li class=""><a href="candidate-register.php">Candidate Registration</a></li>
                <li class="">
                <?php 
		           if(!empty($_SESSION['VregNo'])) {   
    								echo "<a href='vote.php'>Vote</a>";
   												}  
								   ?></a>
                   </li>
                   
                   <li class=""><a href="result.php">Result</a></li>

       
          <li class=""><?php 
		  if(empty($_SESSION['VregNo'])) {   
    								echo "<a href='login.php'>Login</a>";
   						 }else{
echo "<a href='logout.php'>Logout</a>"	;	
						}  
								   ?></a>
                   </li>
        </ul>
      </section>
	  <img src="images/logo.jpeg" alt="e-voting" width="66" height="66" id="img" />    </nav>
  </div>
  <div id="wrapper">
    <div class="hero">
       <div class="row">
         <div class="large-12 columns">
            <p>&nbsp;</p>
            <p align="justify">.</p>
         </div>
       </div>
    </div>
    <p align="center"><span class="style2"><span class="style3"><strong>Select type of Election You wish to view Result </strong></span></span></p>
    <table width="45%" align="center" class="table table-bordered table-striped" id="resultTable">
      <thead>
        <tr>
          <th width="13%" bgcolor="#9933FF" class="style36"><div align="center" class="style40">#</div></th>
          <th width="87%" bgcolor="#9933FF" class="style36"><div align="center" class="style40">Election Type </div></th>
        </tr>
      </thead>
      <tbody>
        <?php 
                                          $sql = "SELECT * FROM election order by election_name ASC";
                                           $result = $conn->query($sql);
										$cnt=1;
                                           while($row = $result->fetch_assoc()) { 
										   ?>
        <tr class="gradeX">
          <td height="47"><div align="center" class="style38">
              <div align="center"><?php echo $cnt; ?></div>
          </div></td>
         <td><div align="center"><a href="result_2.php?type=<?php echo $row['election_name'];?>" ><?php echo $row['election_name'];?> </a></span></span></div></td>
        </tr>
        <?php $cnt=$cnt+1;} ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
    <p align="center">&nbsp;</p>
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
