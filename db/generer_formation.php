<?php

include '../lib/php/connectAD.php';

$sql="SELECT * FROM LOGIN";

$results = tableSQL($sql);


foreach ($results as $row) {
    $matricule = $row['SP_MATRICULE'];
    $fct1 = rand(0, 1);
    $fct2 = rand(3, 16);
    $fct3 = rand(18, 24);
    $fct4 = rand(28, 29);
    $sqlfct = "INSERT INTO EXERCER (SP_MATRICULE, FCT_ID) VALUES ($matricule, $fct2);";
    $result = executeSQL($sqlfct);
    echo $sqlfct;
}
