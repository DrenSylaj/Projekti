<?php
session_start();
include('navbar.php');
include_once('dbcon.php');

$user_id = $_SESSION['auth_user']['User_ID'];

$query = "SELECT * FROM admins WHERE user_id = $user_id";
$result = mysqli_query($con, $query);

if (!($result && mysqli_num_rows($result) > 0)) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/trash.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/edit-flip-v.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Dashboard</title>
    <style>
        <?php
        if(isset($_SESSION['auth_user']) && $_SESSION['auth_user']){
            echo "@media only screen and (max-width: 600px) {";
            echo ".card-number, .containerCards th:nth-child(1), .containerCards td:nth-child(1) { display: none !important; }";
            echo ".card-uID, .containerCards th:nth-child(5), .containerCards td:nth-child(5) { display: none !important;";
            echo "}";
        }
        ?>
    </style>
</head>
<body>
    <div class="forms">
    <div class="container">
    <div class="user_dashboard">
    <h1>ID: <span class="displayed"><?=$_SESSION['auth_user']['User_ID']?><span></h1>
    <h1>Name: <span class="displayed"><?= $_SESSION['auth_user']['name']?></span></h1>
    <h1>Surname: <span class="displayed"><?= $_SESSION['auth_user']['surname']?></span></h1>
    <h1>Email: <span class="displayed"><?= $_SESSION['auth_user']['email']?></span></h1>
    </div>
    </div>

        <div class="container">
    <?php
        if(isset($_SESSION['statusD'])){
            $statusMessage = $_SESSION['statusD'];
            $statusClass = ($_SESSION['status_type'] == 'success') ? 'success' : 'error';
            unset($_SESSION['statusD']);
            unset($_SESSION['status_type']);
            echo "<div class='$statusClass'>$statusMessage</div>";
        }
    ?>
    <form action="add_card.php" method="POST">
    <label for="">City:</label>
        <select name="cities" id="cities">
        <?php
        $query = "SELECT emriQytetit FROM cities";
        $result = mysqli_query($con, $query);

        $qyteti = [];
        while($row = mysqli_fetch_assoc($result)){
            $qyteti[] = $row['emriQytetit'];
        }
        foreach($qyteti as $cityName){
            echo"<option value='$cityName' name='$cityName'>$cityName</option>";
        }   
        ?>    
        </select>
        <label for="">Card Type:</label>
        <select name="type" id="type">
            <option value="visit" name="placesToVisit">Places to Visit</option>
            <option value="sleep" name="placesToSleep">Places to Sleep</option>
            <option value="eat" name="placesToEat">Places to Eat</option>
        </select>
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="description">Description:</label>
        <textarea name="description"></textarea>

        <label for="image">Insert an Image:</label>
        <input type="file" name="image" required>

        <br><button type="submit" name="submit_btn">Add Card</button>
    </form>
    </div>
    </div>
<?php    
class TableDisplay
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function generateDeleteLink($tableName, $primaryKeyValue)
        {
            return "delete.php?table=$tableName&delete=$primaryKeyValue";
        }    
        
    public function generateEditLink($tableName, $primaryKeyValue)
        {
            return "edit.php?table=$tableName&edit=$primaryKeyValue";
        }

    public function displayTable($tableName, $columns, $primaryKey)
    {
        echo "
        <div class='containerCards'>
            <section class='displayCards'>
                <table>
                    <thead>

                    <th class='card-number'>Card Number</th>
                    <th>Card Image</th>
                    <th>Card Name</th>
                    <th>City</th>
                    <th class='card-uID'>User ID</th>
                    <th>Action</th>
                    </thead>
                    <tbody>";

        $query = "SELECT * FROM $tableName";
        $query_run = mysqli_query($this->con, $query);

        if ($query_run) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                echo "<tr>";

                foreach ($columns as $column) {
                    $value = $row[$column];

                    if ($column === 'city_id') {
                        $cityName = $this->getCityName($value);
                        echo "<td>$cityName</td>";
                    } elseif ($column === 'image_url') {
                        echo "<td><img src='$value' alt='Card Image' style='width: 50px;'></td>";
                    } else {
                        echo "<td>$value</td>";
                    }
                }

                echo "
                    <td>
                    <div class='icons'>
                    <a href='{$this->generateDeleteLink($tableName, $row[$primaryKey])}' class='delete_card' onclick='return confirm(\"Are you sure you want to delete this card?\");'><i class='gg-trash'></i></a>
                    <a href='{$this->generateEditLink($tableName, $row[$primaryKey])}' class='edit_card'><i class='gg-edit-flip-v'></i></a>
                  </div>
                    </td>
                </tr>";
            }
        }

        echo "
            </tbody>
        </table>
        </section>
        </div>";
    }

    private function getCityName($cityId)
    {
        $query = "SELECT emriQytetit FROM cities WHERE city_id = $cityId";
        $result = mysqli_query($this->con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['emriQytetit'];
        }

        return ''; 
    }
}

$tableDisplay = new TableDisplay($con);

$visitColumns = ['landmark_id', 'image_url', 'title', 'city_id', 'user_id'];
$tableDisplay->displayTable('visit', $visitColumns, 'landmark_id');

$sleepColumns = ['hotel_id', 'image_url', 'title', 'city_id', 'user_id'];
$tableDisplay->displayTable('sleep', $sleepColumns, 'hotel_id');

$eatColumns = ['restaurant_id', 'image_url', 'title', 'city_id', 'user_id'];
$tableDisplay->displayTable('eat', $eatColumns, 'restaurant_id');

?>
</body>
<?php
include('footer.php');
?>
</html>

