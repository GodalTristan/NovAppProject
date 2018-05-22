<?php

$sqlSTATUT = "SELECT SP_STATUT FROM POMPIER WHERE SP_MATRICULE=$matricule";
$resultSTATUT = tableSQL($sqlSTATUT);

echo "<SELECT id=\"selectStatut\" name=\"listeStatut\" style=\"margin-left:20px;\" size=\"1\">";

foreach ($resultSTATUT as $listeSTATUT) {
    
    $statut_sp = $listeSTATUT['SP_STATUT'];
    echo "<option value=\"$statut_sp\">$statut_sp</option>";
}

$sqlttstatut = "SELECT DISTINCT SP_STATUT FROM POMPIER";
$resultttstatut = tableSQL($sqlttstatut);

foreach ($resultttstatut as $listeTTSTATUT) {
    
    $statut_sp_tt = $listeTTSTATUT['SP_STATUT'];
    echo "<option value=\"$statut_sp_tt\">$statut_sp_tt</option>";
}
echo "</SELECT>";

?>