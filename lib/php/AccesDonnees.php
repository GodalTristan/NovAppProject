<?php
/**
 *  Bibliotheque de fonctions AccesDonnees.php
 *
 *
 *
 * @author Erwan
 * @copyright Estran
 * @version 1.3.1 Mercredi 14 Mars 2018
 *
 * ajout de la fonction nombreChamp();
 *
 */

$modeacces = "mysqli";

/**
 *
 * Ouvre une connexion a un serveur MySQL et selectionne une base de donnees.
 * @param host string
 *  <p>Adresse du serveur MySQL.</p>
 * @param port integer
 *  <p>Numero du port du serveur MySQL.</p>
 * @param dbname string
 *  <p>Nom de la base de donnees.</p>
 * @param user string
 *  <p>Nom de l'utilisateur.</p>
 * @param password string
 *  <p>Mot de passe de l'utilisateur.</p>
 *
 *
 * @return resource - Retourne l'identifiant de connexion MySQL en cas de succes
 *         ou FALSE si une erreur survient.
 */
function connexion($host, $port, $dbname, $user, $password) {
    
    global $modeacces, $connexion;
    
    
    if ($modeacces == "mysql") {
        
        @$link = mysql_connect($host,$user,$password)
        or die("Impossible de se connecter : ".mysql_error());
        
        @$connexion = mysql_select_db($dbname)
        or die("Impossible d'ouvrir la base : ".mysql_error());
        
        return $connexion;
        
    }
    
    
    if ($modeacces == "mysqli") {
        
        $connexion = new mysqli("$host", "$user", "$password", "$dbname", $port);
        
        if ($connexion->connect_error) {
            die('Erreur de connexion (' . $connexion->connect_errno . ') '. $connexion->connect_error);
        }
        
        return $connexion;
        
    }
    
    
}


/**
 *
 * Ferme la connexion MySQL.
 *
 */
function deconnexion() {
    
    global $modeacces, $connexion;
    
    
    if ($modeacces == "mysql") {
        
        mysql_close();
        
    }
    
    
    if ($modeacces == "mysqli") {
        
        $connexion->close();
        
    }
}


/**
 *
 *Envoie une requete a un serveur MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return resource - Pour les requetes du type SELECT, SHOW, DESCRIBE, EXPLAIN et
 *          les autres requetes retournant un jeu de resultats, mysql_query()
 *          retournera une ressource en cas de succes, ou DIE en cas d'erreur.
 *
 *          Pour les autres types de requetes, INSERT, UPDATE, DELETE, DROP, etc.,
 *          mysql_query() retourne TRUE en cas de succes ou DIE en cas d'erreur.
 */
function executeSQL($sql) {
    
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        @$result = mysql_query($sql)
        or die ("Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"]."</b>.<br />
			 Dans le fichier : ".__FILE__." a la ligne : ".__LINE__."<br />".
            mysql_error().
            "<br /><br />
				<b>REQUETE SQL : </b>$sql<br />");
            return $result;
    }
    
    if ($modeacces=="mysqli") {
        $result = $connexion->query($sql)
        or die ("Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"]."</b>.<br />
			 Dans le fichier : ".__FILE__." a la ligne : ".__LINE__."<br />".
            mysqli_error_list($connexion)[0]['error'].      //$mysqli->error_list;
            "<br /><br />
				<b>REQUETE SQL : </b>$sql<br />");
            return $result;
    }
}


/**
 *
 *Envoie une requete a un serveur MySQL laisse le programmeur Gerer les Erreurs.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return resource - Pour les requetes du type SELECT, SHOW, DESCRIBE, EXPLAIN et
 *          les autres requetes retournant un jeu de resultats, mysql_query()
 *          retournera une ressource en cas de succes, ou FALSE en cas d'erreur.
 *
 *          Pour les autres types de requetes, INSERT, UPDATE, DELETE, DROP, etc.,
 *          mysql_query() retourne TRUE en cas de succes ou FALSE en cas d'erreur.
 */
