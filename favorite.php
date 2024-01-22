<?php
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/trash.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Favorites</title>
</head>
<body>
<?php  
include('dbcon.php'); 
?>
<h1 class='overlay-text2'>Your Favorite List</h1>
<?php
class FavoriteTable
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

    public function displayTable($tableName, $columns, $primaryKey, $userID)
    {
        echo "
        <div class='containerCards'>
            <section class='displayCards'>
                <table>
                    <thead>

                    <th>Card Name</th>
                    <th>Card Image</th>
                    <th>City</th>
                    <th>Action</th>
                    </thead>
                    <tbody>";

        $query = "SELECT * FROM $tableName WHERE user_id = $userID";
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
                    <a href='{$this->generateDeleteLink($tableName, $row[$primaryKey])}' class='delete_card' onclick='return confirm(\"Are you sure you want to remove this card from favorites?\");'><i class='gg-trash'></i></a>
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
$tableDisplay = new FavoriteTable($con);

$favoriteColumns = ['title', 'image_url', 'city_id'];
$tableDisplay->displayTable('user_favorites', $favoriteColumns, 'id', $_SESSION['auth_user']['User_ID']);

?>
</body>
</html>
<?php
include('footer.php');
?>