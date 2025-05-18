<?php

declare(strict_types=1);

namespace Sys\Container;

use ErrorException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $definisions;

    public function __construct()
    {
        $this->definisions = require_once(APPPATH . 'config/container.php');
    }

    public function get($key)
    {
        if (!isset($this->definisions[$key])) {
            if (class_exists($key)) {
                $this->definisions[$key] = new $key();
            } else {
                throw new ErrorException(sprintf('Undefined array key "%s"', $key));
            }
        }

        if (is_callable($this->definisions[$key])) {
            $this->definisions[$key] = $this->definisions[$key]();
        }
        
        return $this->definisions[$key];
    }

    public function has($key): bool
    {
        return isset($this->definisions[$key]);
    }
}