function executeSQL_GE($sql) {
    
    global $modeacces, $connexion;
    
    
    if ($modeacces=="mysql") {
        $result = mysql_query($sql);
        
    }
    
    if ($modeacces=="mysqli") {
        $result = $connexion->query($sql);
    }
    
    return $result;
}


/**
 *
 *Retourne le texte associe avec l'erreur generee lors de la derniere requete
 *
 *
 * @return string - Chaine de carateres bien formatee.
 */
function erreurSQL() {
    
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        return mysql_error();
    }
    
    if ($modeacces=="mysqli") {
        //$mysqli->error_list;
        return mysqli_error_list($connexion)[0]['error'];
    }
    
}


/**
 *
 *Retourne le nombre de lignes d'une requete MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return integer - Le nombre de lignes dans un jeu de resultats en cas de succes
 *         ou FALSE si une erreur survient.
 */
function compteSQL($sql) {
    
    global $modeacces, $connexion;
    
    $result = executeSQL($sql);
    
    if ($modeacces=="mysql") {
        $num_rows = mysql_num_rows($result);
    }
    
    if ($modeacces=="mysqli") {
        $num_rows = $connexion->affected_rows;
    }
    
    return $num_rows;
    
}


/**
 *
 *Retourne un tableau resultat d'une requete SQL
 * @param $sql string
 * 		<p>Requete SQL</p>
 *
 * @return array Tableau indexe et associatif resultat de la requete SQL
 *
 * <br/>
 * @example
 <code>
 $sql = "select * from user";				<br />
 $results = tableSQL($sql);					<br />
 foreach ($results as $row) {				<br />
 &nbsp;&nbsp;$login = $row['login'];		<br />
 &nbsp;&nbsp;$password = $row[3];			<br />
 &nbsp;&nbsp;echo $login." ".$password; 	<br />
 }											<br />
 </code>
 */
function tableSQL($sql) {
    
    global $modeacces, $connexion;
    
    $result = executeSQL($sql);
    $rows=array();
    
    if ($modeacces=="mysql") {
        while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
            array_push($rows,$row);
        }
    }
    
    if ($modeacces=="mysqli") {
        while ($row = $result->fetch_array(MYSQLI_BOTH)) {
            array_push($rows,$row);
        }
    }
    
    return $rows;
    
}


/**
 *
 *Retourne un seul champ resultat d'une requete MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return string - une chaine resultat de la requete MySQL.
 */
function champSQL($sql) {
    
    global $modeacces, $connexion;
    
    $result = executeSQL($sql);
    
    if ($modeacces=="mysql") {
        $rows = mysql_fetch_array($result, MYSQL_NUM);
    }
    
    
    if ($modeacces=="mysqli") {
        $rows = $result->fetch_array(MYSQLI_NUM);
        
    }
    
    return $rows[0];
}


/**
 *
 *Retourne le nombre de champs d'un resultat MySQL.
 * @param sql string
 *  <p>Requete SQL.</p>
 *
 *
 * @return integer - Retourne le nombre de champs d'un jeu de resultat en cas de succes
 *                   ou FALSE si une erreur survient.
 */
function nombreChamp($sql) {
    
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        $result = executeSQL($sql);
        return  mysql_num_fields($result);
    }
    
    if ($modeacces=="mysqli") {
        $result = executeSQL($sql);
        return mysqli_num_fields($result);
    }
    
}


/**
 *
 *Retourne le nom d'une colonne MySQL specifique
 * @param sql string
 *  <p>Requete SQL.</p>
 * @param field_offset integer
 *  <p>La position numerique du champ. field_offset commence a  0. Si field_offset
 *     n'existe pas, une alerte E_WARNING sera egalement generee.</p>
 *
 *
 * @return string - Retourne le nom du champ d'une colonne specifique
 *
 */
function nomChamp($sql,$field) {
    
    global $modeacces, $connexion;
    
    if ($modeacces=="mysql") {
        $result = executeSQL($sql);
        return mysql_field_name($result,$field);
    }
    
    if ($modeacces=="mysqli") {
        $result = executeSQL($sql);
        $infos = $result->fetch_field_direct($field);
        return $infos->name;
    }
    
}




?>