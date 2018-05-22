
<?php include 'lib/php/head.php'?>
<?php include 'lib/php/menu.php'?>

<div id="content">
	<div id="pSecond"> 
		<?php if($_SESSION['Grade'] == "SP" || $_SESSION['Grade'] == "CTA" || $_SESSION['Grade'] == "SF"){ ?>	
<form id="formulaire" action="personnel.php" method="get">
	<fieldset>
<legend>LISTE DES PERSONNELS </legend>
  		<label for="numero" >CIS : </label>
			<?php
			
			$sql = "SELECT * FROM CASERNE";
			$cpt=compteSQL($sql);
			
			if(!isset($_GET["numero"])) $_GET["numero"] = 0;
			
			
			if ($cpt>0) {
				$results = tableSQL($sql);
				echo "<select size=\"1\" name=\"numero\" id=\"numero\">";
				foreach ($results as $row) {
					$selected = "";
					if($_GET["numero"] == $row[0]) $selected = "selected='selected'";
					echo "<option $selected value=$row[0]>$row[1]</option>";
				}
			} else {
				echo "<select size=\"1\" name=\"numero\" id=\"numero\" disabled=\"disabled\" >";
				echo "<option>Aucune information...</option>";
			}
			
			
			echo "</select>";
			
			if (isset($_GET['message']))
				echo $_GET['message'];
				else
					echo "&nbsp;";
					?>
					
		<?php
		
		echo "<br /><br />";
		echo "<table style='margin: 0px auto;'>";

// on va chercher tous les infos de la table test
$sql = "SELECT SP_NOM,SP_PRENOM,SP_MATRICULE FROM POMPIER,CASERNE Where POMPIER.CIS_ID = CASERNE.CIS_ID AND CASERNE.CIS_ID =".$_GET["numero"];

// on recupere le resultat sous forme d'un tableau
$results = tableSQL($sql);

//pour chaque ligne du tableau $resultats
foreach ($results as $ligne) {
	//on extrait chaque valeur de la ligne courante
	$nom = $ligne[0];
	$prenom = $ligne[1];
	$matricule=$ligne[2];
	//on affiche la ligne courante
	echo"<tr>";
	
	echo "<td style='padding-right: 20px'>".$nom." ".$prenom."</td>";
	
	
	echo "<td> <a href=\"editPersonnel.php?Matricule=$matricule\"> <img src=\"images/edittitre16.png\" title=\"Modifier...\" /></a></td>";
	
	echo "<td> <a href=\"lib\php\SQL\supprime.php?Matricule=$matricule\"> <img src=\"images/delete1.png\"  onclick=\"if(!confirm('Voulez-vous Supprimer')) return false;\" title=\"Supprimer...\" /></a><br /></td>";
	
	
	echo "</tr>";


}

echo "</table>";
?>
		</fieldset>
		<br />
        <p>
        	<?php
        		if ($cpt>0)
        			echo "<input id=\"envoyer\" type=\"submit\" value=\"Valider\" title=\"\" />";
        		else
        			echo "<input id=\"envoyer\" type=\"submit\" value=\"Valider\" title=\"\" disabled=\"disabled\" />";
        	?>
	    </p>
	</form>
	 <?php }else{?>
        
        	Vous n'avez pas accés à cette page.
        
        <?php }?>
	</div>
	
</div>
<?php include 'lib/php/footer.php'?>

