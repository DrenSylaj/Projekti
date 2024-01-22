<?php 
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>KosovoCityTour</title>
  </head>
<body>
  <div class="video-background">
    <video autoplay muted loop plays-inline id="myVideo">
        <source src="video/KosovaVIDEO.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <img src="fotot/foto(Komunat)/Emily-Lush-Prishtina-Kosovo-57.jpg" alt="" id="myPhoto">
    <img src="https://live.staticflickr.com/25/69406534_183bbf4bcc_b.jpg" alt="" id="myPhoto2">

    <div class="content">
        <h1>EXPLORE. DREAM. DISCOVER.</h1>
        <p>Lorem Ipsum, blah blah standalone com myvideo type harta lorem ipsum.</p>
        <a class="buttoni-c" href="#harta">EXPLORE</a>
    </div>
  </div>


      <div class="ripped-paper">
        <img src="fotot/ripped-paper.png" alt="" class="paper">
        <img src="fotot/ripped-paper - Copy.png" class="paper3">
        <h1 class="overlay-text">Featured</h1>
      </div>

      <div class="komunat-photo">
        <img src="fotot/Stema_e_Komunës_Prishtinë.png" alt="">
        <img src="fotot/logo/639px-Stema_e_Komunës_Prizren.png" alt="" style="height: 60px; width: 60px;">
        <img src="fotot/logo/434px-Stema_e_Komunës_Pejë.png" alt="">
        <img src="fotot/logo/Stema_e_Komunës_Gjakovë.png" alt="">
        <img src="fotot/logo/467px-Stema_e_Komunës_Gjilan.png" alt="">
        <img src="fotot/logo/452px-Stema_e_Komunës_Mitrovicë.png" alt="">
        <img src="fotot/logo/Logo_ferizaj.jpg" alt="" class="ferizaj" style="height: 65px; width: 50px;">
      </div>
      
      <div class="shiriti-icon">
        <div class="shiriti-fotot">
          <span class="material-symbols-outlined">star</span>
          <span class="material-symbols-outlined">star</span>
          <span class="material-symbols-outlined">star</span>
          <span class="material-symbols-outlined">star</span>
          <span class="material-symbols-outlined">star</span>
          <span class="material-symbols-outlined">star</span>
        </div>
      </div>

      <div id="slider-container">
        <div id="slider">
          <?php
          $query = "SELECT * FROM main_fotot";
          $query_run = mysqli_query($con, $query);
          $fotot = [];
          $alt = [];
          while($row = mysqli_fetch_assoc($query_run)){
            $fotot [] = $row['image_url'];
            $alt [] = $row['alt'];
          }

          foreach($fotot as $key => $imageBG){
            echo"<div class='slide'><img src='$imageBG' alt='{$alt[$key]}'></div>";
          }

          foreach($fotot as $key => $imageBG){
            echo"<div class='slide'><img src='$imageBG' alt='{$alt[$key]}'></div>";
          }
          ?>
        </div>
      </div>
      
      <div class="shiriti-poshtem">
        <div class="shiriti-1"></div>
        <div class="shiriti-2"></div>
      </div>


      <h1 class="overlay-text2">Museums</h1>
      <p class="paragraph2">Visit the many museums of Kosovo</p>

      <div class="pattern">
        <img id="res-photo" src="fotot/imgonline-com-ua-twotoone-8PpJq2al4UKYBHJ.jpg" alt="">
        <img id="main-photo" src="fotot/imgonline-com-ua-twotoone-Ddn8PLbhW8T3X.png" alt="" class="foto-1">
      </div>
      <div class="frame-background">
        <div id="piece-1">
          <div id="holder">
            <div id="painting">        
              <div id="original"></div>
            </div>
          </div>
        <div id="frame"></div>    
      </div>
      <div id="piece-2">
        <div id="holder">
          <div id="painting">        
            <div id="original1"></div>
          </div>
        </div>
      <div id="frame">
      </div>    
    </div>
    <div id="piece-3">
      <div id="holder">
        <div id="painting">        
          <div id="original2">
          </div>
        </div>
      </div>
    <div id="frame">
    </div>    
  </div>
      </div>
    <div class="pattern">
      <img id="main-photo" src="fotot/imgonline-com-ua-twotoone-Ddn8PLbhW8T3X.png" alt="">
      <img id="res-photo" src="fotot/imgonline-com-ua-twotoone-8PpJq2al4UKYBHJ.jpg" alt="">
    </div>

    <h1 class="overlay-text2">Mountains</h1>
      <p class="paragraph2">Visit the breathtaking mountains of Kosovo</p>
    <ul class="image-gallery">
      <li class="--photo">
        <img src="fotot/malet/Bistra-peak-Winter-768x578.jpg" alt="Image 1">
      </li>
      <li class="--photo">
        <img src="fotot/malet/Gjeravica-hiking-snow-Kosovo-768x960.jpg" alt="Image 2">
      </li class="--photo">
      <li class="--photo">
        <img src="https://alpventurer.com/wp-content/uploads/2017/06/Great-Rudoka-2658-Kosovo-North-Macedonia-scaled.jpg" alt="Image 3">
      </li>
      <li class="--photo"><img src="fotot/malet/Maja-Jezerce-winter.jpg" alt="Image 4">
      </li>
      <li class="--photo"><img src="fotot/malet/Mali-Korab.jpg" alt="Image 5">
      </li>
      <li class="--photo">
        <img src="fotot/malet/istockphoto-175527210-612x612.jpg" alt="Image 6">
      </li>
      <li class="--photo">
        <img src="fotot/malet/64636995_3303378019688336_4692928653430882304_n.jpg" alt="Image 7">
      </li>
      <li class="--photo">
        <img src="fotot/malet/CkLOOmkWUAENPkJ.jpg" alt="Image 8">
      </li>
      <li class="--photo">
        <img src="fotot/malet/Sharri_Mountain_-_Malet_e_Sharrit.jpg" alt="Image 9">
      </li>
      
    </ul>

    <h1 class="overlay-text2" id="harta">Explore</h1>
      <p class="paragraph2">Head into one of the regions of Kosovo</p>
<?php
include('map.php');
?>
</body>
</html>
<?php 
include('footer.php');
?>