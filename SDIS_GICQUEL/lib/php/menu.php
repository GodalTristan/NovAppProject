<div id="nav">
  
    <ul>
    
    <?php 
    $menuSTANDARD=array("ACCUEIL" => "index.php");
    $menuSP=array("PERSONNEL" => "personnel.php","FORMATION" => "formation.php");
    $menuCTA=array("PERSONNEL" => "personnel.php");
    $menuSF=array("PERSONNEL" => "personnel.php","CATALOGUE" => "catalogue.php","VALIDATION" => "validation.php");
    
    
    foreach($menuSTANDARD as $menu => $lienMenu){
    	echo '<li class="nlink"><a href="'.$lienMenu.'">'.$menu.'</a></li>';
    }
    
    if (isConnected()){
        echo '<li class="nlink" style="float: right"><a href="lib/php/SQL/deconnexion.php">DECONNEXION</a></li>';
    }
    else{
        echo '<li class="nlink" style="float: right"><a href="login.php">CONNEXION</a></li>';
    }

   
    
    if ($_SESSION['Grade']=='SP'){
    	foreach($menuSP as $menu => $lienMenu){
    		echo '<li class="nlink"><a href="'.$lienMenu.'">'.$menu.'</a></li>';
		}
	}
	ElseIf ($_SESSION['Grade']=='CTA'){
		foreach($menuCTA as $menu => $lienMenu){
			echo '<li class="nlink"><a href="'.$lienMenu.'">'.$menu.'</a></li>';
		}
	}
	ElseIf ($_SESSION['Grade']=='SF'){
		foreach($menuSF as $menu => $lienMenu){
			echo '<li class="nlink"><a href="'.$lienMenu.'">'.$menu.'</a></li>';
		}
	}
   
    ?>
    </ul>
 </div>