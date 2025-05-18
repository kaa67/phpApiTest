<?php

declare(strict_types=1);

namespace Sys;

use Middleware\CORS;
use Middleware\RouteMiddleware;
use Sys\DefaultHandler;
use Sys\Pipeline\Pipeline;
use HttpSoft\Emitter\EmitterInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    public function __construct(
        private ServerRequestInterface $request,
        private Pipeline $pipeline,
        // private EmitterInterface $emitter,
        private DefaultHandler $defaultHandler
    ){}

    public function run()
    {
        $this->pipeline->pipe(CORS::class);
        $this->pipeline->pipe(RouteMiddleware::class);

        $response = $this->pipeline->process($this->request, $this->defaultHandler);

        foreach ($response->getHeaders() as $name => $values) {
            $name = str_replace(' ', '-', ucwords(strtolower(str_replace('-', ' ', (string) $name))));
            $firstReplace = !($name === 'Set-Cookie');

            foreach ($values as $value) {
                header("$name: $value", $firstReplace);
                $firstReplace = false;
            }
        }

        echo $response->getBody();
        // $this->emitter->emit($response);
    }
}
