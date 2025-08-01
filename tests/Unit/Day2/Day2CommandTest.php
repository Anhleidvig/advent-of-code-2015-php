<?php

namespace App\Tests\Unit\Day2;

use App\Core\Application;
use PHPUnit\Framework\TestCase;
use App\Console\Day2\Day2Command;
use Symfony\Component\Console\Command\Command;
use App\Core\Exceptions\FileNotFoundException;
use Symfony\Component\Console\Tester\CommandTester;

final class Day2CommandTest extends TestCase
{
    protected const string FILE_NAME_GOOD = 'day-2-input.txt';
    protected const string FILE_NAME_WRONG = 'day-2-input-not-existing.txt';

    public function setUp(): void
    {
        $basePath = dirname(dirname(dirname(__DIR__)));

        Application::make($basePath);
    }

    public function testCommandExecution(): void
    {
        $command = new Day2Command();
        $tester = new CommandTester($command);

        $status = $tester->execute([
            'file-name' => static::FILE_NAME_GOOD,
        ]);

        $this->assertEquals(Command::SUCCESS, $status);
    }

    public function testCommandWithFileNotFound(): void
    {
        $this->expectException(FileNotFoundException::class);

        $command = new Day2Command();
        $tester = new CommandTester($command);

        $tester->execute([
            'file-name' => static::FILE_NAME_WRONG,
        ]);
    }
}
