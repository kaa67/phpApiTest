<?php declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface;
use HttpSoft\ServerRequest\ServerRequestCreator;
use HttpSoft\Emitter\EmitterInterface;
use HttpSoft\Emitter\SapiEmitter;

use Repository\Repo1;
use Repository\RepoInterface;

return [
    ServerRequestInterface::class => fn() => (new ServerRequestCreator())->create(),
    EmitterInterface::class => fn() => new SapiEmitter,

    RepoInterface::class => fn() => new Repo1,
];
