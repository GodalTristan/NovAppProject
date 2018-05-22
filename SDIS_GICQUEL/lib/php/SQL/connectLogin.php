<?php
session_start();
require_once "connectAD.php";
require_once "../functions.php";

// redirect("../../../index", "Bienvenue " . $ligne['SP_NOM'] . " " . $ligne['SP_PRENOM'], "green");

if(!empty($_POST['loginName']) && !empty($_POST['loginMdp'])){
    
    $name = $_POST['loginName'];
    $password = $_POST['loginMdp'];
    
    $sql = "SELECT * FROM LOGIN WHERE SP_MATRICULE = '$name'";

    $result = compteSQL($sql);
  
    
    if($result > 0){
        $sql = "SELECT * FROM LOGIN WHERE SP_MATRICULE = $name AND LOG_MDP = '$password'";
       
        $result = compteSQL($sql);
        if($result > 0){
            
            $sql = "SELECT SP_NOM, SP_PRENOM, LOG_PROFIL FROM POMPIER, LOGIN WHERE LOGIN.SP_MATRICULE = POMPIER.SP_MATRICULE AND LOGIN.SP_MATRICULE = $name";
            
            $result = tableSQL($sql);
            foreach ($result as $ligne){
                connectMember($ligne['SP_NOM'], $ligne['SP_PRENOM'], $name, $ligne['LOG_PROFIL']);
                echo $ligne['LOG_PROFIL'];
                redirect("../../../index", "Bienvenue", "green");
            }      
            
        }else{
            redirect("../../../login", "Mauvais Mot de Passe", "red");
        }
    }else{
        redirect("../../../login", "Mauvais Login", "red");
    }
    
}else{
    redirect("../../../login", "Veuillez saisir tous les champs", "yellow");
}



?>