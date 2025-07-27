<?php

namespace App\Core\Helpers;

use Closure;

class Str
{
    public function __construct(
        private string $string,
    ) {
        //
    }

    public static function make(string $string): self
    {
        return new static($string);
    }

    public function rightTrim(string $characters): self
    {
        $this->string = rtrim($this->string, $characters);

        return $this;
    }

    public function appendIf(string $string, Closure|bool $condition): self
    {
        $condition = match (true) {
            is_bool($condition) => $condition,
            $condition instanceof Closure => filter_var($condition(), FILTER_VALIDATE_BOOL),
            default => false,
        };

        if ($condition) {
            $this->append($string);
        }

        return $this;
    }

    public function prepend(string $string): self
    {
        $this->string = $string .= $this->string;

        return $this;
    }

    public function append(string $string): self
    {
        $this->string .= $string;

        return $this;
    }

    public function toString(): string
    {
        return $this->string;
    }

    public function __toString(): string
    {
        return $this->string;
    }
}
