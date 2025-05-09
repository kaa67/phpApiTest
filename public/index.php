<?php declare(strict_types=1);

use Sys\App;

require '../vendor/autoload.php';
require '../autoload.php';
require '../vendor/kaa/src/library.php';
require '../vendor/kaa/src/exceptionHandler.php';

$builder = new DI\ContainerBuilder();
$builder->addDefinitions('../application/config/container.php');
$container = $builder->build();
$container->get(App::class)->run();
