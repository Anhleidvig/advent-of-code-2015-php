<?php

namespace App\Tests\Unit\Day2;

use App\Console\Day2\Box;
use PHPUnit\Framework\TestCase;

final class BoxTest extends TestCase
{
    public function testGetBoxArea(): void
    {
        $box = new Box(2, 3, 4);
        $expected = 2 * ((2 * 3) + (3 * 4) + (4 * 2)); // 2*(6+12+8) = 2*26 = 52
        $this->assertEquals($expected, $box->getBoxArea());
    }

    public function testGetPlusArea(): void
    {
        $box = new Box(2, 3, 4);
        // surface areas: 6, 12, 8 → min is 6
        $this->assertEquals(6, $box->getPlusArea());
    }

    public function testGetVolume(): void
    {
        $box = new Box(2, 3, 4);
        $this->assertEquals(24, $box->getVolume());
    }

    public function testGetRibbonLength(): void
    {
        $box = new Box(2, 3, 4);
        // sorted: 2, 3, 4 → wrap = 2*(2+3) = 10, bow = 24 → total = 34
        $this->assertEquals(34, $box->getRibbonLength());
    }

    public function testGetRibbonLengthForCube(): void
    {
        $box = new Box(5, 5, 5);
        // wrap = 2*(5+5) = 20, bow = 125 → total = 145
        $this->assertEquals(145, $box->getRibbonLength());
    }
}
