<?php

declare(strict_types=1);

namespace Middleware;

use HttpSoft\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class CORS
{
    public function process(ServerRequestInterface $request, $handler)
    {
        // return new JsonResponse(['foo' => 'bar']);

        return $handler->handle($request);
    }
}
