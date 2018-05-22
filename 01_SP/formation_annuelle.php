<?php
session_start();

include '../lib/php/connectAD.php';

if(empty($_SESSION['connectsapeur'])){
    echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Veuillez vous connecter pour accèder à cette page.</font>'>";
} else {
    
}

$username = $_SESSION['connectsapeur'];

$sql="SELECT * FROM LOGIN WHERE LOG_LOGIN='$username'";

$result = executeSQL_GE($sql);

$donnees = $result->fetch_array(MYSQLI_ASSOC);

$nom_lower = $donnees['LOG_NOM'];
$nom = strtoupper($nom_lower);
$prenom = $donnees['LOG_PRENOM'];
$matricule = $donnees['SP_MATRICULE'];


$infoFormationSQL = "SELECT * FROM FORMATION INNER JOIN INSCRIRE ON FORMATION.FOR_ID=INSCRIRE.FOR_ID WHERE INSCRIRE.SP_MATRICULE=$matricule";
$resultFormation = tableSQL($infoFormationSQL);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>SDIS 29 - Formation Annuelle</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../lib/css/style_formation.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <div id="logo"><img src="../images/logo.jpg" alt="Logo" /></div>
  <div id="banner"><img src="../images/main-image.jpg" alt="Main Image" /></div>
  <div id="nav">
    <ul>
      <li class="nlink"><a href="index.php">ACCUEIL</a></li>
      <li class="nlink"><a href="<?php echo"fiche_personnel.php?matricule=".$matricule ?>">PERSONNEL</a></li>
      <li class="nlink"><a href="#">FORMATION</a></li>                      
    </ul>
 </div>
  <div id="content">
  <div id="top">
  	<img src="../images/casque.png" style="max-width:6%; float:left;"></img>
    <?php 
       
        echo "<p id=\"titreFichePerso\">".$nom." ".$prenom."</p>";
    
    ?>
  </div>
  <div id="left"> 
	<?php 
	   foreach ($resultFormation as $row) {
	       $for_libelle = $row['FOR_LIBELLE'];
	       $for_description = $row['FOR_DESCRIPTION'];
	       echo "<div id=\"contentFormation\">";
	       echo "<p style=\"font-size:14px; color:black; font-weight:bold; float:left; margin-left:20px;\">".$for_libelle." ".$for_description;
	       echo "</div>";
	   }
	
	?>
    </div>
    <div id="right">
    <?php
        foreach ($resultFormation as $row) {
    	   $date_debut = $row['FOR_DTE_DEBUT'];
	       $date_fin = $row['FOR_DTE_FIN'];
	       $for_salle = $row['FOR_SALLE'];
	       $for_adresse = $row['FOR_ADRESSE'];
	       $for_cp = $row['FOR_CP'];
	       $for_ville = $row['FOR_VILLE'];
	       echo "<div id=\"contentFormation\">";
	       if($date_debut != $date_fin){
	           echo "<p style=\"font-size:14px; color:black; font-weight:bold; left:0;\">du ".$date_debut." au ".$date_fin."    <br />";
	       } else {
	           echo "<p style=\"font-size:14px; color:black; font-weight:bold; left:0;\">le ".$date_debut."    <br />";
	       }
	       echo "<p style=\"font-size:14px; color:black; font-weight:bold; left:0;\">".$for_salle;
	       echo "<p style=\"font-size:14px; color:black; font-weight:bold; left:0;\">".$for_adresse;
	       echo "<p style=\"font-size:14px; color:black; font-weight:bold; left:0;\">".$for_cp." ".$for_ville;
	       
	       echo "</div>";
	      
        }   
        echo "<a href=\"index.php\">
    		<img src=\"../images/retour_formation.png\" alt=\"\" style=\"width:180px; margin-top: 50px;margin-left: -120px;\"\" />
    	</a>";
	?>
    </div>
    <div style="clear:both"></div>
 </div>
  <div id="footer"> 
    <p>&copy; SDIS29 2018. All rights reserved.  | designed by <a href="#">Lucas Mionrouge</a></p>
 </div>
</div>
</body>
</html>
