<?php

namespace App\Console\Day2;

use Closure;
use Exception;
use App\Core\Facades\App;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

#[AsCommand(
    name: 'day-2',
    description: 'Runs the day-2 solution of Advent of Code',
)]
final class Command extends SymfonyCommand
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }
}
