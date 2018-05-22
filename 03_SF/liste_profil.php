<?php

$sqlPROFIL = "SELECT LOG_PROFIL FROM LOGIN WHERE SP_MATRICULE=$matricule";
$resultPROFIL = tableSQL($sqlPROFIL);

echo "<SELECT id=\"selectProfil\" name=\"listeProfil\" style=\"margin-left:20px;\" size=\"1\">";

foreach ($resultPROFIL as $listePROFIL) {
    
    $log_profil = $listePROFIL['LOG_PROFIL'];
    echo "<option value=\"$log_profil\">$log_profil</option>";
}

$sqlttprof = "SELECT DISTINCT LOG_PROFIL FROM LOGIN";
$resultttprof = tableSQL($sqlttprof);

foreach ($resultttprof as $listeTTPROFIL) {
    
    $log_profil_tt = $listeTTPROFIL['LOG_PROFIL'];
    echo "<option value=\"$log_profil_tt\">$log_profil_tt</option>";
}
echo "</SELECT>";

?>