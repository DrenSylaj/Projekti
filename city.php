<?php

include('navbar.php');
include('dbcon.php');

class City {
    private $name;
    private $description;
    private $image;
    private $image1;
    private $placesToVisit;
    private $placesToEat;
    private $placesToSleep;

    public function __construct($name, $description, $image, $image1, $placesToVisit, $placesToEat, $placesToSleep) {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->image1 = $image1;
        $this->placesToVisit = $placesToVisit;
        $this->placesToEat = $placesToEat;
        $this->placesToSleep = $placesToSleep;
    }
    
    public function renderHTML() {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='index.css'>
            <link rel='stylesheet' href='test.css'>
            <script src='test.js'></script>
            <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
            <link rel='icon' type='image/x-icon' href='/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png'>
            <title>KosovoCityTour ꞏ {$this->name}</title>
        </head>
        <body>
            <div class='image-background'>
                <img src='{$this->image}' alt='' id='bc-photo'>
            </div>

            <div class='content2'>
                <h1>{$this->name}.</h1>
            </div>

            <div class='ripped-paper'>
                <img src='fotot/ripped-paper.png' alt='' class='paper2'>
            </div>
            <div class='city-container'>
                <div class='logo-text-container'>
                    <div class='image-container2'>
                        <img src='{$this->image1}' alt=''>
                    </div>
                    <div class='text-container2'>
                        <h1 class='overlay-text2'>{$this->name}</h1>
                        <p>{$this->description}</p>
                    </div>
                </div>
            </div>";

            $this->renderPlacesToVisit();
            $this->renderPlacesToEat();
            $this->renderPlacesToSleep();
        
        echo " 
        </body>
        </html>
        ";
    }

    public function renderPlacesToVisit() {
        echo "
            <h1 class='overlay-text2'>Places to Visit</h1>
            <p class='paragraph2'>Some of the most frequented and unique places to be in {$this->name}</p>

            <div class='card-containter'>";

        foreach ($this->placesToVisit as $place) {
            echo "
                <article class='card'>
                <i class='fa fa-heart heart-icon' style='font-size: 30px;'></i>
                    <img class='card__background' src='{$place['image_background']}' width='1920' height='2193'/>
                    <div class='card__content | flow'>
                        <div class='card__content--container | flow'>
                            <h2 class='card__title'>{$place['title']}</h2>
                            <p class='card__description'>{$place['cardDescription']}</p>
                        </div>
                        <button class='card__button'><a href='#'>Read more</a></button>
                    </div>
                </article>";
        }
        echo "
        </div>";
    }

    public function renderPlacesToEat() {
        echo "
            <h1 class='overlay-text2'>Places to Eat</h1>
            <p class='paragraph2'>Some of the tastiest food in {$this->name}</p>

            <div class='card-containter'>";

        foreach ($this->placesToEat as $place) {
            echo "
                <article class='card'>
                <i class='fa fa-heart heart-icon' style='font-size: 30px;'></i>
                    <img class='card__background' src='{$place['image_background']}' width='1920' height='2193'/>
                    <div class='card__content | flow'>
                        <div class='card__content--container | flow'>
                            <h2 class='card__title'>{$place['title']}</h2>
                            <p class='card__description'>{$place['cardDescription']}</p>
                        </div>
                        <button class='card__button'><a href='#'>Read more</a></button>
                    </div>
                </article>";
        }

        echo "
            </div>";
    }

    public function renderPlacesToSleep() {
        echo "
            <h1 class='overlay-text2'>Places to Sleep</h1>
            <p class='paragraph2'>Some of the most comfortable places to sleep at night.</p>

            <div class='card-containter'>";

        foreach ($this->placesToSleep as $place) {
            echo "
                <article class='card'>
                    <i class='fa fa-heart heart-icon' style='font-size: 30px;'></i>
                    <img class='card__background' src='{$place['image_background']}' width='1920' height='2193'/>
                    <div class='card__content | flow'>
                        <div class='card__content--container | flow'>
                            <h2 class='card__title'>{$place['title']}</h2>
                            <p class='card__description'>{$place['cardDescription']}</p>
                        </div>
                        <button class='card__button'><a href='#'>Reservation</a></button>
                    </div>
                </article>";
        }

        echo "
            </div>";
    }
}

$selectedCityName = isset($_GET['selectedCity']) ? $_GET['selectedCity'] : '';

if (!empty($selectedCityName)) {
    $query_city = "SELECT * from cities WHERE emriQytetit = '$selectedCityName'";
    $result_city_query = mysqli_query($con, $query_city);

    if($rowCity = mysqli_fetch_assoc($result_city_query)){
        $selectedCityId = $rowCity['city_id'];
        $cityName = $rowCity['emriQytetit'];
        $cityDescription = $rowCity['description'];
        $cityLogo = $rowCity['image_url'];
        $city_background = $rowCity['image_background'];

        $queryVisit = "SELECT * FROM visit WHERE city_id = $selectedCityId";
        $resultVisit = mysqli_query($con, $queryVisit);
        $placesToVisit = [];

        while($rowVisit = mysqli_fetch_assoc($resultVisit)){
            $placesToVisit[] = [
                'title' => $rowVisit['title'],
                'cardDescription' => $rowVisit['description'],
                'image_background' => $rowVisit['image_url']
            ];
        }

        $queryEat = "SELECT * FROM eat WHERE city_id = '$selectedCityId'";
        $resultEat = mysqli_query($con, $queryEat);
        $placesToEat = [];
        while($rowEat = mysqli_fetch_assoc($resultEat)){
            $placesToEat[] = [
                'title' => $rowEat['title'],
                'cardDescription' => $rowEat['description'],
                'image_background' => $rowEat['image_url'] 
            ];
        }

        $querySleep = "SELECT * FROM sleep WHERE city_id = '$selectedCityId'";
        $resultSleep = mysqli_query($con, $querySleep);
        $placesToSleep = [];
        while($rowSleep = mysqli_fetch_assoc($resultSleep)){
            $placesToSleep[] = [
                'title' => $rowSleep['title'],
                'cardDescription' => $rowSleep['description'],
                'image_background' => $rowSleep['image_url']
            ];
        }

        $cityData = [
            "name" => $cityName,
            "description" => $cityDescription,
            "image" => $city_background,
            "image1" => $cityLogo,
            "placesToVisit" => $placesToVisit,
            "placesToEat" => $placesToEat,
            "placesToSleep" => $placesToSleep
        ];

        $city = new City(
            $cityData["name"],
            $cityData["description"],
            $cityData["image"],
            $cityData["image1"],
            $cityData["placesToVisit"],
            $cityData["placesToEat"],
            $cityData["placesToSleep"]
        );

        $city->renderHTML();
    }
}

include('footer.php');
?>
