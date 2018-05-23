<?php 
session_start();
session_destroy();

echo "<meta http-equiv='refresh' content='0;url=../login.php?message=<font color=green>Vous vous &ecirc;tes d&eacute;connect&eacute;.</font>'>";
?>