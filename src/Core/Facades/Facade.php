<?php

namespace App\Core\Facades;

use Exception;
use App\Core\Container;

abstract class Facade
{
    abstract static function accessor(): string;

    protected static function resolveInstance(): mixed
    {
        return Container::getInstance()->resolve(static::accessor());
    }

    public static function __callStatic(string $name, array $arguments): mixed
    {
        $instance = static::resolveInstance();

        if (!$instance) {
            throw new Exception("Instance of facade '$name' not found.");
        }

        return call_user_func(
            [static::resolveInstance(), $name],
            ...$arguments,
        );
    }
}
