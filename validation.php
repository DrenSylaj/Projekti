<?php

class SignUpValidation {
    private $con;

    public function __construct($con, $name, $surname, $email, $password) {
        $this->con = $con;
    }

    public function registerUser($name, $surname, $email, $password) {
        $verifyToken = md5(rand());

        if (!$this->emailExists($email)) {
            $query = "INSERT INTO users (name, surname, email, password, verify_token) 
                      VALUES ('$name', '$surname', '$email', '$password', '$verifyToken')";

            $queryRun = mysqli_query($this->con, $query);

            if ($queryRun) {
                $this->setSessionMessage("Registration successful.", "success");
            } else {
                $this->setSessionMessage("Registration failed.", "error");
            }
        } else {
            $this->setSessionMessage("Email ID already exists", "error");
        }

        $this->redirect("registration.php");
    }

    private function emailExists($email) {
        $checkEmailQuery = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $checkEmailQueryRun = mysqli_query($this->con, $checkEmailQuery);

        return mysqli_num_rows($checkEmailQueryRun) > 0;
    }

    private function setSessionMessage($message, $type) {
        $_SESSION['status'] = $message;
        $_SESSION['status_type'] = $type;
    }

    private function redirect($location) {
        header("Location: $location");
        exit(0);
    }
}

session_start();
include('dbcon.php');

if (isset($_POST['signup_btn'])) {
    $SignUpValidation = new SignUpValidation($con);

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $SignUpValidation->registerUser($name, $surname, $email, $password);
}
?>
