<?php

class LoginValidation {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function loginUser($email, $password) {
        if (!empty(trim($email)) && !empty(trim($password))) {
            $email = mysqli_real_escape_string($this->con, $email);
            $password = mysqli_real_escape_string($this->con, $password);

            $loginQuery = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $loginQueryRun = mysqli_query($this->con, $loginQuery);

            if (mysqli_num_rows($loginQueryRun) > 0) {
                $row = mysqli_fetch_array($loginQueryRun);

                $_SESSION['authenticated'] = true;
                $_SESSION['auth_user'] = [
                    'User_ID' => $row['User_ID'],
                    'name' => $row['name'],
                    'surname' => $row['surname'],
                    'email' => $row['email']
                ];
                $_SESSION['status'] = "You're logged in successfully";
                $this->redirect("index.php");
            } else {
                $this->setSessionMessage("Invalid Email or Password");
                $this->redirect("registration.php");
            }
        } else {
            $this->setSessionMessage("All fields are mandatory");
            $this->redirect("registration.php");
        }
    }

    private function setSessionMessage($message) {
        $_SESSION['status'] = $message;
    }

    private function redirect($location) {
        header("Location: $location");
        exit(0);
    }
}


session_start();
include('dbcon.php');

if (isset($_POST['login_btn'])) {
    $loginManager = new LoginValidation($con);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginManager->loginUser($email, $password);
}
?>
