<?php
    include "ConnectAD.php";
    include"../fonctions.php";

	//on recupere les varirable issue du formulaire
	$matricule = $_GET['Matricule'];
	
	$sql = "DELETE FROM LOGIN WHERE SP_MATRICULE = ".$matricule;
	$result = executeSQL($sql);
	$sql = "DELETE FROM EXERCER WHERE SP_MATRICULE = ".$matricule;
	$result = executeSQL($sql);
	$sql = "DELETE FROM POMPIER WHERE SP_MATRICULE = ".$matricule;
	$result = executeSQL($sql);
	
	echo "oui";
	
	$message = "Supression réussi";
	$color = "green";
	
	if (!$result){
 	    $message = "Erreur de suppression";
 	    $color = "red";
	}

	redirect("../../../personnel.php", $message, $color);
		
?> 