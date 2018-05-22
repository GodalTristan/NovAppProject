<?php

include '../lib/php/connectAD.php';
    
    //-------------------------------------------------------------------------------
    //            On récupère les variables
    //-------------------------------------------------------------------------------

    $matricule=$_POST['matricule'];
    $Nom=$_POST['Nom'];
    $Prenom=$_POST['Prenom'];
    $dateNAISS=$_POST['dateNAISS'];
    $statut=$_POST['listeStatut'];
    $grade=$_POST['listeGrade'];
    $date=$_POST['date'];
    $num_Fix=$_POST['num_Fix'];
    $num_Port=$_POST['num_Port'];
    $profil=$_POST['listeProfil'];
    
    
    /**
     * DEBUG
    
    echo $matricule."<br />";
    echo $Nom."<br />";
    echo $Prenom."<br />";
    echo $dateNAISS."<br />";
    echo $statut."<br />";
    echo $grade."<br />";
    echo $date."<br />";
    echo $num_Fix."<br />";
    echo $num_Port."<br />";
    echo $profil."<br />";
    */

    //-------------------------------------------------------------------------------
    //            On modifie les information
    //-------------------------------------------------------------------------------
    $sql="UPDATE POMPIER SET SP_NOM='$Nom', SP_PRENOM='$Prenom',SP_DTE_NAISSANCE='$dateNAISS', SP_TEL_FIXE='$num_Fix',SP_TEL_PORTABLE='$num_Port',SP_STATUT='$statut',GRA_ID=$grade where SP_MATRICULE=$matricule;";
    $result=executeSQL($sql);
    $sql="UPDATE LOGIN SET LOG_NOM='$Nom', LOG_PRENOM='$Prenom', LOG_PROFIL='$profil' where SP_MATRICULE=$matricule;";
    $result=executeSQL($sql);
    echo "<meta http-equiv='refresh' content='0,url=consultationFiche.php?matriculeSP=$matricule&message=<font color=green><b>Les changements ont bien &eacute;t&eacute; pris en compte.</b></font>'>";

?>