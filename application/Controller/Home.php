<?php

declare(strict_types=1);

namespace Controller;

use HttpSoft\Response\JsonResponse;
use Repository\RepoInterface;

class Home
{
    public function __construct(private RepoInterface $repo){}

    public function __invoke()
    {
        return new JsonResponse(['foo' => 'bar']);
        // return $this->repo->getPhrase();
    }
}
