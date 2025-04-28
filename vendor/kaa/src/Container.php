<?php declare(strict_types=1);

namespace Sys;

use Closure;
use InvalidArgumentException;

class Container
{
    private array $definisions = [];
    private array $instances = [];

    public function __construct($path = null)
    {
        if ($path) {
            $this->definisions = require_once $path;
        }
    }

    public function get(string $key)
    {
        
        if (!$this->has($key) && !class_exists($key)) {
            return null;
        }

        if (isset($this->instances[$key])) {
            return $this->instances[$key];
        }

        if (!isset($this->definisions[$key])) {
            return new $key;
        } elseif ($this->definisions[$key] instanceof Closure) {
            $this->instances[$key] = $this->definisions[$key]();
        } elseif (is_string($this->definisions[$key])) {
            $this->instances[$key] = new $this->definisions[$key];
        } elseif (is_object($this->definisions[$key])) {
            $this->instances[$key] = $this->definisions[$key];
        } else {
            throw new InvalidArgumentException(sprintf("Invalid type definision by key: %s", $key));
        }

        return $this->instances[$key];
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->definisions);
    }
}
