<?php include 'lib/php/head.php'?>
<?php include 'lib/php/menu.php'?>

<div id="content">
	<div id="pSecond">
		
		<?php if(isset($_GET["Matricule"]) && is_numeric($_GET["Matricule"])){ ?>
			
			<?php
			$matricule = $_GET["Matricule"];
			$sql = "SELECT SP_NOM, SP_PRENOM, DATEDIFF(CURRENT_DATE, SP_DTE_NAISSANCE) AS 'AGE', SP_STATUT, DATE_AFFECTATION, GRA_LIBELLE, CIS_NOM, SP_BIP
                    FROM POMPIER, GRADE, CASERNE WHERE GRADE.GRA_ID = POMPIER.GRA_ID AND POMPIER.CIS_ID = CASERNE.CIS_ID AND SP_MATRICULE=" . $matricule;
			$result = champSQLMultiple($sql);
			$age = round($result["AGE"] / 365.2425, 0);
			
			
			?>
    		<div id="top">
    			<img src="images/pompier_casque.jpg" height="60"/>  
            	<h1><?php echo $result['SP_NOM'] . " " . $result['SP_PRENOM']; ?></h1>
            </div>
    		
    		<div id="persoContent">		
    			<div id="persoContentChild">
    			
    				<div style="margin: 0 60px;">
        				<table style="width: 100%;">	   				
        					<tr>
            					<td align="left">Matricule :</td>
            					<td align="right"><?php echo $matricule ?></td>
        					</tr>
        					<tr>
        						<td></td>	
        						<td align="right"><?php echo $result["CIS_NOM"] ?></td>
        					</tr>
        					<tr>
        						<td></td>	
        						<td align="right"><?php echo $age ?> ans</td>
        					</tr> 		
        				</table>
        			</div>
        			
        			<br /><br />
        			
        			<div style="margin: 0 60px;">
        				<h3>Statut et Grade :</h3>
        				<div style="margin-top: 5px;">
            				<p style="display:inline-block; float: left;"><?php echo $result["SP_STATUT"]; ?></p>
            				<p style="display:inline-block"><?php echo $result["GRA_LIBELLE"]; ?></p>
            				<p style="display:inline-block; float: right;"><?php echo $result["DATE_AFFECTATION"]; ?></p>
        				</div>
        			</div>
        			
        			<br /><br />
        			
        			<div style="margin: 0 60px;">
        				<h3 style="display:inline-block; float: left;"">Recepteur d'alerte :</h3>
        				<p style="display:inline-block; float: right;"><?php echo $result["SP_BIP"]; ?></p>
        			</div>   
        			
        			<br /><br /><br />
        			        			
        			<input onclick="location.href = 'formation.php';" type="button" value="Formation"/>
        			
    			</div>
    			
    			
    			<div id="persoContentChild">
    				<h2>FONCTIONS OCCUPÉES</h2>
    				
    				<div style="margin: 0 40px;">
        				<table style="width: 100%;">									
                            <?php 
                            $sql="SELECT FCT_LIBELLE FROM FONCTION,EXERCER,POMPIER WHERE   FONCTION.FCT_ID=EXERCER.FCT_ID AND  EXERCER.SP_MATRICULE=POMPIER.SP_MATRICULE AND POMPIER.SP_MATRICULE=".$matricule;                    
                            $result = tableSQL( $sql );                    
                            $ligneNumber = 1;
                            
                            foreach($result as $ligne){
                                $idToWrite = ($ligneNumber % 2) + 1;
                                echo "<tr id='row$idToWrite'><td align='left' class='fonction'>";
                            	echo $ligne["FCT_LIBELLE"];
                            	echo "</td></tr>";
                            	
                            	$ligneNumber++;
                            }
                            
                            ?>
                        </table>
                    </div>
    			
    			</div>
    				
    		</div>
    	
    	<?php
        }else{
    	   echo "ERREUR";  
    	}
    	?>
    		
	</div>
</div>
<?php include 'lib/php/footer.php'?>