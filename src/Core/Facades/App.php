<?php

namespace App\Core\Facades;

use App\Core\Application;
use App\Core\Contracts\Application as ApplicationContract;
use Symfony\Component\Console\Application as SymfonyApplication;

/**
 * @method ApplicationContract registerCommands(array $commands)
 * @method ApplicationContract function make(string $basePath)
 * @method SymfonyApplication getConsole()
 * @method int handleCommand()
 * @method string basePath(string $path = '')
 * @method string bootstrapPath(string $path = '')
 * @method string storagePath(string $path = '')
 * @method void setHasbeenBootstrapped()
 * @method bool hasBeenBootstrapped()
 * @method string getName()
 * @method string getVersion()
 *
 * @see Application
 */
class App extends Facade
{
    public static function accessor(): string
    {
        return 'app';
    }
}
