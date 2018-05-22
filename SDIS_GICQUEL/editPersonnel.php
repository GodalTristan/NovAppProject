<?php include 'lib/php/head.php'?>
<?php include 'lib/php/menu.php'?>

<div id="content">
	<div id="pSecond"> 
		<?php if(isConnected() && $_SESSION['Grade'] != "SP"){ ?>
			<?php 
			
			 $sql = "SELECT * FROM POMPIER WHERE SP_MATRICULE=".$_GET['Matricule'];
			 $result = tableSQL($sql);
			 foreach($result as $ligne){
			 
			     $matricule = $ligne["SP_MATRICULE"];
			     $nom = $ligne["SP_NOM"];
			     $prenom = $ligne["SP_PRENOM"];
			     $dateNaiss = $ligne["SP_DTE_NAISSANCE"];
			     $statut = $ligne["CIS_ID"];
			     $dateMaj = $ligne["SP_DTE_MAJ"];
			     $gradeID = $ligne["GRA_ID"];
			     $dateAffec = $ligne["DATE_AFFECTATION"];
			     $recepteur = $ligne["SP_BIP"];
			     $telFixe = $ligne["SP_TEL_FIXE"];
			     $telPort = $ligne["SP_TEL_PORTABLE"];
			     $dateObten = $ligne["DATE_PROMOTION"];
			     
			 }
			 
			?>
			
		
			
			
			<form action="lib/php/SQL/updatePersonnel.php" method="get">
				<fieldset>
    				<legend>ÉDITION DE <b><?php echo strtoupper($nom." ".$prenom)?></b></legend>
    				<table style='margin: 0px auto;'>
        				<tr>
            				<td align="right"><label for="matricule">Matricule :</label></td>
            				<td align="left"><input id="matricule" name="matricule"  value="<?php echo $matricule?>" type="text" size="23" maxlength="25" disabled="disabled"/></td>
        				</tr>
        				<tr>
            				<td align="right"><label for="nom">Nom :</label></td>
            				<td align="left"><input id="nom" name="nom" type="text" value="<?php echo $nom?>" size="23" maxlength="25"/></td>
        				</tr>
        				<tr>
            				<td align="right"><label for="prenom">Prénom :</label></td>
            				<td align="left"><input id="prenom" name="prenom" type="text" value="<?php echo $prenom?>" size="23" maxlength="25"/></td>
        				</tr>
    					<tr>
            				<td align="right"><label for="dateNaissance">Date de naissance :</label></td>
            				<td align="left"><input id="dateNaissance" name="dateNaissance" type="date" value="<?php echo $dateNaiss?>" size="50" maxlength="25" style="width:158px;"/></td>
        				</tr>
        				<tr>
            				<td align="right"><label for="statut">Statut :</label></td>
            				<td align="left"><select size="1" id="statut" name="statut" style="width:162px;" >		
                                <?php                
                                    $sql ="SELECT CIS_ID, CIS_NOM FROM CASERNE order by CIS_ID";
                                    $result = tableSQL($sql);
                                    foreach ($result as $ligne){
                                    	$cisID = $ligne["CIS_ID"];
                                    	$nom = $ligne ["CIS_NOM"];
                                    	
                                    	$selected = "";
                                    	if($statut == $cisID) $selected = "selected='selected'";
                                    	
                                    	echo "<option $selected value='$cisID'>".$nom."<br/></option>";
                                    	
                                    }
                                ?>
                            </select></td>
        				</tr>
        				<tr>
            				<td align="right"><label for="grade">Grade :</label></td>
            				<td align="left"><select size="1" id="grade" name="grade" style="width:162px;" >		
                                 <?php                
                                    $sql ="SELECT GRA_ID, GRA_LIBELLE FROM GRADE";
                                    $result = tableSQL($sql);
                                    foreach ($result as $ligne){
                                    	$libelle = $ligne["GRA_LIBELLE"];
                                    	$graID = $ligne ["GRA_ID"];
                                    	
                                    	$selected = "";
                                    	if($gradeID == $graID) $selected = "selected='selected'";
                                    	
                                    	echo "<option $selected value='$graID'>$libelle</option>";
                                    	echo "<br/>";
                                    }
                                 ?>
                     		</select></td>
        				</tr>
        				<tr>
            				<td align="right"><label for="dateObtention">Date d'obtention :</label></td>
            				<td align="left"><input id="dateObtention" name="dateObtention" type="text" value="<?php echo $dateObten?>" size="23" maxlength="25"/></td>
        				</tr>
        				<tr>
            				<td align="right"><label for="alerte">Récepteur d'alerte :</label></td>
            				<td align="left"><input id="alerte" name="alerte" type="text" value="<?php echo $recepteur?>" size="23" maxlength="25"/></td>
        				</tr>
        				<tr>
            				<td align="right"><label for="fixe">Téléphone Fixe :</label></td>
            				<td align="left"><input id="fixe" name="fixe" type="text" value="<?php echo $telFixe?>" size="23" maxlength="25"/></td>
        				</tr>
        				<tr>
            				<td align="right"><label for="portable">Téléphone Portable :</label></td>
            				<td align="left"><input id="portable" name="portable" type="text" value="<?php echo $telPort?>" size="23" maxlength="25"/></td>
        				</tr>
    				</table>
    				 
    				 <br/><br/>
    				 
            		 <input id="envoyer" type="submit" value="Valider" />
    				 <input onclick="location.href = 'personnel.php';" id="annuler" type="button" value="Annuler"/>
    				 
				 </fieldset>
			</form>
		
		
        <?php }else{?>
        	Vous n'avez pas accès à cette page.
        <?php }?>
  
	</div>
	
</div>
<?php include 'lib/php/footer.php'?>

