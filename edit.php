<?php
include 'navbar.php';
include 'dbcon.php';

if (isset($_POST['update_btn'])) {
    $update_card_id = $_POST['id_update'];
    $update_card_city = $_POST['city_update'];
    $update_card_title = $_POST['title_update'];
    $update_card_description = $_POST['description_update'];
    $update_card_image = $_POST['image_update'];

    $update_query = "UPDATE visit SET city_id = '$update_card_city', title = '$update_card_title', description = '$update_card_description', image_url = '$update_card_image' WHERE landmark_id = '$update_card_id'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        $_SESSION['statusD'] = "Card updated successfully!";
        $_SESSION['status_type'] = 'success';
        header('Location:dashboard.php');
        exit();
    } else {
        $_SESSION['statusD'] = "Error updating card. " . mysqli_error($con);
        $_SESSION['status_type'] = 'error';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<link rel="stylesheet" href="test.css">

<body>
    <div class="page">
        <div class="container">
            <?php
            if (isset($_SESSION['statusD'])) {
                $statusMessage = $_SESSION['statusD'];
                $statusClass = ($_SESSION['status_type'] == 'success') ? 'success' : 'error';
                unset($_SESSION['statusD']);
                unset($_SESSION['status_type']);
                echo "<div class='$statusClass'>$statusMessage</div>";
            }

            if (isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $edit_query = "SELECT * FROM visit WHERE landmark_id = $edit_id";
                $edit_query_run = mysqli_query($con, $edit_query);
                if (mysqli_num_rows($edit_query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($edit_query_run)) {
                        $image_url = $row['image_url'];
                        $city_id = $row['city_id'];
                        $title = $row['title'];
                        $description = $row['description'];
                    }
                }
            }
            ?>

            <form action='edit.php' method='POST' enctype='multipart/form-data'>
                <img src='<?php echo $image_url; ?>' alt=''>
                <input type='hidden' name='id_update' value='<?php echo $edit_id; ?>'>

                <label for=''>City:</label>
                <input type='text' value='<?php echo $city_id; ?>' name='city_update'>

                <label for=''>Card Type:</label>
                <select name='type_update' id='type'>
                    <option value='visit'>Places to Visit</option>
                    <option value='sleep'>Places to Sleep</option>
                    <option value='eat'>Places to Eat</option>
                </select>

                <label for='title'>Title:</label>
                <input type='text' name='title_update' value='<?php echo $title; ?>' required>

                <label for='description'>Description:</label>
                <textarea name='description_update'><?php echo $description; ?></textarea>

                <label for='image'>Insert an Image:</label>
                <input type='text' name='image_update' value='<?php echo $image_url; ?>' required>

                <br>
                <div class='btns'>
                    <button type='submit' name='update_btn'>Update Card</button>
                    <button type='reset' id='close-edit' class='cancel-btn' name='cancel_btn'>Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php include('footer.php'); ?>
