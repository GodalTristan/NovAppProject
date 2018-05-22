<?php
include '../lib/php/connectAD.php';

$log_nom = 'log_nom.txt';
$tablonomfamille = file($log_nom);

$log_prenom = 'log_prenom.txt';
$tabloprenom = file($log_prenom);

print_r($tablonomfamille);
print_r($tabloprenom);


for($i=0;$i<sizeof($tablonomfamille);$i++) {
    $gra_id = rand(0, 11);
    $cis_id = rand(0, 62);
    $dte_naissance = rand(1977, 1999)."-".rand(1, 12)."-".rand(1, 31);
    $dte_maj = rand(2014, 2017)."-".rand(1, 12)."-".rand(1, 31);
    $sp_tel_portable = "0".rand(600000000, 699999999);
    $sp_tel_fixe = "0".rand(200000000, 299999999);
    $sp_bip = "029".$cis_id.rand(1,30);
    $dte_promotion = rand(2008, 2017)."-".rand(1, 12)."-".rand(1, 31);
    $dte_affectation= rand(2000, 2007)."-".rand(1, 12)."-".rand(1, 31);
    $sp_statut_alea = rand(1, 10);
    if ($sp_statut_alea <=2){
        $sp_statut = "SPV";
    } else {
        $sp_statut = "SPP";
    }
    
    
    $sql="INSERT INTO POMPIER(SP_MATRICULE, GRA_ID, CIS_ID, SP_NOM, SP_PRENOM, SP_DTE_NAISSANCE, SP_TEL_FIXE, SP_TEL_PORTABLE, SP_BIP, SP_STATUT, SP_DTE_MAJ, DATE_PROMOTION, DATE_AFFECTATION) VALUES ('$i', '$gra_id', '$cis_id', '$tablonomfamille[$i]','$tabloprenom[$i]','$dte_naissance', '$sp_tel_fixe','$sp_tel_portable', '$sp_bip', '$sp_statut', '$dte_maj', '$dte_promotion', '$dte_affectation');";
 echo "Sql : ".$sql."<br />";
 
 $result = executeSQL_GE($sql);
 
 }                                  

?>
