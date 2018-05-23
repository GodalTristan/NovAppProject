<?php
session_start();

include '../lib/php/connectAD.php';

if(empty($_SESSION['connectsf'])){
    echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Veuillez vous connecter pour accèder à cette page.</font>'>";
} else {
    
}

$username = $_SESSION['connectsf'];

$infoSP="SELECT * FROM POMPIER INNER JOIN LOGIN ON POMPIER.SP_MATRICULE=LOGIN.SP_MATRICULE WHERE LOG_LOGIN='$username'";

$recupInfosSP = tableSQL($infoSP);

foreach($recupInfosSP as $informationsSP){
    $matricule = $informationsSP['SP_MATRICULE'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>SDIS 29 - Catalogue / Liste des formations</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../lib/css/style_formation_liste.css" rel="stylesheet" type="text/css" />
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
       <li class="nlink"><a href="#">FORMATION</a></li>
      <li class="nlink"><a href="validation.php">VALIDATION</a></li>   
      <li class="nlink"><a href="../connect/disconnect.php">DECONNEXION</a></li>         
    </ul>
 </div>
  <div id="content">
    
  <div id="right">
  		<?php 
  		
  		    $sqlFormation = "SELECT * FROM FORMATION";
  		    $resultFormation = tableSQL($sqlFormation);
  		
  		    echo "<table>";
  		    
  		    foreach($resultFormation as $ligne){        
  		        
  		        echo "<tr><td style=\"font-size:13px; text-align:center; width:220px;\">".strtoupper($ligne['FOR_LIBELLE'])."</td>";
  		        echo "<td style=\"font-size:13px; text-align:center; width:220px;\">".strtoupper($ligne['FOR_DTE_DEBUT'])."</td>";
  		        echo "<td style=\"width:120px; height:35px; text-align:center;\"><a href=\"modifFormation.php?idFormation=".$ligne['FOR_ID']."&idFonction=".$ligne['FCT_ID']."\"><img src=\"../images/tool.png\" style=\"max-height:22px;\"/></a></td>";
  		        echo "<td style=\"width:120px; text-align:center;\"><a href=\"suppressionFormation.php?idFormation=".$ligne['FOR_ID']."\"><img src=\"../images/delete1.png\" style=\"max-height:22px;\"/></a></td></tr>";
  		    }
  		    echo "</table>";
  		    
  		    if (isset($_GET['message']))
  		        echo $_GET['message'];
  		        else
  		            echo "&nbsp;";
  		
  		?>
    	<a href="ajout_formation.php"><img src="../images/ajouter_sp.png" alt="" style="width:140px; margin-top: 50px;margin-left: 5px;" />
    	<a href="index.php"><img src="../images/retour_formation.png" alt="" style="width:140px; margin-top: 50px;margin-left: 5px;" />
  </div>

    <div style="clear:both"></div>
 </div>
  <div id="footer"> 
    <p>&copy; SDIS29 2018. All rights reserved.  | designed by <a href="#">Lucas Mionrouge</a></p>
 </div>
   </div>
</div>
</body>
</html>
