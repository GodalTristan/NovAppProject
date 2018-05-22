<?php
session_start();

include '../lib/php/connectAD.php';

if(empty($_SESSION['connectsf'])){
    echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Veuillez vous connecter pour accèder à cette page.</font>'>";
} else {
    
}

$matricule = $_GET['matriculeSP'];
$infoSP="SELECT * FROM POMPIER WHERE SP_MATRICULE='$matricule'";

$recupInfosSP = tableSQL($infoSP);

foreach($recupInfosSP as $informationsSP){
    $nom = $informationsSP['SP_NOM'];
    $prenom = $informationsSP['SP_PRENOM'];
    $datenaissance = $informationsSP['SP_DTE_NAISSANCE'];
    $telfixe = $informationsSP['SP_TEL_FIXE'];
    $telportable = $informationsSP['SP_TEL_PORTABLE'];
    $sp_bip = $informationsSP['SP_BIP'];
    $dateobtention = $informationsSP['DATE_AFFECTATION'];
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>SDIS 29 - Catalogue / Consultation Fiche</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../lib/css/style_fiche.css" rel="stylesheet" type="text/css" />
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
      <li class="nlink"><a href="validation.php">VALIDATION</a></li>                  
    </ul>
 </div>
  <div id="content">
  <div id="left">
		<label> Matricule :</label>
		<br/>
		<br/>
		<label> Nom :</label>
		<br/>
		<br/>
		<label> Pr&eacute;nom :</label>
		<br/>
		<br/>
		<label> Date de naissance :</label>
		<br/>
		<br/>
		<label> Profil :</label>
		<br/>
		<br/>
		<label> Statut :</label>
		<br/>
		<br/>
		<label> Grade :</label>
		<br/>
		<br/>
		<label> Date d'obtention :</label>
		<br/>
		<br/>
		<label> R&eacute;cepteur d'alerte :</label>
		<br/>
		<br/>
		<label> T&eacute;l&eacute;phone fixe :</label>
		<br/>
		<br/>
		<label> T&eacute;l&eacute;phone portable :</label>
					<form id="modif-perso" name="modif-perso" method="post" >
						<div class="leftdonnees">
							<input id="matricule" name='matricule' type="text" value="<?php echo $matricule; ?>">
							<br/>
							<br/>
							<input id="Nom" name="Nom" type="text" value="<?php echo $nom; ?>">
							<br/>
							<br/>
							<input id="Prenom" name="Prenom" type="text" value="<?php echo $prenom; ?>">
							<br/>
							<br/>
							<input id="dateNAISS" name="dateNAISS" type="date" value="<?php echo $datenaissance;?>">
							<br/>
							<br/>
							<?php require 'liste_profil.php';?>
							<br/>
							<br/>
							<?php require 'liste_statut.php';?>
							<br/>
							<br/>
							<?php require 'liste_grade.php';?>
							<br/>
							<br/>
							<input id="date" name="date" type="date" value="<?php echo $dateobtention;?>">
							<br/>
							<br/>
							<?php echo $sp_bip; ?>
							<br/>
							<br/>
							<input id="num_Fix" name="num_Fix" type="tel" value="<?php echo $telfixe; ?>">
							<br/>
							<br/>
							<input id="num_Port" name="num_Port" type="tel" value="<?php echo $telportable;?>">
						</div>
						<div class="leftbutton">
							<br/>
							<button formaction="modif_perso_valider.php" type="submit" class="buton"><img src = "../images/ok.png"  width="32" height="32">Valider</button>
							<button formaction="catalogue.php" type="submit" class="buton"><img src = "../images/cancel.png"  width="32" height="32">Annuler</button>
						<br/><br/>
						</div>
					</form>
			</div>

              <?php		   
            
    			if (isset($_GET['message']))
    				echo $_GET['message'];
    			else
    				echo "&nbsp;";
    		?>
	
    <div style="clear:both"></div>
 </div>
  <div id="footer"> 
    <p>&copy; SDIS29 2018. All rights reserved.  | designed by <a href="#">Lucas Mionrouge</a></p>
 </div>
   </div>
</div>
</body>
</html>
