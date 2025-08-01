<?php

namespace App\Console\Day2;

use Exception;
use App\Console\Day2\Box;
use App\Core\Facades\App;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use App\Core\Exceptions\FileNotFoundException;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'day-2',
    description: 'Runs the day-2 solution of Advent of Code',
)]
final class Day2Command extends Command
{
    public function __invoke(
        #[Argument('The file that is going to be processed.')]
        string $fileName,
        OutputInterface $output,
    ): int {
        $totalRibbon = 0;
        $totalWrappingPaper = 0;
        $inputFilePath = App::storagePath($fileName);

        /** @var Box $box */
        foreach (static::inputFileChunk($inputFilePath) as $box) {
            $totalWrappingPaper += $box->getBoxArea() + $box->getPlusArea();
            $totalRibbon += $box->getRibbonLength();
        }

        $output->writeln("Total wrapping paper needed: {$totalWrappingPaper} feet².");
        $output->writeln("Total ribbon needed: {$totalRibbon} feet.");

        return Command::SUCCESS;
    }

    /**
     * This generator method reads the file given by you by $inputFilePath.
     *
     * @param string $inputFilePath
     *
     * @return Generator<Box>
     */
    protected static function inputFileChunk(string $inputFilePath, ?int $lengthOfLine = null): iterable
    {
        if ($lengthOfLine === 0) {
            throw new InvalidArgumentException("The length of the line can not be 0.");
        }

        if (!file_exists($inputFilePath)) {
            throw new FileNotFoundException($inputFilePath);
        }

        $stream = fopen($inputFilePath, 'r');

        if (!$stream) {
            throw new Exception("Unable to open input file '$inputFilePath'.");
        }

        while (!feof($stream)) {
            $line = fgets($stream, $lengthOfLine);

            if ($line === false && !feof($stream)) {
                throw new Exception("Error reading from file: $inputFilePath");
            }

            if ($line === false && feof($stream)) {
                break;
            }

            $line = trim($line);

            if (empty($line)) {
                continue;
            }

            [$length, $width, $height] = explode('x', $line, 3);

            yield new Box($length, $width, $height);
        }

        fclose($stream);
    }
}
