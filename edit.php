<?php
include 'navbar.php';
include_once('dbcon.php');

class CardUpdater {
    private $con;

    
    public function __construct($con) {
        $this->con = $con;
    }

    public function getCityName($cityId){
        $query = "SELECT emriQytetit FROM cities WHERE city_id = $cityId";
        $result = $this->query($query);

        $cityDetails = mysqli_fetch_assoc($result);
        $cityName = $cityDetails['emriQytetit'];

        return $cityName;
    }

    private function getCityIdByName($cityName) {
        $query = "SELECT city_id FROM cities WHERE emriQytetit = '$cityName'";
        $result = $this->query($query);
    
        $cityDetails = mysqli_fetch_assoc($result);
    
        return $cityDetails ? $cityDetails['city_id'] : null;
    }

    public function getCardDetails($cardId, $cardType){
        $primaryKey = $this->getPrimaryKey($cardType);
        $getCardDetailsQuery = "SELECT * FROM $cardType WHERE $primaryKey = $cardId";
        $result = $this->query($getCardDetailsQuery);

        $cardDetails = mysqli_fetch_assoc($result);

        return $cardDetails;
    }

    public function updateCard($cardId, $cardCity, $cardTitle, $cardDescription, $cardImage, $cardType) {
        $primaryKey = $this->getPrimaryKey($cardType);
        $user_id = $_SESSION['auth_user']['User_ID'];
        $cityId = $this->getCityIdByName($cardCity);

        $updateQuery = "UPDATE $cardType SET title = '$cardTitle', description = '$cardDescription', image_url = '$cardImage', city_id = '$cityId', user_id = '$user_id' WHERE $primaryKey = '$cardId'";
        $this->query($updateQuery);
    }

    private function getPrimaryKey($cardType) {
        switch ($cardType) {
            case 'visit':
                return 'landmark_id';
            case 'eat':
                return 'restaurant_id';
            case 'sleep':
                return 'hotel_id';
            default:
                return '';
        }
    }

    private function query($sql) {
        return mysqli_query($this->con, $sql);
    }

    private function escapeString($string) {
        return mysqli_real_escape_string($this->con, $string);
    }
}

if (isset($_POST['update_btn'])) {
    $cardUpdater = new CardUpdater($con);

    $update_card_id = $_POST['id_update'];
    $update_card_city = $_POST['city_update'];
    $update_card_title = $_POST['title_update'];
    $update_card_description = $_POST['description_update'];
    $update_card_image = $_POST['image_update'];
    $update_card_type = $_POST['type_update'];

    $updateResult = $cardUpdater->updateCard($update_card_id, $update_card_city, $update_card_title, $update_card_description, $update_card_image, $update_card_type);

    if ($updateResult) {
        $_SESSION['statusD'] = "Card updated successfully!";
        $_SESSION['status_type'] = 'success';
    } else {
        $_SESSION['statusD'] = "Error updating card. " . mysqli_error($con);
        $_SESSION['status_type'] = 'error';
    }

    header('Location: dashboard.php');

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


            if (isset($_GET['edit']) && isset($_GET['table'])) {
                $edit_id = $_GET['edit'];
                $table_name = $_GET['table'];

                $cardUpdater = new CardUpdater($con);
                $cardDetails = $cardUpdater->getCardDetails($edit_id, $table_name);

                
                if ($cardDetails) {
                    $image_url = $cardDetails['image_url'];
                    $cityId = $cardDetails['city_id'];
                    $cityName = $cardUpdater->getCityName($cityId);
                    $title = $cardDetails['title'];
                    $description = $cardDetails['description'];
                }
            }
            ?>

            <form action='edit.php' method='POST' enctype='multipart/form-data'>
                <img src='<?php echo $image_url; ?>' alt=''>
                <input type='hidden' name='id_update' value='<?php echo $edit_id; ?>'>
                <input type='hidden' name='edit_table' value='<?php echo $table_name; ?>'>

                <label for=''>City:</label>
                <select name="city_update">
                    <?php
                    $query = "SELECT emriQytetit FROM cities";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $city = $row['emriQytetit'];
                        $selected = ($city == $cityName) ? 'selected' : '';
                        echo "<option value='$city' $selected>$city</option>";
                    }
                    ?>
                </select>

                <input type='hidden' name='type_update' value=<?php echo $table_name; ?>>

                <label for='title'>Title:</label>
                <input type='text' name='title_update' value='<?php echo $title; ?>' required>

                <label for='description'>Description:</label>
                <textarea name='description_update'><?php echo $description; ?></textarea>

                <label for='image'>Insert an Image:</label>
                <input type='text' name='image_update' value='<?php echo $image_url; ?>' required>

                <br>
                <div class='btns'>
                    <button type='submit' name='update_btn'>Update Card</button>
                    <button type='reset' id='close-edit' class='cancel-btn' name='cancel_btn'><a href="dashboard.php">Cancel</a></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php include('footer.php'); ?>
