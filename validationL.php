<?php
session_start();
include('dbcon.php');

if(isset($_POST['login_btn'])){

    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0){
            $row = mysqli_fetch_array($login_query_run);

            $_SESSION['authenticated'] = TRUE;
            $_SESSION['auth_user'] = [
                'username' => $row['name'],
                'email' => $row['email']
            ];
            $_SESSION['status'] = "You're logged in succesfully";
            header("Location:index.php");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Invalid Email or Password";
            header("Location:registration.php");
            exit(0);
        }
    }
    else{
        $_SESSION['status'] = "All fields are mandatory";
        header("Location:registration.php");
        exit(0);
    }
}
?>