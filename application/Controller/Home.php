<?php

declare(strict_types=1);

namespace Controller;

use HttpSoft\Response\JsonResponse;
use Repository\RepoInterface;
use Repository\Repo1;

class Home
{
    // public function __construct(private RepoInterface $repo){}

    public function __invoke(Repo1 $repo, $foo = 'qq')
    {
        return new JsonResponse(['bar' => $repo->getPhrase(), 'foo' => $foo]);
        // return $this->repo->getPhrase();
    }
}
