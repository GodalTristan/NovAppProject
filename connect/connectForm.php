<?php 
@session_start();

    include '../lib/php/connectAD.php';
   
    $username=$_GET['username'];
    $password=$_GET['password'];
    $pass = md5($password);
    
    $sql="SELECT * FROM LOGIN WHERE LOG_LOGIN='$username' and LOG_MDP='$pass'";
    
    $result = executeSQL_GE($sql);

    if (mysqli_affected_rows($connexion)==0){
        echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=red>Identifiant/Mot de passe incorrect</font>'>";    
    } else {
        
        $donnees = $result->fetch_array(MYSQLI_ASSOC);
        
        if($donnees['LOG_PROFIL'] == "SF"){
            
            $_SESSION['connectsf'] = $username;
            header('Location: ../03_SF/index.php');
            
        } elseif($donnees['LOG_PROFIL'] == "CTA") {
            
            $_SESSION['connectcta'] = $username;
            header('Location: ../02_CTA/index.php');
            
        } else {
            
            $_SESSION['connectsapeur'] = $username;
            header('Location: ../01_SP/index.php');
            
        }
    }
?>