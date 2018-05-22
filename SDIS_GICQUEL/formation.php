<?php include 'lib/php/head.php'?>

<?php include 'lib/php/menu.php'?>

<div id="content">
	<div id="cadre">
	<div id="pSecond"> 
		<?php if($_SESSION['Grade'] == "SP"){ ?>
	<div id ="formulaire">
	<div id="titrefrm">
	<form>
	<legend id="titrefrm">INSCRIPTION AUX FORMATIONS</legend>
	
	</div>
	<br/><br/>
	<div id="imageCasque">
	<img id="imageCasque"src="images/pompier_casque.jpg" title="casque de pompier" height=50 width=50/>
	<?php
	   $sql = "SELECT * FROM POMPIER WHERE SP_MATRICULE=" . $_SESSION ['Matricule'];
	   $result = tableSQL ( $sql );
	   echo $_SESSION ['Nom'] . "  " . $_SESSION ['Prenom'];
	?>	
	
	</div>
	<hr />
	
	<form id="inscription" action="lib/php/SQL/insert.php" method="get">
		<label for="inscription">Formations :</label>
		<select size="1" id="inscription" name="formation"> 	
    		<?php                
             $sql ="SELECT FOR_LIBELLE, FOR_ID FROM FORMATION WHERE FOR_CAPACITE > (SELECT count(SP_MATRICULE) FROM INSCRIRE ORDER BY FOR_ID) AND FOR_LIBELLE NOT IN (SELECT FOR_LIBELLE FROM INSCRIRE, POMPIER, FORMATION WHERE FORMATION.FOR_ID = INSCRIRE.FOR_ID AND POMPIER.SP_MATRICULE = INSCRIRE.SP_MATRICULE AND POMPIER.SP_MATRICULE = ".getMatricule().") ;";
             $result = tableSQL($sql);
              foreach ($result as $ligne){
             
              $libelle = $ligne["FOR_LIBELLE"];
              $forID = $ligne ["FOR_ID"];
              echo "<option value='$forID'>$libelle</option>";   
                }
                echo"<br/><br/>";
            ?>
    	</select>
    	<input id="validation" type="submit" value="Inscription"/>
    </form>
    
    <br/>
    <form id="desinscription" action=".php" method="get">
    <label for="desinscription">Formations :</label>
	<select size="1" id="desinscription" name="formations" > 	
	<?php                
	$sql ="SELECT INSCRIRE.FOR_ID, FOR_LIBELLE FROM FORMATION, INSCRIRE, POMPIER WHERE INSCRIRE.FOR_ID = FORMATION.FOR_ID AND INSCRIRE.SP_MATRICULE = POMPIER.SP_MATRICULE AND POMPIER.SP_MATRICULE = ".getMatricule();
        $result = tableSQL($sql);
        foreach ($result as $ligne){
            
        $libelle = $ligne["FOR_LIBELLE"];
        $forID = $ligne ["FOR_ID"];
        echo "<option value='$forID'>$libelle</option>";   
        }
        echo"<br/><br/>";
    ?>
    
    </select>
    
	<input id="Supprimer" name="Supprimer" type="submit" value="Desincription"/>
	</form>
	
	
	</br>
	
	
    <div id=boutons>
    <input id="annulation" name="Annuler" type="reset" value="Annuler"/>
    </form>
    </div>
	</div>
        <?php }else{?>
        	Vous n'avez pas accès à cette page.
        <?php }?>
  
	</div>
</div>
<?php include 'lib/php/footer.php'?>

