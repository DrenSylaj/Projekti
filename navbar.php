<?php
include('authentication.php');
include('dbcon.php');
?>

<link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png">
    <style src="index.js"></style>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
      const body = document.querySelector("body");
    const nav = document.querySelector("nav");
    const modeToggle = document.querySelector(".dark-light");
    const searchToggle = document.querySelector(".searchToggle");
    const sidebarOpen = document.querySelector(".sidebarOpen");

    if (modeToggle) {
        modeToggle.addEventListener("click", function() {
            modeToggle.classList.toggle("active");
            body.classList.toggle("dark");

            if (!body.classList.contains("dark")) {
                localStorage.setItem("mode", "light-mode");
            } else {
                localStorage.setItem("mode", "dark-mode");
            }
        });
    }

    if (searchToggle) {
        searchToggle.addEventListener("click", function() {
            searchToggle.classList.toggle("active");
        });
    }

    if (sidebarOpen) {
        sidebarOpen.addEventListener("click", function() {
            nav.classList.add("active");
        });
    }

    if (body) {
        body.addEventListener("click", function(e) {
            let clickedElm = e.target;
            if (
                !clickedElm.classList.contains("sidebarOpen") &&
                !clickedElm.classList.contains("menu")
            ) {
                nav.classList.remove("active");
            }
        });
    }
});
    </script>
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
                    <?php
                    $query_city = "SELECT emriQytetit FROM cities";
                    $query_city_run = mysqli_query($con, $query_city);
                    $qyteti = [];
                    while($row = mysqli_fetch_assoc($query_city_run)){
                        $qyteti[] = $row['emriQytetit'];
                    }
                    foreach($qyteti as $cityName){
                        echo"<a href='city.php?selectedCity=$cityName'>$cityName</a>";
                    }  
                    ?>
                  </div>
                </div> 
                <li><a href="aboutus.php">ABOUT US</a></li>
                <?php
                  $authUser = $_SESSION['auth_user'];
                  $loggedInUserId = $authUser['User_ID'];

                  $query = "SELECT user_id FROM admins";
                  $result = mysqli_query($con, $query);

                  $admins = [];
                  while ($row = mysqli_fetch_assoc($result)) {
                      $admins[] = $row['user_id']; 
                  }

                  $userIsAdmin = in_array($loggedInUserId, $admins, true);

                  if ($userIsAdmin) {
                      echo '<li><a href="dashboard.php">DASHBOARD</a></li>';
                  }
                ?>
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
