<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\PeopleController;
use App\Controllers\PlanetController;
use App\Controllers\StarshipController;

$results = [];

$people = new PeopleController();

$person1 = $people->get(1);
$person2 = $people->get(2);

array_push($results, $person1, $person2);

$planet = new PlanetController();

$planet1 = $planet->get(1);
$planet2 = $planet->get(2);

array_push($results, $planet1, $planet2);

$starship = new StarshipController();

$starship9 = $starship->get(9);
$starship10 = $starship->get(10);
$starship11 = $starship->get(11);
$starship12 = $starship->get(12);
$starship13 = $starship->get(13);
array_push($results, $starship9, $starship10, $starship11, $starship12, $starship13);

echo '<pre>';
var_dump($results);