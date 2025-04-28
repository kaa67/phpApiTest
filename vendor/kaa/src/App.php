<?php

declare(strict_types=1);

namespace Sys;

use Controller\Home;

class App
{
    public function __construct(private Home $handler){}

    public function run()
    {
        echo $this->handler->getAnything();
    }
}
