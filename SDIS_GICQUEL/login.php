<?php include 'lib/php/head.php'?>
<?php include 'lib/php/menu.php'?>


<div id="content">
    <div id="pSecond">
    
        <form action="lib/php/SQL/connectLogin.php" method="post">
        
        	<table align="center">
            	<tr>
            		<td align="right"><label for="loginName" id="text" >Identifiant de Connexion :</label></td>
            		<td><input id="loginName" name="loginName" type="text" value="" size="15" maxlength="8"/></td>
            	</tr>
            	
            	<tr>
            		<td align="right"><label for="loginMdp" id="text">Mot de Passe :</label></td>
            		<td><input id="loginMdp" name="loginMdp" type="password" value="" size="15" maxlength="8"/></td>
            	</tr>
        	</table>
        	
            	<br />
            	
        		<?php 
        		if (isset($_GET['message']))
        		    echo "<p id='error'>".strtoupper($_GET['message'])."</p><br />";
        		else 
        			echo"<br /><br />";
        	    ?>
        	    
        		<input id="envoyer" type="submit" value="Connexion"/>
        	</p>
        	
        </form>
    </div>
</div>
<?php include 'lib/php/footer.php'?>