<?php 

session_start();

include '../lib/php/connectAD.php';

$idFormation = $_SESSION['idFormation'];


if(!empty($_POST['checkBoxPompier'])){
    foreach($_POST['checkBoxPompier'] as $matricule)
    {
        $suppressionInscription = "DELETE FROM INSCRIRE WHERE SP_MATRICULE=$matricule AND FOR_ID=$idFormation";
        $suppression = executeSQL_GE($suppressionInscription);
        $validationFormation = "INSERT INTO VALIDE VALUES($matricule, $idFormation)";
        $validation = executeSQL_GE($validationFormation);
        
        $ajoutFonctionSQL = "SELECT * FROM FORMATION WHERE FOR_ID=$idFormation";
        $ajoutFonction = tableSQL($ajoutFonctionSQL);
        
        foreach($ajoutFonction as $row){
            $FCT_ID=$row['FCT_ID'];
        }
        
        $ajoutFonctionPompier = "INSERT INTO EXERCER VALUES($matricule, $FCT_ID);";
        $executeAJOUT = executeSQL_GE($ajoutFonctionPompier);
    }
    
    $pompierNonValider = "SELECT * FROM POMPIER INNER JOIN INSCRIRE ON POMPIER.SP_MATRICULE=INSCRIRE.SP_MATRICULE INNER JOIN FORMATION ON FORMATION.FOR_ID=INSCRIRE.FOR_ID WHERE INSCRIRE.FOR_ID = $idFormation";
    $resultNonValider = tableSQL($pompierNonValider);
    
    foreach($resultNonValider as $nomValide){
        $MATRICULE = $nomValide['SP_MATRICULE'];
        
        $deleteSQL = "DELETE FROM INSCRIRE WHERE SP_MATRICULE = $MATRICULE";
        $delete = executeSQL_GE($deleteSQL);
    }
    
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');

}


?>