<?php

declare(strict_types=1);

namespace Controller;

use Repository\RepoInterface;

class Home
{
    public function __construct(private RepoInterface $repo){}

    public function getAnything()
    {
        return $this->repo->getPhrase();
    }
}
