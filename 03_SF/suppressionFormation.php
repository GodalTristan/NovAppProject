<?php 

require '../lib/php/connectAD.php';

$idFormation = $_GET['idFormation'];

$sql2 = "DELETE FROM VALIDE WHERE FOR_ID=$idFormation";
$result2 = executeSQL($sql2);
$sql = "DELETE FROM FORMATION WHERE FOR_ID=$idFormation";
$result = executeSQL($sql);


echo "<meta http-equiv='refresh' content='0,url=formation_liste.php?message=<font color=green><b>Les changements ont bien &eacute;t&eacute; pris en compte.</b></font>'>";

?>