<?php
session_start();

if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = "You have to login in order to use the Dashboard";
    header('registration.php');
    exit(0);
}
?>