<?php
session_start();

include '../lib/php/connectAD.php';

if(empty($_SESSION['connectsf'])){
    echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Veuillez vous connecter pour accèder à cette page.</font>'>";
} else {
    
}

$username = $_SESSION['connectsf'];
$idCS = $_GET['idCS'];

$infoSP="SELECT * FROM POMPIER INNER JOIN LOGIN ON POMPIER.SP_MATRICULE=LOGIN.SP_MATRICULE WHERE LOG_LOGIN='$username'";

$recupInfosSP = tableSQL($infoSP);

foreach($recupInfosSP as $informationsSP){
    $matricule = $informationsSP['SP_MATRICULE'];
    $nom = $informationsSP['SP_NOM'];
    $prenom = $informationsSP['SP_PRENOM'];
}

$sqlCASERNE = "SELECT * FROM CASERNE ORDER BY CIS_NOM";
$resultCS = tableSQL($sqlCASERNE);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>SDIS 29 - Catalogue / Inscription aux formations</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../lib/css/style_catalogue.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <div id="logo"><img src="../images/logo.jpg" alt="Logo" /></div>
  <div id="banner"><img src="../images/main-image.jpg" alt="Main Image" /></div>
  <div id="nav">
    <ul>
      <li class="nlink"><a href="index.php">ACCUEIL</a></li>
      <li class="nlink"><a href="<?php echo"fiche_personnel.php?matricule=".$matricule ?>">PERSONNEL</a></li>
       <li class="nlink"><a href="#">CATALOGUE</a></li> 
      <li class="nlink"><a href="validation.php">VALIDATION</a></li>                  
    </ul>
 </div>
  <div id="content">
  <div id="left">
    <script>

    function selectionPompier(){
		var selectElmt = document.getElementById("selectPompier");
		var valeurselectionnee = selectElmt.options[selectElmt.selectedIndex].value;

		document.location="?idPompier="+valeurselectionnee;

    }

    function selectionCS(){
		var selectElmt = document.getElementById("selectCS");
		var valeurselectionnee = selectElmt.options[selectElmt.selectedIndex].value;

		document.location="?idCS="+valeurselectionnee;

    }
    </script>
    
    
    <?php 

           /**
            * CHOIX D'UN CS
            */
    
           $choixCS = $_GET['idCS'];
           
    
           
           if(!is_numeric($choixCS)){

               echo "<SELECT id=\"selectCS\" onchange=\"selectionCS()\" name=\"listeCS\" style=\"margin-left:20px;\" size=\"1\">";
           
               
               echo "<option value=\"0\"></option>";
               
               foreach ($resultCS as $listeCS) {
                   $nomCS = $listeCS['CIS_NOM'];
                   $idCS = $listeCS['CIS_ID'];
                   
                   echo "<option value=\"$idCS\">".$nomCS."</option>";
               }
               
               echo "</SELECT>";
           } else {
             
               $sqlCSP = "SELECT * FROM CASERNE WHERE CIS_ID=$idCS";          
               $resultCSP = tableSQL($sqlCSP);
               
               echo "<SELECT id=\"selectCS\" onchange=\"selectionCS()\" name=\"listeCS\" style=\"margin-left:20px;\" size=\"1\">";
               
               foreach ($resultCSP as $listeCSP) {
               
                   $nomCSID = $listeCSP['CIS_NOM'];
                   echo "<option value=\"0\">$nomCSID</option>";
               }
               
               
               foreach ($resultCS as $listeCS) {
                   $nomCS = $listeCS['CIS_NOM'];
                   $idCS = $listeCS['CIS_ID'];
                   
                   echo "<option value=\"$idCS\">".$nomCS."</option>";
               }
               
               echo "</SELECT>";
           }
           
           
           
    ?>
    
                  <?php		   
            
    			if (isset($_GET['message']))
    				echo $_GET['message'];
    			else
    				echo "&nbsp;";
    		?>
  </div>
  
  <div id="right">
  
  		<?php 
  		
  		if(is_numeric($choixCS)){
  		    $sqlSP = "SELECT * FROM POMPIER INNER JOIN CASERNE ON CASERNE.CIS_ID=POMPIER.CIS_ID WHERE POMPIER.CIS_ID=$choixCS ORDER BY SP_NOM";
  		    $resultSP = tableSQL($sqlSP);
  		
  		    echo "<table>";
  		    
  		    foreach($resultSP as $ligne){        
  		        
  		        echo "<tr><td style=\"font-size:13px; text-align:center; width:200px;\">".strtoupper($ligne['SP_NOM'])." ".$ligne['SP_PRENOM']."</td>";
  		        echo "<td style=\"width:100px; height:50px; text-align:center;\"><a href=\"consultationFiche.php?matriculeSP=".$ligne['SP_MATRICULE']."\"><img src=\"../images/tool.png\" style=\"max-height:22px;\"/></a></td>";
  		        echo "<td style=\"width:100px; text-align:center;\"><a href=\"suppressionSP.php?matriculeSP=".$ligne['SP_MATRICULE']."\"><img src=\"../images/delete1.png\" style=\"max-height:22px;\"/></a></td></tr>";
  		    }
  		    echo "</table>";
  		} else {
  		    
  		}
  		?>
    	<a href="ajout_sp.php?matricule=<?php echo $matricule; ?>&idCS=<?php echo $choixCS;?>"><img src="../images/ajouter_sp.png" alt="" style="width:140px; margin-top: 50px;margin-left: 5px;" />
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
