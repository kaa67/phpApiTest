<?php

declare(strict_types=1);

namespace Repository;

class Repo2  implements RepoInterface
{
    public function __construct(private Repo1 $repo){}

    public function getPhrase(): string
    {
        return $this->repo->getPhrase();
        return 'Пашоль нахуй, мудило!';
    }
}
