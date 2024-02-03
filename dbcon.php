<?php
class DatabaseConnection {
    private $host;
    private $username;
    private $password;
    private $database;
    private $con;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->con = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (!$this->con) {
            die("Lidhja deshtoi: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->con;
    }

    public function __destruct() {
        if ($this->con) {
            mysqli_close($this->con);
        }
    }
}

$dbConnection = new DatabaseConnection("localhost", "root", "", "projektiKCT");
$con = $dbConnection->getConnection();
?>