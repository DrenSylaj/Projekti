<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="registration.css">
  <script src="https://kit.fontawesome.com/348e25ce99.js" crossorigin="anonymous"></script>
<body>

<div class='goback'>
<a href="index.php"><i class="fa-solid fa-left-long"></i></a>
</div>
<div class='registration-container'>
<div class="logo-container">
    <div class="logo2">
        <img src="fotot/kosovologo2.png" alt="">
        <?php
        if (!isset($_SESSION['authenticated'])) {
            echo "<h1 class='logoK'><a href='registration.php'>KOSOVA</a></h1>";
        } else {
            echo "<h1 class='logoK'><a href='index.php'>KOSOVA</a></h1>";
        }
        ?>
    </div>
    <div class="tagline">
        <p>Enjoy all the landmarks, hotels and restaurants Kosovo has to offer.</p>
    </div>
</div>
<div class="registration">
    <section class="wrapper">
    <div class="alert">
    <?php
      if (isset($_SESSION['status'])) {
        $statusMessage = $_SESSION['status'];
        $statusClass = ($_SESSION['status_type'] == 'success') ? 'success' : 'error';
        unset($_SESSION['status']);
        unset($_SESSION['status_type']);
        echo "<div class='$statusClass'>$statusMessage</div>";
    }
    ?>  
  </div>
      <div class="form signup">
        <header>Signup</header>
        <form action="validation.php" method="POST" onsubmit="return validateSignupForm();">
          <input type="text" id="signup_name" placeholder="Emri" name="name" required />
          <input type="text" id="signup_surname" placeholder="Mbiemri" name="surname" required />
          <input type="text" id="signup_email" placeholder="Email address" name="email" required />
          <input type="password" id="signup_password" placeholder="Password" name="password" required />
          <div class="checkbox">
            <input type="checkbox" id="signupCheck" />
            <label for="signupCheck">I accept all terms & conditions</label>
          </div>
          <input type="submit" value="Signup" name="signup_btn"/>
        </form>
      </div>
      <div class="form login">
        <header>Login</header>
        <form action="validationL.php" method="POST" onsubmit="return validateLoginForm();">
          <input type="text" id="email" placeholder="Email address" name="email" required />
          <input type="password" id="password" placeholder="Password" name="password" required />
          <a href="#">Forgot password?</a>
          <input type="submit" value="Login" name="login_btn"/>
        </form>
      </div>
<script>
    function validateLoginForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email.trim() === '' || password.trim() === '') {
        alert('Please enter both email and password.');
        return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailRegex.test(email)){
        alert('Please enter a valid email adress.');
        return false;
    }

    return true;
}

function validateSignupForm() {
    var signupName = document.getElementById('signup_name').value;
    var signupSurname = document.getElementById('signup_surname').value;
    var signupEmail = document.getElementById('signup_email').value;
    var signupPassword = document.getElementById('signup_password').value;
    var TermsAgreement = document.getElementById('signupCheck');

    if (signupName.trim() === '' || signupSurname.trim() === '' || signupPassword.trim() === '') {
        alert('Please fill in all required fields.');
        return false;
    }

    if(signupPassword.length < 8){
      alert('Password must be at least 8 characters long');
      return false;
    }

    if(!TermsAgreement.checked){
      alert('You need to accept the terms.');
      return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(signupEmail)) {
        alert('Please enter a valid email address.');
        return false;
    }


    return true;
}

        const wrapper = document.querySelector(".registration .wrapper"),
          signupHeader = document.querySelector(".registration .signup header"),
          loginHeader = document.querySelector(".registration .login header");
        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
        });
      </script>
    </section>
</div>
</div>
</body>
<?php
include('footer.php');
?>
</html>

