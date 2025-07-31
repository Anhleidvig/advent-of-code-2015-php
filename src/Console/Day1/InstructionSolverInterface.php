<?php

namespace App\Console\Day1;

interface InstructionSolverInterface
{
    public function setInstructions(string $instructions): void;
    public function calculateFinalLevel(?int $startLevel = 0): int;
    public function findFirstInstructionIndexByLevel(int $levelToFind, ?int $startLevel = null): ?int;
}
