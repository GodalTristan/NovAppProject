<?php
session_start();

include '../lib/php/connectAD.php';

if(empty($_SESSION['connectsf'])){
    echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Veuillez vous connecter pour accèder à cette page.</font>'>";
} else {
    
}

$matricule = $_GET['matricule'];
$idCS = $_GET['idCS'];


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
							<input id="matricule" name='matricule' type="text" value="" maxlength="7">
							<br/>
							<br/>
							<input id="Nom" name="Nom" type="text" value="" maxlength="60">
							<br/>
							<br/>
							<input id="Prenom" name="Prenom" type="text" value="" maxlength="60">
							<br/>
							<br/>
							<input id="dateNAISS" name="dateNAISS" type="date" value="">
							<br/>
							<br/>
							<?php 
							
							echo "<SELECT id=\"selectProfil\" name=\"listeProfil\" style=\"margin-left:20px;\" size=\"1\">";
							
							$sqlprofil = "SELECT DISTINCT LOG_PROFIL FROM LOGIN";
							$resultprofil = tableSQL($sqlprofil);
							
							foreach ($resultprofil as $listeProfil) {
							    
							    $log_profil = $listeProfil['LOG_PROFIL'];
							    echo "<option value=\"$log_profil\">$log_profil</option>";
							}
							echo "</SELECT>";
							
							?>
							<br/>
							<br/>
							<?php 
							
							echo "<SELECT id=\"selectStatut\" name=\"listeStatut\" style=\"margin-left:20px;\" size=\"1\">";
							
							$sqlStatut = "SELECT DISTINCT SP_STATUT FROM POMPIER";
							$resultStatut = tableSQL($sqlStatut);
							
							foreach ($resultStatut as $listeStatut) {
							    
							    $statut_sp = $listeStatut['SP_STATUT'];
							    echo "<option value=\"$statut_sp\">$statut_sp</option>";
							}
							echo "</SELECT>";
							
							?>
							<br/>
							<br/>
							<?php

                                echo "<SELECT id=\"selectGrade\" name=\"listeGrade\" style=\"margin-left:20px;\" size=\"1\">";


                                $sqlGrade = "SELECT DISTINCT GRA_LIBELLE,GRADE.GRA_ID FROM GRADE";
                                $resultGrade = tableSQL($sqlGrade);

                                foreach ($resultGrade as $listeGrade) {
    
                                    $grade_sp = $listeGrade['GRA_LIBELLE'];
                                    $grade_id = $listeGrade['GRA_ID'];
                                    echo "<option value=\"$grade_id\">$grade_sp</option>";
                                }
                                echo "</SELECT>";

                            ?>
							<br/>
							<br/>
							<input id="date" name="date" type="date" value="">
							<br/>
							<br/>
							<input id="sp_bip" name='sp_bip' type="text" value="" maxlength="8">
							<br/>
							<br/>
							<input id="num_Fix" name="num_Fix" type="tel" value="" maxlength="10">
							<br/>
							<br/>
							<input id="num_Port" name="num_Port" type="tel" value="" maxlength="10">
						</div>
						<div class="leftbutton">
							<br/>
							<button formaction="ajout_sp_valider.php?idCS=<?php echo $idCS;?>" type="submit" class="buton"><img src = "../images/ok.png"  width="32" height="32">Valider</button>
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
