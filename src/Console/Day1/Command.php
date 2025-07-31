<?php

namespace App\Console\Day1;

use Exception;
use Generator;
use App\Core\Facades\App;
use InvalidArgumentException;
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
    protected const int CHUNK_SIZE = 8000;
    protected const string INPUT_FILE_NAME = 'day-1-input.txt';

    protected const string SOLUTION_1_MESSAGE = "The final level is: %d";
    protected const string SOLUTION_2_MESSAGE = "The index of the first instruction leading to basement (%d) is: %d";

    public function __construct(
        private InstructionSolverInterface $instructionSolver,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $finalLevel = 0;
        $basementIndex = null;
        $solver = $this->getInstructionSolver();
        $inputFilePath = App::storagePath(static::INPUT_FILE_NAME);
        $chunkSize = static::CHUNK_SIZE;

        foreach (static::inputFileChunk($inputFilePath, $chunkSize) as $buffer) {
            $solver->setInstructions($buffer);

            $finalLevel += $solver->calculateFinalLevel();

            if ($basementIndex === null) {
                $basementIndex = $solver->findFirstInstructionIndexByLevel(
                    InstructionSolver::BASEMENT_LEVEL,
                );
            }
        }

        $output->writeln(sprintf(self::SOLUTION_1_MESSAGE, $finalLevel));
        $output->writeln(sprintf(self::SOLUTION_2_MESSAGE, InstructionSolver::BASEMENT_LEVEL, $basementIndex));

        return Command::SUCCESS;
    }

    /**
     * This generator method reads the file given by you by $inputFilePath by chunks.
     * The chunk size is determined by you.
     *
     * @param string $inputFilePath
     * @param int $chunkSize
     *
     * @return Generator<string>
     */
    protected static function inputFileChunk(string $inputFilePath, int $chunkSize): iterable
    {
        if (!$chunkSize) {
            throw new InvalidArgumentException("Chunk size can not be 0.");
        }

        if (!file_exists($inputFilePath)) {
            throw new Exception("The input file '$inputFilePath' was not found.");
        }

        $stream = fopen($inputFilePath, 'r');

        if (!$stream) {
            throw new Exception("Unable to open input file '$inputFilePath'.");
        }

        while (!feof($stream)) {
            $buffer = fread($stream, static::CHUNK_SIZE);

            if ($buffer === false) {
                throw new Exception("Failed to open input file: $inputFilePath");
            }

            yield $buffer;
        }

        fclose($stream);
    }

    protected function getInstructionSolver(): InstructionSolverInterface
    {
        return $this->instructionSolver;
    }
}
