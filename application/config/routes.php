<?php

use Az\Route\Route;
use Controller\Home;
use HttpSoft\Response\JsonResponse;

return [
    'home'  => ['/{foo?}', Home::class],
    // 'home'  => ['/', fn() => new JsonResponse(['qq' => 'kuku'])],
    'auth'  => ['/auth/{user?}', function ($request) {
        $user = $request->getAttribute(Route::class)->getParameters()['user'] ?? 'Андрей';
        return new JsonResponse(['qq' => $user]);
    }],
];
