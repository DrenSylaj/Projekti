<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    if (basename($_SERVER['PHP_SELF']) == 'dashboard.php' || basename($_SERVER['PHP_SELF']) == 'favorite.php') {
        $_SESSION['status'] = "You have to login in order to use the Dashboard";
        header('Location: registration.php');
        exit();
    }
}
?>