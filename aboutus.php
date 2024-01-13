<?php
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png">
    <script src="index.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>AboutUs</title>
</head>
<body>
<?php
$query = "SELECT * FROM aboutus";
$query_run = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($query_run);
$description = $row['description'];
$image_background = $row['image_background'];
echo"
    <div class='image-background'>
        <img src='$image_background' alt=''>
        <img src='fotot/' alt=''>
    </div>

    <div class='ripped-paper'>
        <img src='fotot/ripped-paper.png' alt='' class='paper2'>
        <h1 class='overlay-text'>About Us</h1>
    </div>  

    <div class='text-container'>
        <p>$description
        </p>
    </div>
    ";
    ?>
<?php
include('footer.php');
?>
</body>
</html>