<?php

    include '../../lib/php/SQL/connectAD.php';
    
    //les classes sont dans le fichier classe.txt

    $nom = file("caserne.txt");
    // tant que $i est inferieur au nombre d'éléments du tableau...
    for($i=2; $i < 100; $i++) {
        $sql="INSERT INTO CASERNE(CIS_ID,CIS_NOM)
              VALUES ($i,'$nom[$i]')";
        echo "Sql : ".$sql."<br />";
        $result = executeSQL($sql);
    }

?>