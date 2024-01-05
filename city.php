<?php

include('navbar.php');
include('dbcon.php');

class City {
    private $name;
    private $description;
    private $image;
    private $image_background;
    private $placesToVisit;
    private $cardDescriptions;
    private $placesToEat;
    private $placesToSleep;

    public function __construct($name, $description, $image, $image_background, $placesToVisit, $cardDescriptions, $placesToEat, $placesToSleep) {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->image_background = $image_background;
        $this->placesToVisit = $placesToVisit;
        $this->cardDescriptions = $cardDescriptions;
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
            <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
            <link rel='icon' type='image/x-icon' href='/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png'>
            <title>{$this->name} CityTour ꞏ {$this->name}</title>
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

            <div class='text-container2'>
                <h1 class='overlay-text2'>{$this->name}</h1>
                <p>{$this->description}</p>
            </div>

            <div class='image-container2'>
                <img src='{$this->image1}' alt=''>
            </div>

            <h1 class='overlay-text2'>Places to Visit</h1>
            <p class='paragraph2'>Some of the most frequented and unique places to be in {$this->name}</p>

            <div class='card-containter'>";

            foreach ($this->placesToVisit as $index => $place) {
                $cardDescription = isset($this->cardDescriptions[$index]) ? $this->cardDescriptions[$index] : '';
                $image_background = isset($this->image_background[$index]) ? $this->image_background[$index] : '';
            
                echo "
                <article class='card'>
                    <img class='card__background' src='{$image_background}' width='1920' height='2193'/>
                    <div class='card__content | flow'>
                        <div class='card__content--container | flow'>
                            <h2 class='card__title'>$place</h2>
                            <p class='card__description'>$cardDescription</p>
                        </div>
                        <button class='card__button'><a href='#'>Read more</a></button>
                    </div>
                </article>";
            }

        echo "
            </div>

            <h1 class='overlay-text2'>Places to Eat</h1>
            <p class='paragraph2'>Some of the tastiest food in {$this->name}</p>

            <div class='card-containter'>";

        foreach ($this->placesToEat as $place) {
            echo "
            <article class='card'>
                <h2 class='card__title'>$place</h2>
                <button class='card__button'>Read more</button>
            </article>";
        }

        echo "
            </div>

            <h1 class='overlay-text2'>Places to Sleep</h1>
            <p class='paragraph2'>Some of the most comfortable places to sleep at night.</p>
            <div class='card-containter'>";

        foreach ($this->placesToSleep as $place) {
            echo "
            <article class='card'>
                <h2 class='card__title'>$place</h2>
                <button class='card__button'><a href='#'>Reservation</a></button>
            </article>";
        }

        echo "
            </div>

        </body>
        </html>
        ";
    }
}

$citiesData = [
    "Prishtina" => [
        "name" => "Prishtina",
        "description" => "Pristina is the capital and largest city of Kosovo with a population of more than 200,000 people...",
        "image" => 'fotot/pristina-kosovo-travel-photo-20230417173342682-main-image.jpg',
        "image_background" => ['fotot/pristina-kosovo-travel-photo-20230417173342682-main-image.jpg', 'fotot/pristina-kosovo-travel-photo-20230417173342682-main-image.jpg'],
        "placesToVisit" => ["Place 1", "Place 2", "Place 3"],
        "cardDescriptions" => ["Description 1 sadsasdasdas  sadsadasdasdas dasdsa dasd asd as d", "Description 2", "Description 3"],
        "placesToEat" => ["Sospiro Restaurant", "Liburnia Restaurant", "Pinocchio", "SEN5ES"],
        "placesToSleep" => ["Swiss Diamond Hotel", "Derand Hotel", "Hotel Manami", "Emerald Hotel"]
    ],
    "Prizreni" => [
        "name" => "Prizreni",
        "description" => "Prizren is the capital and largest city of Kosovo with a population of more than 200,000 people...",
        "image" => 'fotot/webRNS-KOSOVO2-09052017.jpg',
        "image_background" => ['fotot/webRNS-KOSOVO2-09052017.jpg', 'fotot/pristina-kosovo-travel-photo-20230417173342682-main-image.jpg'],
        "placesToVisit" => ["Place 1", "Place 2", "Place 3"],
        "cardDescriptions" => ["Description 1 sadsasdasdas  sadsadasdasdas dasdsa dasd asd as d", "Description 2", "Description 3"],
        "placesToEat" => ["Sospiro Restaurant", "Liburnia Restaurant", "Pinocchio", "SEN5ES"],
        "placesToSleep" => ["Swiss Diamond Hotel", "Derand Hotel", "Hotel Manami", "Emerald Hotel"]
    ],
];

$selectedCityName = isset($_GET['selectedCity']) ? $_GET['selectedCity'] : '';

if (!empty($selectedCityName) && isset($citiesData[$selectedCityName])) {
    $cityData = $citiesData[$selectedCityName];
    $city = new City(
        $cityData["name"],
        $cityData["description"],
        $cityData["image"],
        $cityData["image_background"],
        $cityData["placesToVisit"],
        $cityData["cardDescriptions"],
        $cityData["placesToEat"],
        $cityData["placesToSleep"]
    );

    $city->renderHTML();
}

include('footer.php');
?>
