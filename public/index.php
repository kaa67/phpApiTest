<?php declare(strict_types=1);

use Sys\App;

require '../application/config/bootstrap.php';

$builder = new DI\ContainerBuilder();
$builder->addDefinitions('../application/config/container.php');
$container = $builder->build();
$container->get(App::class)->run();
