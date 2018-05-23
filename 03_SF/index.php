<?php
session_start();

if(empty($_SESSION['connectsf'])){
    echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Veuillez vous connecter en tant que SF pour accèder à cette page.</font>'>";
} else {
   
}

include '../lib/php/connectAD.php';
$username = $_SESSION['connectsf'];

$sql="SELECT * FROM LOGIN WHERE LOG_LOGIN='$username'";
$result = executeSQL_GE($sql);
$donnees = $result->fetch_array(MYSQLI_ASSOC);
$matricule = $donnees['SP_MATRICULE'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>SDIS 29</title>
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
      <li class="nlink"><a href="<?php echo"fiche_personnel.php?matricule=".$matricule ?>">PERSONNEL</a></li>
      <li class="nlink"><a href="catalogue.php">CATALOGUE</a></li> 
      <li class="nlink"><a href="formation_liste.php">FORMATION</a></li>
      <li class="nlink"><a href="validation.php">VALIDATION</a></li>   
      <li class="nlink"><a href="../connect/disconnect.php">DECONNEXION</a></li>                      
    </ul>
 </div>
  <div id="content">
    <div id="left"> 
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
