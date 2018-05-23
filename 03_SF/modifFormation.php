<?php
session_start();

include '../lib/php/connectAD.php';

if(empty($_SESSION['connectsf'])){
    echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Veuillez vous connecter pour accèder à cette page.</font>'>";
} else {
    
}

$idFormation = $_GET['idFormation'];
$idFonction = $_GET['idFonction'];
$infoFormation="SELECT * FROM FORMATION WHERE FOR_ID='$idFormation'";

$recupInfosFormation = tableSQL($infoFormation);

foreach($recupInfosFormation as $informationsFormation){
    $identifiant = $informationsFormation['FOR_ID'];
    $intitule = $informationsFormation['FOR_LIBELLE'];
    $date_debut = $informationsFormation['FOR_DTE_DEBUT'];
    $date_fin = $informationsFormation['FOR_DTE_FIN'];
    $description = $informationsFormation['FOR_DESCRIPTION'];
    $capacite = $informationsFormation['FOR_CAPACITE'];
    $ville = $informationsFormation['FOR_VILLE'];
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>SDIS 29 - Catalogue / Consultation Fiche</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../lib/css/style_fiche_formation.css" rel="stylesheet" type="text/css" />
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
		<label> Identifiant :</label>
		<br/>
		<br/>
		<label> Intitul&eacute; :</label>
		<br/>
		<br/>
		<label> Date de d&eacute;but :</label>
		<br/>
		<br/>
		<label> Date de fin :</label>
		<br/>
		<br/>
		<label> Description :</label>
		<br/>
		<br/>
		<label> Capacit&eacute; :</label>
		<br/>
		<br/>
		<label> Ville :</label>
		<br/>
		<br/>
		<label> Fonction:</label>
					<form id="modif-perso" name="modif-perso" method="post" >
						<div class="leftdonnees">
							<?php echo $identifiant; ?>
							<br/>
							<br/>
							<input id="intitule" name="intitule" type="text" value="<?php echo $intitule; ?>">
							<br/>
							<br/>
							<input id="date_debut" name="date_debut" type="date" value="<?php echo $date_debut; ?>">
							<br/>
							<br/>
							<input id="date_fin" name="date_fin" type="date" value="<?php echo $date_fin;?>">
							<br/>
							<br/>
							<input id="description" name='description' type="text" value="<?php echo $description; ?>">
							<br/>
							<br/>
							<input id="capacite" name='capacite' type="text" value="<?php echo $capacite; ?>">
							<br/>
							<br/>
							<input id="ville" name='ville' type="text" value="<?php echo $ville; ?>">
							<br/>
							<br/>
							<?php require 'liste_fonctions.php';?>
						</div>
						<div class="leftbutton">
							<br/>
							<button formaction="modif_formation_valider.php?identifiant=<?php echo $identifiant;?>" type="submit" class="buton"><img src = "../images/ok.png"  width="32" height="32">Valider</button>
							<button formaction="formation_liste.php" type="submit" class="buton"><img src = "../images/cancel.png"  width="32" height="32">Annuler</button>
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
