<?php
session_start();
include_once('dbcon.php');
class SignUpValidation {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function registerUser($name, $surname, $email, $password) {
        $verifyToken = md5(rand());

        if (!$this->emailExists($email)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users (name, surname, email, password, verify_token) 
                      VALUES (?, ?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($this->con, $query);
            mysqli_stmt_bind_param($stmt, 'sssss', $name, $surname, $email, $hashedPassword, $verifyToken);
            
            $queryRun = mysqli_stmt_execute($stmt);

            if ($queryRun) {
                $this->setSessionMessage("Registration successful.", "success");
            } else {
                $this->setSessionMessage("Registration failed.", "error");
            }

            mysqli_stmt_close($stmt);
        } else {
            $this->setSessionMessage("Email ID already exists", "error");
        }

        $this->redirect("registration.php");
    }

    private function emailExists($email) {
        $checkEmailQuery = "SELECT email FROM users WHERE email = ? LIMIT 1";
        $stmt = mysqli_prepare($this->con, $checkEmailQuery);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $result = mysqli_stmt_num_rows($stmt) > 0;

        mysqli_stmt_close($stmt);

        return $result;
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
include('users.php');

if (isset($_POST['signup_btn'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $SignUpValidation = new SignUpValidation($con);
    $users = new users($name, $surname, $email, $password);

    $SignUpValidation->registerUser($name, $surname, $email, $password);
}
?>