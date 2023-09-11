<?php  
session_start(); //to ensure you are using same session
error_reporting(0);

session_destroy(); //destroy the session
?>

<script>
window.location="index.php";
</script>
<?php
//to redirect back to "index.php" after logging out
  exit;
?>