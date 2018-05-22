<?php include 'lib/php/head.php'?>
<?php include 'lib/php/functions.php'?>
<?php include 'lib/php/menu.php'?>

<div id="pSecond">
	<h1>
	<?php
	$sql = "SELECT * FROM POMPIER WHERE SP_MATRICULE=" . $_SESSION ['Matricule'];
	$result = tableSQL ( $sql );
	echo $_SESSION ['Nom'] . "  " . $_SESSION ['Prenom'];
	?>
	</h1>
Matricule : 
<?php echo $_SESSION['Matricule']."<br />";?>
Caserne : 
<?php
$sql = "SELECT CIS_NOM FROM CASERNE INNER JOIN POMPIER ON CASERNE.CIS_ID=POMPIER.CIS_ID;";
$result = champSQL ( $sql );
echo $result . "<br />";
?>
Age : 
<?php

$sql = "SELECT DATEDIFF(CURRENT_DATE, SP_DTE_NAISSANCE) FROM POMPIER WHERE SP_MATRICULE=" . $_SESSION ['Matricule'];
$result = champSQL ( $sql );
$age = $result / 365.2425;
echo round ( $age, 0 ) . "<br />";
?>

Statut et Grade :
<?php

$sql = "SELECT SP_STATUT FROM POMPIER WHERE SP_MATRICULE=" . $_SESSION ['Matricule'];
$result = champSQL ( $sql );
$sql = "SELECT GRA_LIBELLE FROM GRADE INNER JOIN POMPIER ON GRADE.GRA_ID=POMPIER.GRA_ID;";
$result2 = champSQL ( $sql );
$sql = "SELECT DATE_AFFECTATION FROM POMPIER WHERE SP_MATRICULE=" . $_SESSION ['Matricule'];
$result3 = champSQL ( $sql );

echo "<br /> " . $result . " " . $result2 . " " . $result3 . "<br />";
?>
Recepteur d'alerte :
<?php

$sql = "SELECT SP_BIP FROM POMPIER WHERE SP_MATRICULE=" . $_SESSION ['Matricule'];
$result = champSQL ( $sql );
echo $result;
?>

</div>
