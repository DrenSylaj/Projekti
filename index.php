<?php
include_once('dbcon.php');
include('navbar.php');

class Index {
  private $con;
  private $video;
  private $imageBackground1;
  private $imageBackground2;
  private $videoText;
  private $videoParagraph;

  public function __construct($con, $video, $imageBackground1, $imageBackground2, $videoText, $videoParagraph){
    $this->con = $con;
    $this->video = $video;
    $this->imageBackground1 = $imageBackground1;
    $this->imageBackground2 = $imageBackground2;
    $this->videoText = $videoText;
    $this->videoParagraph = $videoParagraph; 
  }

  public function renderHtml(){
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">
        <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" type="image/x-icon" href="/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png">
        <script src="index.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title>KosovoCityTour</title>
      </head>
    <body>
      <div class="video-background">
      <video autoplay muted loop plays-inline id="myVideo">
      <source src="'.$this->video. '" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <img src="' . $this->imageBackground1 . '" alt="" id="myPhoto">
    <img src="' . $this->imageBackground2 . '" alt="" id="myPhoto2">
      
          <div class="content">
          <h1>' . $this->videoText . '</h1>
          <p>' . $this->videoParagraph . '</p>
          <a class="buttoni-c" href="#harta">EXPLORE</a>
          </div>
        </div>
    
    
          <div class="ripped-paper">
            <img src="fotot/ripped-paper.png" alt="" class="paper">
            <img src="fotot/ripped-paper - Copy.png" class="paper3">
            <h1 class="overlay-text">Featured</h1>
          </div>
    
          <div class="komunat-photo">';
            $this->komunat_photo();
          echo'</div>
          
          <div class="shiriti-icon">
            <div class="shiriti-fotot">';
              for($i = 0; $i < 6; $i++){
                echo"<span class='material-symbols-outlined'>star</span>";
              }
            echo'</div>
          </div>
    
          <div id="slider-container">
            <div id="slider">';
              $this->slider();
            echo'</div>
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
          <div class="frame-background">';

          for($i=1; $i<=3; $i++){
            $j = 1;
            if($i == 1){
              echo'<div id="piece-1">
                  <div id="holder">
                    <div id="painting">        
                      <div id="original"></div>
                    </div>
                  </div>
                <div id="frame"></div>    
              </div>';
            }
            else{
              echo'<div id="piece-'.$i.'">
              <div id="holder">
                <div id="painting">        
                  <div id="original'.$j++.'"></div>
                </div>
              </div>
            <div id="frame"></div>    
          </div>';
            }
          }
      
      echo'</div>
        <div class="pattern">
          <img id="main-photo" src="fotot/imgonline-com-ua-twotoone-Ddn8PLbhW8T3X.png" alt="">
          <img id="res-photo" src="fotot/imgonline-com-ua-twotoone-8PpJq2al4UKYBHJ.jpg" alt="">
        </div>
    
        <h1 class="overlay-text2">Mountains</h1>
          <p class="paragraph2">Visit the breathtaking mountains of Kosovo</p>
        <ul class="image-gallery">';
        $this->mountains();
    echo'</ul>
    <h1 class="overlay-text2" id="harta">Explore</h1>
      <p class="paragraph2">Head into one of the regions of Kosovo</p>
      </body>
      </html>';
    }

  public function komunat_photo(){
      $query = "SELECT * FROM cities";
      $query_run = mysqli_query($this->con, $query);
      $fotot = [];
      while($row = mysqli_fetch_assoc($query_run)){
        $fotot [] = $row['image_url'];
      }
  
      foreach($fotot as $foto){
        if (strpos($foto, 'Prizren') !== false || strpos($foto, 'Ferizaj') !== false || strpos($foto, 'theranda')){
          echo"<img src='$foto' style='height: 60px; width: 60px;'>";
        }
        else{ 
          echo "<img src='$foto'>";
        };
      }
    }

    public function slider(){
      $query = "SELECT * FROM main_fotot WHERE ID NOT IN (SELECT image_id FROM mountain_photos)";
      $query_run = mysqli_query($this->con, $query);
  
      while($row = mysqli_fetch_assoc($query_run)){
        echo "<div class='slide'><img src='{$row['image_url']}' alt='{$row['alt']}'></div>";
      }
    }

    public function mountains(){
      $query = "SELECT * FROM main_fotot WHERE ID in (SELECT image_id FROM mountain_photos)";
      $query_run = mysqli_query($this->con, $query);
  
      while($row = mysqli_fetch_assoc($query_run)){
        echo "<li class='--photo'><img src='{$row['image_url']}' alt='{$row['alt']}'></li>";
      }
    }
}

$query = 'SELECT * FROM main';
$result_query = mysqli_query($con, $query);

if($row = mysqli_fetch_assoc($result_query)){
  $video = $row['video'];
  $imageBackground1 = $row['imageBackground1'];
  $imageBackground2 = $row['imageBackground2'];
  $videoText = $row['videoText'];
  $videoParagraph = $row['videoParagraph'];
}

$index = new Index($con, $video, $imageBackground1, $imageBackground2, $videoText, $videoParagraph);
$index->renderHtml();
include('map.php');
include('footer.php');
?>