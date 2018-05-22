<?php

$sqlGRADE = "SELECT GRA_LIBELLE,GRADE.GRA_ID FROM GRADE INNER JOIN POMPIER ON GRADE.GRA_ID=POMPIER.GRA_ID WHERE SP_MATRICULE=$matricule";
$resultGRADE = tableSQL($sqlGRADE);

echo "<SELECT id=\"selectGrade\" name=\"listeGrade\" style=\"margin-left:20px;\" size=\"1\">";

foreach ($resultGRADE as $listeGRADE) {
    
    $grade_sp = $listeGRADE['GRA_LIBELLE'];
    $grade_id = $listeGRADE['GRA_ID'];
    echo "<option value=\"$grade_id\">$grade_sp</option>";
}

$sqlttgrade = "SELECT DISTINCT GRA_LIBELLE,GRADE.GRA_ID FROM GRADE";
$resultttgrade = tableSQL($sqlttgrade);

foreach ($resultttgrade as $listeTTGRADE) {
    
    $grade_sp_tt = $listeTTGRADE['GRA_LIBELLE'];
    $grade_id_tt = $listeTTGRADE['GRA_ID'];
    echo "<option value=\"$grade_id_tt\">$grade_sp_tt</option>";
}
echo "</SELECT>";

?>