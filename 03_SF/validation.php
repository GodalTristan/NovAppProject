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

$sqlfor = "SELECT * FROM FORMATION ORDER BY FOR_LIBELLE";
$resultfor = tableSQL($sqlfor);

$dateDuJour = date("Y-m-d");

$sqlInscrit = "SELECT * FROM POMPIER INNER JOIN INSCRIRE ON POMPIER.SP_MATRICULE=INSCRIRE.SP_MATRICULE";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>SDIS 29 - Validation</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="../lib/css/style_validation.css" rel="stylesheet" type="text/css" />
	
	
</head>
<body>
<div id="container">
  <div id="logo"><img src="../images/logo.jpg" alt="Logo" /></div>
  <div id="banner"><img src="../images/main-image.jpg" alt="Main Image" /></div>
  <div id="nav">
    <ul>
      <li class="nlink"><a href="index.php">ACCUEIL</a></li>
      <li class="nlink"><a href="<?php echo"fiche_personnel.php?matricule=".$matricule ?>">PERSONNEL</a></li>
       <li class="nlink"><a href="index.php">CATALOGUE</a></li> 
      <li class="nlink"><a href="#">VALIDATION</a></li>
      <li class="nlink"><a href="../connect/disconnect.php">DECONNEXION</a></li>                     
    </ul>
 </div>
  <div id="content">
  <div id="left"> 
   		<?php 
   		
   		    $idFormation = $_GET['idFormation'];
   		    
   		    $sqlTitleValidation = "SELECT * FROM FORMATION WHERE FOR_ID=\"$idFormation\"";
   		    $resultTitleValidation = tableSQL($sqlTitleValidation);
   		    
   		    foreach ($resultTitleValidation as $titleValidation) {
   		        $descriptionFormation = $titleValidation['FOR_DESCRIPTION'];
   		        $dateDFormation = $titleValidation['FOR_DTE_DEBUT'];
   		        $dateFFormation = $titleValidation['FOR_DTE_FIN'];
   		        $forLibelle = $titleValidation['FOR_LIBELLE'];
   		        $formationID = $titleValidation['FOR_ID'];
   		    }
   		    
   		    
            echo "<p id=\"titleFormation\">Formation :";
            echo "<SELECT id=\"selectFormation\" onchange=\"selectionFormation()\" name=\"listeFormation\" style=\"margin-left:20px;\" size=\"1\">";

            if(empty($idFormation)){
                    
                    echo "<option value=\"0\"></option>";
                    
                    foreach ($resultfor as $row) {
                        $dateDFormation = $row['FOR_DTE_DEBUT'];
                        $dateFFormation = $row['FOR_DTE_FIN'];
                        $nomFormation = $row['FOR_LIBELLE'];
                        $formationID = $row['FOR_ID'];
                    
                        if(strtotime($dateDuJour) > strtotime($dateFFormation)){  
                            echo "<option value=\"$formationID\">".$nomFormation."</option>";
                        } else {
                        
                        }
                    }
                } else {
                    echo "<option value=\"0\">".$forLibelle."</option>";
                    
                    foreach ($resultfor as $row) {
                        $dateDFormation = $row['FOR_DTE_DEBUT'];
                        $dateFFormation = $row['FOR_DTE_FIN'];
                        $nomFormation = $row['FOR_LIBELLE'];
                        $formationID = $row['FOR_ID'];
                        
                        if(strtotime($dateDuJour) > strtotime($dateFFormation)){
                            echo "<option value=\"$formationID\">".$nomFormation."</option>";
                        } else {
                            
                        }
                    }    
                   
                }
            echo "</SELECT>";
            
            
        ?>
        
        <script>

        function selectionFormation(){
			var selectElmt = document.getElementById("selectFormation");
			var valeurselectionnee = selectElmt.options[selectElmt.selectedIndex].value;

			document.location="?idFormation="+valeurselectionnee;

        }
		</script>
    </div>
    	<div id="topRight">
      		<img src="../images/casque.png" style="max-width:6%; float:left;"></img>
    		<?php 
    		if(!empty($idFormation)){
    		    $requeteP = "SELECT FOR_LIBELLE FROM FORMATION WHERE FOR_ID=".$idFormation.";";
    		    $resultRequeteP = tableSQL($requeteP);
    		    
    		    foreach($resultRequeteP as $row){
    		        $libelleForm = $row['FOR_LIBELLE'];
    		    }
    		    
    		    echo "<p id=\"titreFichePerso\">".$libelleForm." du ".$dateDFormation." au ".$dateFFormation."</p>";
    		} else {
    		    
    		}
            ?>
    
    	</div>    
    <div id="right">
		<?php
		
		header( 'content-type: text/html; charset=utf-8' );
		$pompierInscrit = "SELECT * FROM POMPIER INNER JOIN INSCRIRE ON POMPIER.SP_MATRICULE=INSCRIRE.SP_MATRICULE INNER JOIN FORMATION ON FORMATION.FOR_ID=INSCRIRE.FOR_ID WHERE INSCRIRE.FOR_ID = $formationID";
		
		if(!empty($idFormation)){
		    
		   $_SESSION['idFormation'] = $formationID;
		    
		   $resultPompierInscrit = tableSQL($pompierInscrit);
		   
		   
		   
		   
		   echo "<p style=\"font-weight:bold; font-size:11px; text-align:center;\">Acces a la fonction $descriptionFormation<br /><br />Personnels Inscrits</p>";
		   echo "<form name=\validForm\" method=\"POST\" action=\"validationFormation.php\"><fieldset>";

		   foreach ($resultPompierInscrit as $rowInscription) {
		       $SP_NOM = $rowInscription['SP_NOM'];
		       $SP_PRENOM = $rowInscription['SP_PRENOM'];
		       $SP_MATRICULE = $rowInscription['SP_MATRICULE'];
		       echo "<label>".strtoupper($SP_NOM)." ".$SP_PRENOM."</label>";
		       
		       echo "	<input type=\"checkbox\" id=\"checkBoxPompier\" name=\"checkBoxPompier[]\" value=\"$SP_MATRICULE\"><br /><br />";
		   }
		   
		   echo "</fieldset>";
		   
		   echo "
            <p class=\"afficheMessage\">Attention, apr&egrave;s validation, les pompiers non selectionn&eacute;s ne seront pas valid&eacute;s et la formation sera supprim&eacute;e (Date d&eacute;pass&eacute;e).</p>
            <input type=\"image\" src=\"../images/valider_formation.png\" alt=\"\" style=\"width:140px; margin-top: 50px;margin-left: 0px;\"\" border=\"0\" alt=\"Submit\" onclick=\"submit\"/>
            </form>
    		<a href=\"index.php\"><img src=\"../images/retour_formation.png\" alt=\"\" style=\"width:140px; margin-top: 50px;margin-left: 5px;\"\" />
    	   </a>";
		} else {
		    
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
