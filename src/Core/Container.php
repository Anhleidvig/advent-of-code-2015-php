<?php

namespace App\Core;

use App\Core\Contracts\Application as ApplicationContract;

class Container
{
    private static ApplicationContract $instance;

    private array $instances = [];

    public static function setInstance(ApplicationContract $instance): void
    {
        static::$instance = $instance;
    }

    public static function getInstance(): ApplicationContract|static
    {
        if (!static::$instance) {
            return new static();
        }

        return static::$instance;
    }

    /**
     * @template TInstance of mixed
     *
     * @param  string  $abstract
     * @param  TInstance  $instance
     * @return TInstance
     */
    public function instance(string $key, object $instance): object
    {
        $this->instances[$key] = $instance;

        return $instance;
    }

    public function resolve(string $key): mixed
    {
        if (!isset($this->instances[$key])) {
            return false;
        }

        return $this->instances[$key];
    }
}
