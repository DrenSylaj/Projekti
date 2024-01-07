<?php
session_start();
include('dbcon.php');

if (isset($_POST['submit_btn'])) {
    $city_name = $_POST['cities'];
    $type = $_POST['type'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $get_city_id_query = "SELECT city_id FROM cities WHERE emriQytetit = '$city_name' LIMIT 1";
    $get_city_id_query_run = mysqli_query($con, $get_city_id_query);

    if ($get_city_id_query_run && mysqli_num_rows($get_city_id_query_run) > 0) {
        $row = mysqli_fetch_assoc($get_city_id_query_run);
        $city_id = $row['city_id'];

        $check_title_query = "SELECT title FROM $type WHERE title = '$title' LIMIT 1";
        $check_title_query_run = mysqli_query($con, $check_title_query);

        if (mysqli_num_rows($check_title_query_run) > 0) {
            $_SESSION['statusD'] = "The card already exists";
            $_SESSION['status_type'] = 'error';
            header("Location:dashboard.php");
            exit(0);
        } else {
            $query = "INSERT INTO $type (title, description, image_url, city_id) VALUES ('$title', '$description', '$image', '$city_id')";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                $_SESSION['statusD'] = "Card added Successfully";
                $_SESSION['status_type'] = 'success';
                header("Location:dashboard.php");
                exit(0);
            } else {
                $_SESSION['statusD'] = "Card failed to be added";
                $_SESSION['status_type'] = 'error';
                header("Location:dashboard.php");
                exit(0);
            }
        }
    } else {
        $_SESSION['statusD'] = "Selected city not found";
        $_SESSION['status_type'] = 'error';
        header("Location:dashboard.php");
        exit(0);
    }
}
?>
