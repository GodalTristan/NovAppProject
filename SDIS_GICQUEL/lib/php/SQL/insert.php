<?php 
    session_start();
    include "connectAD.php";
    include"../functions.php";
    
    
    $forID = $_GET['formation'];
    $sql ="INSERT INTO INSCRIRE (SP_MATRICULE, FOR_ID) VALUES (".getMatricule().",".$forID.");";
    
    executeSQL($sql);
    
    redirect("../../formation.php", "inscription réussi", "green");
?>