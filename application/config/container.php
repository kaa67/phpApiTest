<?php declare(strict_types=1);

use Controller\Home;
use Repository\Repo1;
use Repository\Repo2;
use Repository\RepoInterface;
use Sys\App;

return [
    RepoInterface::class => fn() => new Repo1,
    Home::class => fn() => new Home($this->get(RepoInterface::class)),
    App::class => fn() => new App($this->get(Home::class)),
];
