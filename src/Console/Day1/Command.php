<?php

namespace App\Console\Day1;

use App\Core\Facades\App;
use Closure;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

#[AsCommand(
    name: 'day-1',
    description: 'Runs the day-1 solution of Advent of Code',
)]
final class Command extends SymfonyCommand
{
    protected const int START_FLOOR = 0;
    protected const string INSTRUCTION_LEVEL_UP = '(';
    protected const string INSTRUCTION_LEVEL_DOWN = ')';

    protected const int CHUNK_SIZE = 8000;
    protected const string INPUT_FILE_NAME = 'day-1-input.txt';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $instructions = $this->readInputFile();

        $this->partOneSolution($instructions);
        $this->partTwoSolution($instructions);

        return Command::SUCCESS;
    }

    protected function partOneSolution(string $instructions): void
    {
        $finalLevel = $this->walkInstructions($instructions);

        echo "The final floor is: $finalLevel" . PHP_EOL;
    }

    protected function partTwoSolution(string $instructions): void
    {
        $currentLevel = 0;
        $instructionIndex = false;

        for ($i = static::START_FLOOR; $i < strlen($instructions); $i++) {
            $currentLevel += match ($instructions[$i]) {
                static::INSTRUCTION_LEVEL_UP => +1,
                static::INSTRUCTION_LEVEL_DOWN => -1,
            };

            if ($currentLevel === -1) {
                $instructionIndex = $i + 1;
                break;
            }
        }

        if (!$instructionIndex) {
            echo "No index lead to -1 level" . PHP_EOL;
            return;
        }

        echo "The index of the instruction that lead to -1 level is: $instructionIndex" . PHP_EOL;
    }

    protected function walkInstructions(string $instructions): int
    {
        $currentLevel = static::START_FLOOR;

        for ($i = static::START_FLOOR; $i < strlen($instructions); $i++) {
            $currentLevel += match ($instructions[$i]) {
                static::INSTRUCTION_LEVEL_UP => +1,
                static::INSTRUCTION_LEVEL_DOWN => -1,
            };
        }

        return $currentLevel;
    }

    protected function readInputFile(): string
    {
        $inputFilePath = App::storagePath(static::INPUT_FILE_NAME);

        if (!file_exists($inputFilePath)) {
            throw new Exception("The input file '$inputFilePath' was not found.");
        }

        $stream = fopen($inputFilePath, 'r');

        if (!$stream) {
            throw new Exception("Unable to open input file '$inputFilePath'.");
        }

        $buffer = '';

        while (!feof($stream)) {
            $buffer .= fread($stream, static::CHUNK_SIZE);
        }

        fclose($stream);

        return trim($buffer);
    }
}
