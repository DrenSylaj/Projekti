<?php
include 'dbcon.php';

class Delete {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function deleteRecord($tableName, $deleteId) {
        $primaryKey = $this->getPrimaryKey($tableName);

        if ($primaryKey) {
            $deleteQuery = "DELETE FROM $tableName WHERE $primaryKey = ?";
            $stmt = mysqli_prepare($this->con, $deleteQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $deleteId);
                $deleteQueryRun = mysqli_stmt_execute($stmt);

                if ($deleteQueryRun) {
                    header('Location: dashboard.php');
                } else {
                    echo "Error: " . mysqli_error($this->con);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error in preparing the delete statement: " . mysqli_error($this->con);
            }
        } else {
            echo "Primary key not found for table: $tableName";
        }
    }

    private function getPrimaryKey($tableName) {
        $result = mysqli_query($this->con, "SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'");

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['Column_name'];
        }

        return null;
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $tableName = isset($_GET['table']) ? $_GET['table'] : '';

    $Delete = new Delete($con);
    $Delete->deleteRecord($tableName, $delete_id);
}
?>
