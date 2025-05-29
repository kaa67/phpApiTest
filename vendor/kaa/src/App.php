<?php

declare(strict_types=1);

namespace Sys;

use Az\Route\Middleware\RouteDispatch;
use Az\Route\Middleware\RouteMatch;
use Middleware\CORS;
// use Middleware\RouteMiddleware;
use Sys\DefaultHandler;
use Sys\Pipeline\Pipeline;
use HttpSoft\Emitter\EmitterInterface;
use PostProcess\CORS as PostProcessCORS;
use PostProcess\ResponseHeaders;
use Sys\Pipeline\PostProcess;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    public function __construct(
        private ServerRequestInterface $request,
        private Pipeline $pipeline,
        private PostProcess $postProcess,
        // private EmitterInterface $emitter,
        private DefaultHandler $defaultHandler
    ){}

    public function run()
    {
        $this->pipeline->pipe(CORS::class);
        $this->pipeline->pipe(RouteMatch::class);
        $this->pipeline->pipe(RouteDispatch::class);
        // $this->pipeline->pipe(RouteMiddleware::class);

        $response = $this->pipeline->process($this->request, $this->defaultHandler);
        $response = $this->postProcess->process($response);

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
