<?php
session_start();
include('dbcon.php');

if(isset($_POST['submit_btn'])){
    $city_id = $_POST['city_id'];
    $type = $_POST['type'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $check_title_query = "SELECT title FROM $type WHERE title = '$title' LIMIT 1";
    $check_title_query_run = mysqli_query($con, $check_title_query);

    if(mysqli_num_rows($check_title_query_run) > 0){
        $_SESSION['statusD'] = "The card already exists";
        $_SESSION['status_type'] = 'error';
        header("Location:dashboard.php");
        exit(0);
    }
    else{
        $query = "INSERT INTO $type (title, description, image, city_id) VALUES ('$title', '$description', '$image', '$city_id')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['statusD'] = "Card added Successfully";
            $_SESSION['status_type'] = 'success';
            header("Location:dashboard.php");
            exit(0);
        }
        else{
            $_SESSION['statusD'] = "Card failed to be added";
            $_SESSION['status_type'] = 'error';
            header("Location:dashboard.php");
            exit(0);
        }
    }
}
?>
