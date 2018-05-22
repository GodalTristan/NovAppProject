<?php
include '../lib/php/connectAD.php';

$log_nom = 'log_nom.txt';
$tablonomfamille = file($log_nom);

for($i=0;$i<sizeof($tablonomfamille);$i++) {
    
    $sql="SELECT SP_NOM, SP_PRENOM FROM POMPIER WHERE SP_MATRICULE = '$i'";
    $result = executeSQL($sql);
    
    $donnees = $result->fetch_array(MYSQLI_ASSOC);
    
    $log_nom = $donnees['SP_NOM'];
    $log_prenom = $donnees['SP_PRENOM'];
    
    $log_login_form = strtolower($log_nom.substr($log_prenom, 0, 2));
    $log_login=preg_replace('/\s\s+/', '',$log_login_form);
    
    $alea = rand(0, 10);
    
    if ($alea <= 1){
        $log_profil = "CTA";
    } elseif(($alea > 1) && ($alea <= 3)) {
        $log_profil = "SF";
    } else {
        $log_profil = "SP";
    }
    
    $log_mdp_chain = "novapp1234";
    $log_mdp = md5($log_mdp_chain);
    
    $sql2="INSERT INTO LOGIN(LOG_LOGIN, SP_MATRICULE, LOG_MDP, LOG_NOM, LOG_PRENOM, LOG_PROFIL) VALUES ('$log_login', '$i', '$log_mdp', '$log_nom', '$log_prenom', '$log_profil')";
    $result2 = executeSQL_GE($sql2);
    
    echo $sql2;
}

?>
