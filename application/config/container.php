<?php declare(strict_types=1);

use Az\Route\Middleware\RouteDispatch;
use Az\Route\Middleware\RouteMatch;
use Az\Route\Router;
use Az\Route\RouterInterface;
use Controller\Home;
use Psr\Http\Message\ServerRequestInterface;
use HttpSoft\ServerRequest\ServerRequestCreator;
use HttpSoft\Emitter\EmitterInterface;
use HttpSoft\Emitter\SapiEmitter;
use Middleware\CORS;
use Middleware\RouteMiddleware;
use Psr\Container\ContainerInterface;
use Repository\Repo1;
use Repository\Repo2;
use Repository\RepoInterface;
use Sys\App;
use Sys\DefaultHandler;
use Sys\Pipeline\Pipeline;

return [
    ServerRequestInterface::class => fn() => (new ServerRequestCreator())->create(),
    // EmitterInterface::class => new SapiEmitter,

    Pipeline::class => new Pipeline($this),
    // DefaultHandler::class => new DefaultHandler(),
    
    App::class => fn() => new App(
        $this->get(ServerRequestInterface::class),
        $this->get(Pipeline::class),
        // $this->get(EmitterInterface::class),
        $this->get(DefaultHandler::class)
    ),

    RouterInterface::class => new Router(ROUTES_PATH),
    RouteMatch::class => fn() => new RouteMatch($this->get(RouterInterface::class)),
    RouteDispatch::class => fn() => new RouteDispatch($this),

    // // CORS::class => fn() => new CORS(),
    // RouteMiddleware::class => fn() => new RouteMiddleware($this),
    Home::class => fn() => new Home($this->get(RepoInterface::class)),
    // // Repo1::class => fn() => new Repo1,
    RepoInterface::class => fn() => new Repo2($this->get(Repo1::class)),

];
