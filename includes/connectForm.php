<?php 
@session_start();

    $username=$_GET['username'];
    $password=$_GET['password'];
    $pass = md5($password);
    
    $host = "localhost";
    $user = "slam";
    $password = "Nov@pp29";
    $dbname = "SDIS_DB_PF";
    
    $connexion = mysqli_connect($host, $user, $password, $dbname);
    
$sql="SELECT * FROM LOGIN WHERE LOG_LOGIN='$username' and LOG_MDP='$pass'";

$result = mysqli_query($connexion, $sql);

if (mysqli_affected_rows($connexion)==0){
   echo "<meta http-equiv='refresh' content='0;url=../indexconnect.php?message=<font color=red>Identifiant/Mot de passe incorrect</font>'>";    
} else {
    header('Location: ../index.php');
    $_SESSION['connectusername'] = $username;
}
?>