<?php
session_start();

include '../lib/php/connectAD.php';

if(empty($_SESSION['connectsf'])){
    echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Veuillez vous connecter pour accèder à cette page.</font>'>";
} else {
    
}

$username = $_SESSION['connectsf'];

$sql="SELECT * FROM LOGIN WHERE LOG_LOGIN='$username'";

$result = executeSQL_GE($sql);

$donnees = $result->fetch_array(MYSQLI_ASSOC);

$nom_lower = $donnees['LOG_NOM'];
$nom = strtoupper($nom_lower);
$prenom = $donnees['LOG_PRENOM'];
$matricule = $donnees['SP_MATRICULE'];

$requeteCIS = "SELECT CIS_NOM FROM CASERNE INNER JOIN POMPIER ON POMPIER.CIS_ID = CASERNE.CIS_ID INNER JOIN LOGIN ON LOGIN.SP_MATRICULE = POMPIER.SP_MATRICULE WHERE POMPIER.SP_MATRICULE = '$matricule'";
$resultCIS = executeSQL_GE($requeteCIS);
$donneesCIS = $resultCIS->fetch_array(MYSQLI_ASSOC);
$caserne = $donneesCIS['CIS_NOM'];

$infoPompier="SELECT * FROM POMPIER WHERE SP_NOM = '$nom'";
$resultPOMPIER = executeSQL_GE($infoPompier);
$donneesPOMPIER = $resultPOMPIER->fetch_array(MYSQLI_ASSOC);
$dateNaissance = $donneesPOMPIER['SP_DTE_NAISSANCE'];
$sp_bip = $donneesPOMPIER['SP_BIP'];
$age = round((time() - strtotime($dateNaissance)) / 3600 / 24 / 365);

if($donneesPOMPIER['SP_STATUT'] == "SPP"){
    $statut = "Professionnel";
} else {
    $statut = "Volontaire";
}

$requeteGRADE = "SELECT GRA_LIBELLE FROM GRADE INNER JOIN POMPIER ON GRADE.GRA_ID = POMPIER.GRA_ID WHERE SP_MATRICULE = '$matricule'";
$resultGRADE = executeSQL_GE($requeteGRADE);
$donneesGRADE = $resultGRADE->fetch_array(MYSQLI_ASSOC);
$grade = $donneesGRADE['GRA_LIBELLE'];
$dateAffectation = $donneesPOMPIER['DATE_AFFECTATION'];


$sqlfct = "SELECT * FROM EXERCER INNER JOIN FORMATION ON FORMATION.FCT_ID=EXERCER.FCT_ID WHERE SP_MATRICULE='$matricule' ORDER BY FORMATION.FOR_LIBELLE";
$resultfct = tableSQL($sqlfct);

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
      <li class="nlink"><a href="#">PERSONNEL</a></li>
       <li class="nlink"><a href="catalogue.php">CATALOGUE</a></li> 
      <li class="nlink"><a href="formation_liste.php">FORMATION</a></li>
      <li class="nlink"><a href="validation.php">VALIDATION</a></li>   
      <li class="nlink"><a href="../connect/disconnect.php">DECONNEXION</a></li>                    
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
            echo "<p id=\"titleLeft\">Matricule : </p><p id=\"textRight\">".$matricule."</p>";
            echo "<br /><p id=\"textRight\">".$caserne."</p>";
            echo "<br /><p id=\"textRight\">".$age." ans</p>";
            echo "<br /> <br /> <br /> <p id=\"titleLeft\">Statut et Grade : </p><br />";
            echo "<b><p id=\"statutsPersonnel\">$statut $grade $dateAffectation</p></b>";
            echo "<br /> <br /> <br /> <p id=\"titleLeft\">Récepteur d'alerte : </p><p id=\"textRight\">$sp_bip</p><img src=\"../images/telephonePersonnel.png\" alt=\"\" style=\"width:40px;position: absolute;margin-left: 250px;margin-top: -25px;\"></img><br />";
        ?>
        
        <?php 
        if(empty($_SESSION['connectsf'])){
            
        } else {
            echo "<input type=\"button\" id=\"buttonFormation\" name=\"buttonFormation\" value=\"Formation\"/>";
        }
        ?>
    </div>
    
    <div id="right">
		<p style="font-size:13px;">Fonctions occupées</p><br /><br /><br />
		
		<?php 
		
		foreach ($resultfct as $row) {
		   $fonctionsOccupee = $row['FCT_ID'];
		   $libelleFct = "SELECT FCT_LIBELLE FROM FONCTION INNER JOIN EXERCER ON EXERCER.FCT_ID=FONCTION.FCT_ID WHERE FONCTION.FCT_ID=$fonctionsOccupee";
		   if(!empty($libelleFct)){
		       $resultLibelle = executeSQL_GE($libelleFct);
		       $donneesFONCTION = $resultLibelle->fetch_array(MYSQLI_ASSOC);
		       $fonctionLibelle = $donneesFONCTION['FCT_LIBELLE'];
		       
		       echo "<p style=\"font-size:13px; text-align:left;\">".$fonctionLibelle."</p><br />";
		   } else {
		       echo "<p style=\"font-size:13px; text-align:left;\">Aucune fonction disponible pour ce sapeur-pompier.</p><br />";
		   }
		    
		}
		
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
