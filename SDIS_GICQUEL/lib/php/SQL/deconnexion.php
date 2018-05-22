<?php 
    include'../functions.php';
    session_start();
    
    deconnection();
    redirect("../../../login", "Deconnexion reussi !", "green");

?>