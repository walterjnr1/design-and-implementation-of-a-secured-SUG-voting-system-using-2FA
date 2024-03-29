<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Secured SUG Electoral System using Two-Factor Authentication</title>
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
            <span>Menu</span>		  </a>		</li>
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
          <li class=""><a href="choose-result.php">Result</a></li>

       
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
	  <img src="images/logo.jpeg" alt="e-voting" name="img" width="66" height="66" id="img" />    </nav>
  </div>
  <div id="wrapper">
    <div class="hero">
       <div class="row">
         <div class="large-12 columns">
            <p><span class="style2"><span class="style3"><strong>Secured SUG Electoral System using Two-Factor Authentication</strong> is an election system that allows voters to record a secret ballot remotely and   have it tabulated electronically. Votes are stored in a central database.</span></span></p>
            <p class="style4">This system can speed up election   results and lower the cost of conducting an election by significantly   reducing the number of people required to operate a polling place and   tabulate results. A primary concern with e-voting, however, is how to   store votes so they can be recounted if required.</p>
            <p class="style4">The system is highly secured because it uses a Two-factor Authentication security. </p>
            <p align="justify">.</p>
         </div>
       </div>
    </div>
    <p align="center"><img src="images/home-new-612854434-1024x797.jpg" alt="Secured E-voting" width="890" height="653" /></p>
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
