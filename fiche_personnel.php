<?php
session_start();

include '../lib/php/connectAD.php';

if(empty($_SESSION['connectsapeur'])){
    echo "<meta http-equiv='refresh' content='0;url=login.php?message=<font color=red>Veuillez vous connecter pour accèder à cette page.</font>'>";
} else {
    
}

$username = $_SESSION['connectsapeur'];

$sql="SELECT (LOG_NOM, LOG_PRENOM) FROM LOGIN WHERE LOG_LOGIN='$username'";

$result = executeSQL_GE($sql);

echo $sql;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>SDIS 29 - Fiche Personnel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../lib/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <div id="logo"><img src="../images/logo.jpg" alt="Logo" /></div>
  <div id="banner"><img src="../images/main-image.jpg" alt="Main Image" /></div>
  <div id="nav">
    <ul>
      <li class="nlink"><a href="index.php">ACCUEIL</a></li>
      <li class="nlink"><a href="fiche_personnel.php">PERSONNEL</a></li>
      <li class="nlink"><a href="index.php">FORMATION</a></li>                      
    </ul>
 </div>
  <div id="content">
    <div id="left"> 
    
    <?php 
        
        
    
    ?>
   </div>
    <div id="right">

   </div>
    <div style="clear:both"></div>
 </div>
  <div id="footer"> 
    <p>&copy; SDIS29 2018. All rights reserved.  | designed by <a href="#">Lucas Mionrouge</a></p>
 </div>
</div>
</body>
</html>
