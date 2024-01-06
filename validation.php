<?php
session_start();
include('dbcon.php');

if(isset($_POST['signup_btn'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token = md5(rand());

    $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['status'] = "Email ID already exists";
        $_SESSION['status_type'] = 'error';
        header("Location:registration.php");
    }
    else{
        $query = "INSERT INTO users (name, surname, email, password, verify_token) VALUES ('$name', '$surname', '$email', '$password', '$verify_token')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Registration successful.";
            $_SESSION['status_type'] = 'success';
            header("Location:registration.php");
        }
        else{
            $_SESSION['status'] = "Registration failed.";
            $_SESSION['status_type'] = 'error';
            header("Location:registration.php");
        }
    }
}

?>