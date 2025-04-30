<?php declare(strict_types=1);

use Sys\Container;
use Sys\App;

require '../vendor/autoload.php';
require '../autoload.php';
require '../vendor/kaa/src/library.php';
require '../vendor/kaa/src/exceptionHandler.php';

$container = new Container('../application/config/container.php');
$container->get(App::class)->run();
