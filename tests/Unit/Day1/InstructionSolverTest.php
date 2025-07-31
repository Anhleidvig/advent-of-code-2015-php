<?php

namespace App\Tests\Unit\Day1;

use PHPUnit\Framework\TestCase;
use App\Console\Day1\InstructionSolver;

final class InstructionSolverTest extends TestCase
{
    public function testCalculateFinalLevel(): void
    {
        $solver = new InstructionSolver();

        $solver->setInstructions('()()');
        $this->assertEquals(0, $solver->calculateFinalLevel());

        $solver->setInstructions(' (12s)(12s) ');
        $this->assertEquals(0, $solver->calculateFinalLevel());

        $solver->setInstructions('((())())');
        $this->assertEquals(0, $solver->calculateFinalLevel());

        $solver->setInstructions(' (((12s))(12s)) ');
        $this->assertEquals(0, $solver->calculateFinalLevel());

        $solver->setInstructions('');
        $this->assertEquals(0, $solver->calculateFinalLevel());

        $solver->setInstructions('12s');
        $this->assertEquals(0, $solver->calculateFinalLevel());

        $solver->setInstructions(' ((((12s ');
        $this->assertEquals(4, $solver->calculateFinalLevel());

        $solver->setInstructions(' (12s((( ');
        $this->assertEquals(4, $solver->calculateFinalLevel());

        $solver->setInstructions('))))');
        $this->assertEquals(-4, $solver->calculateFinalLevel());

        $solver->setInstructions(' )))12s) ');
        $this->assertEquals(-4, $solver->calculateFinalLevel());
    }

    public function testFindFirstInstructionIndexByLevel(): void
    {
        $solver = new InstructionSolver();

        $solver->setInstructions('((((');
        $this->assertEquals(4, $solver->findFirstInstructionIndexByLevel(4));

        $solver->setInstructions('))))');
        $this->assertEquals(4, $solver->findFirstInstructionIndexByLevel(-4));
    }
}
