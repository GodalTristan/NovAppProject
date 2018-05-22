<?php
session_start();

if(!empty($_SESSION['username'])){
    header('Location: admin_index.php');
} else {
    header('Location: login.php');
}
    
?>