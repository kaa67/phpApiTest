<?php declare(strict_types=1);

use Repository\Repo1;
use Repository\RepoInterface;

return [
    RepoInterface::class => fn() => new Repo1,
];
