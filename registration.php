<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <script src="index.js"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins",
    sans-serif;
}
body {
  min-height: 100vh;
  background: #fff;
}

.logo2{
  margin-top: 19px;
  display: flex;
  align-items: center;
  margin-left: 19px;
}

.logo2 img{
  height: 55px;
  width: 50px;
}

.logoK{
  margin-left: 15px;
  color: #D0A650;
}

.registration{
  margin-top: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper {
  position: relative;
  max-width: 470px;
  width: 100%;
  border-radius: 12px;
  padding: 20px
    30px
    120px;
  background: #244AA5;
  box-shadow: 0
    5px
    10px
    rgba(
      0,
      0,
      0,
      0.1
    );
  overflow: hidden;
}
.form.login {
  position: absolute;
  left: 50%;
  bottom: -86%;
  transform: translateX(
    -50%
  );
  width: calc(
    100% +
      220px
  );
  padding: 20px
    140px;
  border-radius: 50%;
  height: 100%;
  background: #fff;
  transition: all
    0.6s
    ease;
}
.wrapper.active
  .form.login {
  bottom: -10%;
  border-radius: 35%;
  box-shadow: 0 -5px
    10px rgba(0, 0, 0, 0.1);
}
.form
  header {
  font-size: 30px;
  text-align: center;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
}
.form.login
  header {
  color: #333;
  opacity: 0.6;
}
.wrapper.active
  .form.login
  header {
  opacity: 1;
}
.wrapper.active
  .signup
  header {
  opacity: 0.6;
}
.wrapper
  form {
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-top: 40px;
}
form
  input {
  height: 60px;
  outline: none;
  border: none;
  padding: 0
    15px;
  font-size: 16px;
  font-weight: 400;
  color: #333;
  border-radius: 8px;
  background: #fff;
}
.form.login
  input {
  border: 1px
    solid
    #aaa;
}
.form.login
  input:focus {
  box-shadow: 0
    1px 0
    #ddd;
}
form
  .checkbox {
  display: flex;
  align-items: center;
  gap: 10px;
}
.checkbox
  input[type="checkbox"] {
  height: 16px;
  width: 16px;
  accent-color: #fff;
  cursor: pointer;
}
form
  .checkbox
  label {
  cursor: pointer;
  color: #fff;
}
form a {
  color: #333;
  text-decoration: none;
}
form
  a:hover {
  text-decoration: underline;
}
form
  input[type="submit"] {
  margin-top: 15px;
  padding: none;
  font-size: 18px;
  font-weight: 500;
  cursor: pointer;
}
.form.login
  input[type="submit"] {
  background: #D0A650;
  color: #fff;
  border: none;
}
    </style>
<body>
<div class="logo2">
<img src="fotot/kosovologo2.png" alt="">
<h1 class="logoK">KOSOVA</h1>
</div>
<div class="registration">
  <div class="alert">
    <?php
      if(isset($_SESSION['status'])){
        echo"<h4>".$_SESSION['status']."</h4>";
        unset($_SESSION['status']);
      }
    ?>
  </div>
    <section class="wrapper">
      <div class="form signup">
        <header>Signup</header>
        <form action="validation.php" method="POST">
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
        <form action="validationL.php" method="POST">
          <input type="text" id="name" placeholder="Email address" name="email" required />
          <input type="password" id="password" placeholder="Password" name="password" required />
          <a href="#">Forgot password?</a>
          <input type="submit" value="Login" name="login_btn"/>
        </form>
      </div>
      <script>
        const wrapper = document.querySelector(".wrapper"),
          signupHeader = document.querySelector(".signup header"),
          loginHeader = document.querySelector(".login header");
        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
        });
      </script>
    </section>
</div>
</body>
</html>
