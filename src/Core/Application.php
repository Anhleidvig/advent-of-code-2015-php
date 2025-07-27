<?php

namespace App\Core;

use App\Core\Helpers\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use App\Core\Contracts\Application as ApplicationContract;
use Symfony\Component\Console\Application as SymfonyApplication;

final class Application extends Container implements ApplicationContract
{
    private string $name = 'AoC-2015';
    private string $version = '0.0.1';

    private bool $hasBeenBootstrapped = false;

    private SymfonyApplication $console;
    private string $bootstrapPath;
    private string $storagePath;

    public function __construct(
        private string $basePath,
    ) {
        $this->registerBaseBindings();

        $this->setHasbeenBootstrapped();
    }

    /**
     * @param Command[] $commands
     *
     * @return ApplicationContract
     */
    public function registerCommands(array $commands): ApplicationContract
    {
        foreach ($commands as $command) {
            if (!$command instanceof Command) {
                throw new InvalidArgumentException("Parameter 'commands' must be Command[]");
            }

            $command->setApplication($this->getConsole());
        }

        $this->getConsole()->addCommands($commands);

        return $this;
    }

    public static function make(string $basePath): ApplicationContract
    {
        return new static($basePath);
    }

    public function getConsole(): SymfonyApplication
    {
        return $this->console;
    }

    public function handleCommand(): int
    {
        return $this->getConsole()->run();
    }

    protected function registerBaseBindings(): void
    {
        static::setInstance($this);
        $this->instance('app', $this);

        $this->instantiateConsoleApplication();
        $this->registerPaths();
    }

    protected function instantiateConsoleApplication(): void
    {
        $this->console = new SymfonyApplication(
            $this->getName(),
            $this->getVersion(),
        );
    }

    protected function registerPaths(): void
    {
        $this->bootstrapPath = $this->basePath('bootstrap');
        $this->storagePath = $this->basePath('storage');
    }

    protected function path(string $name, string $path = ''): string
    {
        return Str::make($this->{$name})
            ->rightTrim('\/')
            ->appendIf(
                Str::make($path)
                    ->prepend(DIRECTORY_SEPARATOR)
                    ->rightTrim('\/'),
                !empty($path),
            );
    }

    public function basePath(string $path = ''): string
    {
        return $this->path('basePath', $path);
    }

    public function bootstrapPath(string $path = ''): string
    {
        return $this->path('bootstrapPath', $path);
    }

    public function storagePath(string $path = ''): string
    {
        return $this->path('storagePath', $path);
    }

    public function setHasbeenBootstrapped(): void
    {
        $this->hasBeenBootstrapped = true;
    }

    public function hasBeenBootstrapped(): bool
    {
        return $this->hasBeenBootstrapped;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}
