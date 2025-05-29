<?php

declare(strict_types=1);

namespace Middleware;

use PostProcess\ResponseHeaders;
use Psr\Http\Message\ServerRequestInterface;
use Sys\Pipeline\PostProcess;

class CORS
{
    public function __construct(private PostProcess $postProcess){}

    public function process(ServerRequestInterface $request, $handler)
    {
        $this->postProcess->enqueue(ResponseHeaders::class)
            ->add([
                'X-FOO' => 'Blah-blah',
                'X-Author' => 'Kolosoft',
            ]);

        return $handler->handle($request);
    }
}
