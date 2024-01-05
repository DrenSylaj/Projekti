<?php
include('authentication.php');
?>

<link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png">
    <style src="index.js"></style>
<nav>
    <div class="nav-bar">
        <i class='bx bx-menu sidebarOpen' ></i>
        <div class="logo-KS">
          <div>
            <img src="fotot/Emblem_of_the_Republic_of_Kosovo.svg.png" alt="logo" class="logo">
          </div>
          <span class="logo navLogo"><a href="#">KOSOVA</a></span>
        </div>
        <div class="menu">
            <div class="logo-toggle">
                <span class="logo"><a href="#">Dardania</a></span>
                <i class='bx bx-x siderbarClose'></i>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">HOME</a></li>
                <div class="dropdown">
                  <button class="dropbtn">CITIES
                    <i class="fa fa-caret-down"></i>
                  </button>
                  <div class="dropdown-content">
                    <a href="city.php?selectedCity=Prishtina">Prishtina</a>
                    <a href="city.php?selectedCity=Prizreni">Prizreni</a>
                    <a href="city.php?selectedCity=Peja">Peja</a>
                    <a href="city.php?selectedCity=Gjakova">Gjakova</a>
                    <a href="city.php?selectedCity=Ferizaji">Ferizaji</a>
                    <a href="city.php?selectedCity=Mitrovica">Mitrovica</a>
                    <a href="city.php?selectedCity=Gjilani">Gjilani</a>
                  </div>
                </div> 
                <li><a href="aboutus.html">ABOUT US</a></li>
                <li><a href="dashboard.php">DASHBOARD</a></li>
                <?php if(!isset($_SESSION['authenticated'])) :?>
                <li><a href="registration.php">LOG IN</a></li>
                <?php endif ?>

                <?php if(isset($_SESSION['authenticated'])) :?>
                <li><a href="logout.php">LOG OUT</a></li>
                <?php endif ?>
            </ul>
        </div>
        <div class="darkLight-searchBox">
            <div class="dark-light">
                <i class='bx bx-moon moon'></i>
                <i class='bx bx-sun sun'></i>
            </div>
            <div class="searchBox">
               <div class="searchToggle">
                <i class='bx bx-x cancel'></i>
                <i class='bx bx-search search'></i>
               </div>
                <div class="search-field">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search'></i>
                </div>
            </div>
        </div>
    </div>
</nav>
