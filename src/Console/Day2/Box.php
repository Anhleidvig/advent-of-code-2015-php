<?php

namespace App\Console\Day2;

class Box
{
    public function __construct(
        private int $length,
        private int $width,
        private int $height,
    ) {}
}
