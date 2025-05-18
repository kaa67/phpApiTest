<?php declare(strict_types=1);

use Sys\Container\Container;
use Sys\App;

require '../application/config/bootstrap.php';

// $builder = new DI\ContainerBuilder();
// $builder->addDefinitions('../application/config/container.php');
// $container = $builder->build();

$container = new Container();
$container->get(App::class)->run();
