<?php

namespace App\Console\Day2;

class Box
{
    public function __construct(
        private int $length,
        private int $width,
        private int $height,
    ) {}

    public function getBoxArea(): int
    {
        return 2 * (
            ($this->length * $this->width) +
            ($this->width * $this->height) +
            ($this->height * $this->length)
        );
    }

    public function getPlusArea(): int
    {
        return min(
            $this->length * $this->width,
            $this->width * $this->height,
            $this->height * $this->length
        );
    }

    public function getRibbonLength(): int
    {
        $sides = [$this->length, $this->width, $this->height];

        sort($sides);

        $wrapRibbon = 2 * ($sides[0] + $sides[1]);
        $bow = $this->length * $this->width * $this->height;

        return $wrapRibbon + $bow;
    }
}
