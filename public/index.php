<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\PeopleController;

$people = new PeopleController();

$get = $people->get(3);

echo $get;