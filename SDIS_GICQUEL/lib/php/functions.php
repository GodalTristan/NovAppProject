<?php

    function connectMember($nom, $prenom, $matricule, $grade){
        $_SESSION['Logged'] = "true";
        $_SESSION['Nom'] = $nom;
        $_SESSION['Prenom'] = $prenom;
        $_SESSION['Matricule'] = $matricule;
        $_SESSION['Grade'] = $grade;
    }
    
    function redirect($nomPage, $messageText, $colorMessage = "red", $getName = "message"){
        //echo "<meta http-equiv='refresh' content='0;url=$nomPage.php?$message=<font id=\"message\" color=$colorMessage>$messageText</font>'>";
        //echo "Location: " . $nomPage . ".php?" . $message ."=<font color='" . $colorMessage . "'>" . $messageText . "</font>";
        header("Location: " . $nomPage . ".php?" . $getName ."=<font color='" . $colorMessage . "'>" . $messageText . "</font>");
        exit;
    }
    
    function redirectWithGet($nomPage, $getMessage){
        header("Location: " . $nomPage . ".php?" . $getMessage);
        exit;
    }
    
    function pompier(){
        
        $pompier = array();
        $pompier["NOM"] = $_SESSION['Nom'];
        $pompier["PRENOM"] = $_SESSION['Prenom'];
        $pompier["MATRI"] = $_SESSION['Matricule'];
        $pompier["GRADE"] = $_SESSION['Grade'];
        return $pompier;
    }
    
    function isConnected(){
        return isset($_SESSION['Logged']) || $_SESSION['Logged'] == true;
    }
    
    function getMatricule(){
        return $_SESSION['Matricule'];
    }
    
    function Deconnection(){
        if(isConnected()){
            unset($_SESSION['Logged']);
            unset($_SESSION['Nom']);
            unset($_SESSION['Prenom']);
            unset($_SESSION['Matricule']);
            unset($_SESSION['Grade']);
        }
    }

?>