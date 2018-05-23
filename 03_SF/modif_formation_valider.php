<?php

include '../lib/php/connectAD.php';
    

    $identifiant=$_GET['identifiant'];
    $intitule=$_POST['intitule'];
    $date_debut=$_POST['date_debut'];
    $date_fin=$_POST['date_fin'];
    $description=$_POST['description'];
    $capacite=$_POST['capacite'];
    $ville=$_POST['ville'];
    $fonction=$_POST['listeFonction'];

    
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
    $sql="UPDATE FORMATION SET FOR_LIBELLE='$intitule',FCT_ID=$fonction,FOR_DTE_DEBUT='$date_debut', FOR_DTE_FIN='$date_fin',FOR_CAPACITE='$capacite',FOR_VILLE='$ville',FOR_DESCRIPTION='$description' WHERE FOR_ID=$identifiant;";
    $result=executeSQL($sql);
    echo "<meta http-equiv='refresh' content='0,url=modifFormation.php??idFormation=$identifiant&idFonction=$fonction&message=<font color=green><b>Les changements ont bien &eacute;t&eacute; pris en compte.</b></font>'>";

?>