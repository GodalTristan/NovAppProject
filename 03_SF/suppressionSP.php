<?php 

require '../lib/php/connectAD.php';

$matricule = $_GET['matriculeSP'];

$sql = "DELETE FROM EXERCER WHERE SP_MATRICULE=$matricule";
$result = executeSQL($sql);
$sql = "DELETE FROM LOGIN WHERE SP_MATRICULE=$matricule";
$result = executeSQL($sql);
$sql2 = "DELETE FROM POMPIER WHERE SP_MATRICULE=$matricule";
$result = executeSQL($sql2);

echo "<meta http-equiv='refresh' content='0,url=catalogue.php?matriculeSP=$matricule&message=<font color=green><b>Les changements ont bien &eacute;t&eacute; pris en compte.</b></font>'>";

?>