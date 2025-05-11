<?php

declare(strict_types=1);

namespace Sys\Pipeline;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Pipeline
{
    private array $middlewares = [];

    public function __construct(private ContainerInterface $container){}

    public function pipe(string $middlewareClass): void
    {
        $this->middlewares[] = $this->container->get($middlewareClass);
    }

    public function process(ServerRequestInterface $request, $defaultHandler)
    {
        return $this->next($defaultHandler)->handle($request);
    }

    private function next($defaultHandler)
    {
        return new class ($this->middlewares, $defaultHandler) implements RequestHandlerInterface {

            public function __construct(private $middlewares, private $defaultHandler){}

            public function handle(ServerRequestInterface $request): ResponseInterface
            {
                if (!$middleware = array_shift($this->middlewares)) {
                    return $this->defaultHandler->handle($request);
                }

                $next = clone $this;
                return $middleware->process($request, $next);
            }
        };
    }
}
