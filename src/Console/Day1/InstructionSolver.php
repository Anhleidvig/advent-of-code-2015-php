<?php

namespace App\Console\Day1;

final class InstructionSolver implements InstructionSolverInterface
{
    public const int BASEMENT_LEVEL = -1;

    protected const string INSTRUCTION_LEVEL_UP = '(';
    protected const string INSTRUCTION_LEVEL_DOWN = ')';

    public function __construct(
        private string $instructions = '',
    ) {
        //
    }

    public function calculateFinalLevel(?int $startLevel = 0): int
    {
        $level = $startLevel;

        for ($i = 0; $i < strlen($this->instructions); $i++) {
            $level += match ($this->instructions[$i]) {
                static::INSTRUCTION_LEVEL_UP => +1,
                static::INSTRUCTION_LEVEL_DOWN => -1,
                default => 0,
            };
        }

        return $level;
    }

    public function findFirstInstructionIndexByLevel(int $levelToFind, ?int $startLevel = null): ?int
    {
        $level = $startLevel;

        for ($i = 0; $i < strlen($this->instructions); $i++) {
            $level += match ($this->instructions[$i]) {
                static::INSTRUCTION_LEVEL_UP => +1,
                static::INSTRUCTION_LEVEL_DOWN => -1,
                default => 0,
            };

            if ($level === $levelToFind) {
                return $i + 1;
            }
        }

        return null;
    }

    public function getInstructions(): string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): void
    {
        $this->instructions = $instructions;
    }
}
