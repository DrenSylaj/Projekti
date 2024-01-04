<?php
include('navbar.php');

class City {
    private $name;
    private $description;
    private $image;
    private $placesToVisit;
    private $placesToEat;
    private $cardDescriptions; // New property for card descriptions
    private $placesToSleep;

    public function __construct($name, $description, $image, $placesToVisit, $placesToEat, $cardDescriptions, $placesToSleep) {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->placesToVisit = $placesToVisit;
        $this->placesToEat = $placesToEat;
        $this->cardDescriptions = $cardDescriptions; // Assign the new property
        $this->placesToSleep = $placesToSleep;
    }

    public function renderHTML() {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <link rel='stylesheet' href='index.css'>
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='icon' type='image/x-icon' href='/fotot/Emblem_of_the_Republic_of_Kosovo.svg.png'>
        <head>
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
                <img src='https://media.istockphoto.com/id/1226097836/vector/location-map-of-pristina-district.jpg?s=170667a&w=0&k=20&c=Ju0B5chFgHSc0IvxwkUIxMHGguNPNHrtSH53Uo0MPrk=' alt=''>
            </div>

            <h1 class='overlay-text2'>Places to Visit</h1>
            <p class='paragraph2'>Some of the most frequented and unique places to be in {$this->name}</p>

            <div class='card-containter'>";

        // Loop through places to visit
        foreach ($this->placesToVisit as $index => $place) {
            $cardDescription = isset($this->cardDescriptions[$index]) ? $this->cardDescriptions[$index] : ''; // Use the corresponding card description
            echo "
            <article class='card'>
                <h2 class='card__title'>$place</h2>
                <p class='card__description'>$cardDescription</p>
                <button class='card__button'>Read more</button>
            </article>";
        }

        echo "
            </div>

            <h1 class='overlay-text2'>Places to Eat</h1>
            <p class='paragraph2'>Some of the tastiest food in {$this->name}</p>

            <div class='card-containter'>";

        // Loop through places to eat
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

        // Loop through places to sleep
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

// Usage example:
$prishtinaData = [
    "name" => "Prishtina",
    "description" => "Pristina is the capital and largest city of Kosovo with a population of more than 200.000 people...",
    "image" => "https://upload.wikimedia.org/wikipedia/commons/5/51/Prishtina_nga_Katedrala_1.jpg",
    "placesToVisit" => ["Cathedral", "National Library", "Kurrizi", "Pallati Rinis", "Germia Park", "Newborn", "IDFK"],
    "cardDescriptions" => [
        "Description 1",
        "Description 2",
        "Description 3",
        "Description 4",
        "Description 5",
        "Description 6",
        "Description 7"
    ],
    "placesToEat" => ["Sospiro Restaurant", "Liburnia Restaurant", "Pinocchio", "SEN5ES"],
    "placesToSleep" => ["Swiss Diamond Hotel", "Derand Hotel", "Hotel Manami", "Emerald Hotel"]
];

$prishtina = new City(
    $prishtinaData["name"],
    $prishtinaData["description"],
    $prishtinaData["image"],
    $prishtinaData["placesToVisit"],
    $prishtinaData["placesToEat"],
    $prishtinaData["cardDescriptions"],
    $prishtinaData["placesToSleep"]
);

$prishtina->renderHTML();

$pejaData = [
    "name" => "Peja",
    "description" => "Peja is the capital and largest city of Kosovo with a population of more than 200.000 people...",
    "image" => "https://upload.wikimedia.org/wikipedia/commons/5/51/Prishtina_nga_Katedrala_1.jpg",
    "placesToVisit" => ["Cathedral", "National Library", "Kurrizi", "Pallati Rinis", "Germia Park", "Newborn"],
    "cardDescriptions" => ["abc", "abc", "abc", "abc", "abc", "abc"],
    "placesToEat" => ["Sospiro Restaurant", "Liburnia Restaurant", "Pinocchio", "SEN5ES"],
    "placesToSleep" => ["Swiss Diamond Hotel", "Derand Hotel", "Hotel Manami", "Emerald Hotel"]
];

$peja = new City(
    $pejaData["name"],
    $pejaData["description"],
    $pejaData["image"],
    $pejaData["placesToVisit"],
    $pejaData["placesToEat"],
    $pejaData["cardDescriptions"],
    $pejaData["placesToSleep"]
);

$peja->renderHTML();

include('footer.php');
?>
