<?php

$host = "localhost";
$user = "slam";
$password = "Nov@pp29";
$dbname = "SDIS_DB_PF";
$port = "3306";

$sql="SELECT * FROM LOGIN WHERE LOG_LOGIN='$username' and LOG_MDP='$pass'";

$connexion = mysqli_connect($host, $user, $password, $dbname);

if ($connexion->connect_error) {
    die('Erreur de connexion (' . $connexion->connect_errno . ') '. $connexion->connect_error);
}

echo "Connexion réussie";

$result = $connexion->query($sql)
or die ("Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"]."</b>.<br />
			 Dans le fichier : ".__FILE__." a la ligne : ".__LINE__."<br />".
    mysqli_error_list($connexion)[0]['error'].
    "<br /><br />
				<b>REQUETE SQL : </b>$sql<br />");
echo "Requête".$sql."envoyée";

$result2 = mysqli_affected_rows($result);
echo $result2;
?>