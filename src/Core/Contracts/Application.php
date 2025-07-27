<?php

namespace App\Core\Contracts;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Application as SymfonyApplication;

interface Application
{
    public static function make(string $basePath): Application;

    public function getConsole(): SymfonyApplication;
    /**
    * @param Command[] $commands
    *
    * @return Application
    */
    public function registerCommands(array $commands): Application;
    public function basePath(string $path = ''): string;
    public function bootstrapPath(string $path = ''): string;
    public function storagePath(string $path = ''): string;
    public function hasBeenBootstrapped(): bool;
    public function setHasBeenBootstrapped(): void;
    public function getVersion(): string;
    public function getName(): string;
}
