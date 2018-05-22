<?php

include '../lib/php/connectAD.php';
    

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
    $sp_bip=$_POST['sp_bip'];
    $cis_id=$_GET['idCS'];
    
    
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
    echo $sp_bip."<br />";

    $log_mdp_chain = "novapp1234";
    $log_mdp = md5($log_mdp_chain);
    
    $sql="INSERT INTO POMPIER VALUES($matricule,$grade,$cis_id,'$Nom','$Prenom','$dateNAISS',$num_Fix,$num_Port,$sp_bip,'$statut',$date,'0000-00-00',$date)";    
    $result=executeSQL($sql);
    
    $log_login_form = strtolower($Nom.substr($Prenom, 0, 2));
    $log_login=preg_replace('/\s\s+/', '',$log_login_form);
    
    $sql="INSERT INTO LOGIN VALUES('$log_login',$matricule,'$log_mdp','$Nom','$Prenom','$profil')";
    $result=executeSQL($sql);
    echo "<meta http-equiv='refresh' content='0,url=catalogue.php?idCS=$cis_id&message=<font color=green><b>Les changements ont bien &eacute;t&eacute; pris en compte.</b></font>'>";
?>