<?php

namespace App\Console\Day1;

use Closure;
use Exception;
use App\Core\Facades\App;
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
    protected const int START_LEVEL = 0;
    protected const int BASEMENT_LEVEL = -1;
    protected const string INSTRUCTION_LEVEL_UP = '(';
    protected const string INSTRUCTION_LEVEL_DOWN = ')';

    protected const int CHUNK_SIZE = 8000;
    protected const string INPUT_FILE_NAME = 'day-1-input.txt';

    protected const string SOLUTION_1_MESSAGE = "The final level is: %d";
    protected const string SOLUTION_2_MESSAGE = "The index of the first instruction leading to basement (%d) is: %d";

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $instructions = $this->readInputFile();

        $results = $this->solve($instructions, $output);

        $output->writeln(sprintf(
            static::SOLUTION_1_MESSAGE,
            $results['finalLevel'],
        ));
        $output->writeln(sprintf(
            static::SOLUTION_2_MESSAGE,
            static::BASEMENT_LEVEL,
            $results['basementIndex'],
        ));

        return Command::SUCCESS;
    }

    protected function solve(string $instructions, OutputInterface $output): array
    {
        $basementIndex = null;

        $finalLevel = static::walkInstructions(
            function (int $currentLvl, int $index) use (&$basementIndex) {
                if ($currentLvl === static::BASEMENT_LEVEL && is_null($basementIndex)) {
                    $basementIndex = $index + 1;
                }
            },
            $instructions,
        );

        return compact('finalLevel', 'basementIndex');
    }

    protected static function walkInstructions(Closure $callback, string $instructions): int
    {
        $currentLevel = static::START_LEVEL;

        for ($i = static::START_LEVEL; $i < strlen($instructions); $i++) {
            $currentLevel += match ($instructions[$i]) {
                static::INSTRUCTION_LEVEL_UP => +1,
                static::INSTRUCTION_LEVEL_DOWN => -1,
            };

            $callback($currentLevel, $i);
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
