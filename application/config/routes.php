<?php

use Controller\Home;
use HttpSoft\Response\JsonResponse;

return [
    'home'  => ['/', fn() => new JsonResponse(['qq' => 'kuku'])],
];
