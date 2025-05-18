<?php

declare(strict_types=1);

namespace Middleware;

use Controller\Home;
use HttpSoft\Response\JsonResponse;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouteMiddleware implements MiddlewareInterface
{
    public function __construct(private ContainerInterface $container){}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $controller = $this->container->get(Home::class);
        $action = 'getAnything';
        $params = [];

        $response = call_user_func_array([$controller, $action], $params);

        // $response = $this->container->call([$controller, $action], $params);

        return new JsonResponse($response);
    }
}
