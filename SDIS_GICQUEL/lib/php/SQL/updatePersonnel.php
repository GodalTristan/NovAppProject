<?php 
    
    session_start();
    require_once "connectAD.php";
    require_once "../functions.php";
    
    
    if(isset($_GET)){
        
        $matricule = $_GET["matricule"];
        $nom = $_GET["nom"];
        $prenom = $_GET["prenom"];
        $dateNaiss = $_GET["dateNaissance"];
        $statut = $_GET["statut"];
        $gradeID = $_GET["grade"];
        $dateAffec = $_GET["DATE_AFFECTATION"];
        $recepteur = $_GET["alerte"];
        $telFixe = $_GET["fixe"];
        $telPort = $_GET["portable"];
        $dateObten = $_GET["dateObtention"];
        
        $sql = "UPDATE POMPIER SET
                GRA_ID = $gradeID,
                CIS_ID = '$statut',
                SP_NOM = '$nom',
                SP_PRENOM = '$prenom',
                SP_DTE_NAISSANCE = '$dateNaiss',
                SP_TEL_FIXE = '$telFixe',
                SP_TEL_PORTABLE = '$telPort',
                SP_BIP = '$recepteur',
                SP_STATUT = '$statut',
                DATE_AFFECTATION = '$dateObten'
                WHERE SP_MATRICULE = '$matricule';";
        $result = executeSQL($sql);
        
        if($result)
        	redirectWithGet("../../../personnel","Modification réussite", "green", "Matricule=$matricule");
        else
            redirectWithGet("../../../editPersonnel", "Matricule=$matricule");
        
    }else{
        redirectWithGet("../../../editPersonnel", "");
    }

?>