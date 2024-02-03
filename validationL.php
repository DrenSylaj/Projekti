<?php

session_start();
include_once('dbcon.php');

class LoginValidation {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function loginUser($email, $password) {
        if (!empty(trim($email)) && !empty(trim($password))) {
            $email = mysqli_real_escape_string($this->con, $email);

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $loginQuery = "SELECT * FROM users WHERE email = ? LIMIT 1";
            $stmt = mysqli_prepare($this->con, $loginQuery);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['password'])) {
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
                    $this->setSessionMessage("Invalid Email or Password", 'error');
                    $this->redirect("registration.php");
                }
            } else {
                $this->setSessionMessage("Invalid Email or Password", 'error');
                $this->redirect("registration.php");
            }

            mysqli_stmt_close($stmt);
        } else {
            $this->setSessionMessage("All fields are mandatory", 'error');
            $this->redirect("registration.php");
        }
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


if (isset($_POST['login_btn'])) {
    $loginManager = new LoginValidation($con);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginManager->loginUser($email, $password);
}
?>
