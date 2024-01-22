<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You have successfully logged out";
$_SESSION['status_type'] = 'success';
header("Location:registration.php");
exit(0);
?>
