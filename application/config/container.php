<?php declare(strict_types=1);

use Az\Route\Router;
use Az\Route\RouterInterface;
use Psr\Http\Message\ServerRequestInterface;
use HttpSoft\ServerRequest\ServerRequestCreator;
use HttpSoft\Emitter\EmitterInterface;
use HttpSoft\Emitter\SapiEmitter;
use Repository\Repo1;
use Repository\Repo2;
use Repository\RepoInterface;

return [
    ServerRequestInterface::class => fn() => (new ServerRequestCreator())->create(),
    // EmitterInterface::class => new SapiEmitter,
    RouterInterface::class => new Router(ROUTES_PATH),

    RepoInterface::class => fn() => new Repo2($this->get(Repo1::class)),
];
