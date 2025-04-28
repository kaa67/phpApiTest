<?php

declare(strict_types=1);

namespace Repository;

class Repo1 implements RepoInterface
{
    public function getPhrase(): string
    {
        return 'Здравствуй, дорогой дрюк!';
    }
}
