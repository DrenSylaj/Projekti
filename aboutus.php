<?php
include('navbar.php');

class AboutUS{
    private $description;
    private $image_background;
    private $imageR1;
    private $imageR2;

    public function __construct($description, $image_background, $imageR1, $imageR2){
        $this->description = $description;
        $this->image_background = $image_background;
        $this->imageR1 = $imageR1;
        $this->imageR2 = $imageR2;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImageBackground() {
        return $this->image_background;
    }

    public function getImageR1() {
        return $this->imageR1;
    }

    public function getImageR2() {
        return $this->imageR2;
    }
}

class AboutUsRepository {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function getAboutUsData() {
        $query = "SELECT * FROM aboutus";
        $queryRun = mysqli_query($this->con, $query);

        if ($row = mysqli_fetch_assoc($queryRun)) {
            return new AboutUs(
                $row['description'],
                $row['image_background'],
                $row['background_2'],
                $row['background_3']
            );
        }

        return null; 
    }
}

$aboutUsRepository = new AboutUsRepository($con);
$aboutUs = $aboutUsRepository->getAboutUsData();

if ($aboutUs) {
    echo "
    <!DOCTYPE html>
        <html lang='en'>
        <head>
        <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='index.css'>
            <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
            <link rel='icon' type='image/x-icon' href='/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png'>
            <script src='index.js'></script>
            <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' />
            <title>AboutUs</title>
        </head>
        <body>
        <div class='image-background2'>
            <img src='{$aboutUs->getImageBackground()}' alt='' id='bcg_photo'>
            <img src='{$aboutUs->getImageR1()}' alt='' id='myPhoto2'>
            <img src='{$aboutUs->getImageR2()}' alt='' id='resPhoto'>
            <img src='fotot/' alt=''>
        </div>

        <div class='ripped-paper'>
            <img src='fotot/ripped-paper.png' alt='' class='paper2'>
            <h1 class='overlay-text'>About Us</h1>
        </div>  

        <div class='text-container'>
            <p>{$aboutUs->getDescription()}</p>
        </div>
        </body>
    </html>
    ";
    include('footer.php');
} else {
    echo "No data found for 'About Us'";
}
?>
