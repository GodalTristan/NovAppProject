<?php

include '../lib/php/connectAD.php';
    

$identifiant=$_POST['identifiant'];
$intitule=$_POST['intitule'];
$date_debut=$_POST['date_debut'];
$date_fin=$_POST['date_fin'];
$description=$_POST['description'];
$capacite=$_POST['capacite'];
$ville=$_POST['ville'];
$fonction=$_POST['listeFonction'];
    

if($capacite > 0 && $date_fin > $date_debut){
    
    $sql="INSERT INTO FORMATION VALUES($identifiant,$fonction,'$intitule','$date_debut','$date_fin','$capacite',' ',' ',' ','$ville','$description')";
    $result=executeSQL($sql);
    
    echo "<meta http-equiv='refresh' content='0,url=ajout_formation.php?message=<font color=green><b>Les changements ont bien &eacute;t&eacute; pris en compte.</b></font>'>";
    
    /**
     * DEBUG
     */
    
    /**
    echo $identifiant."<br />";
    echo $intitule."<br />";
    echo $date_debut."<br />";
    echo $date_fin."<br />";
    echo $description."<br />";
    echo $capacite."<br />";
    echo $ville."<br />";
    echo $fonction."<br />";
    */
} else {
    echo "<meta http-equiv='refresh' content='0,url=ajout_formation.php?message=<font color=red><b>Erreur, vous avez mal entr&eacute; les donn&eacute;es.</b></font>'>";
    
}


?>