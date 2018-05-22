<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>SDIS 29</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="lib/css/style_1.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <div id="logo"><img src="images/logo.jpg" alt="Logo" /></div>
  <div id="banner"><img src="images/main-image.jpg" alt="Main Image" /></div>
  <div id="nav">
    <ul>
      <li class="nlink"><a href="index.html">Accueil</a></li>
    </ul>
 </div>
  <div id="content">
    <div id="left"> 
		<form method="get" action="includes/connectForm.php">
		<fieldset>
			<label for="username">Nom d'utilisateur : </label>
			<input type="text" name="username" id="username"></input><br /><br />
			<label for="password" style="margin-left: 18px;">Mot de passe : </label>
			<input type="password" name="password" id="password"></input><br /><br />
			<input type="submit" name="submit" id="submit" value="Connexion"></input><br /><br />
			
			<?php 
      		    if(isset($_GET['message']))
      		        echo $_GET['message'];
      		    else
      		        echo "&nbsp";
      		?>
		</fieldset>
		</form>		
   </div>
    <div id="right">

   </div>
    <div style="clear:both"></div>
 </div>
  <div id="footer"> 
    <p>&copy; SDIS29 2018. All rights reserved.  | designed by <a href="#">Lucas Mionrouge</a></p>
 </div>
</div>
</body>
</html>
