<?php

use App\Console\Day1\Command as Day1Command;
use App\Core\Application;

return Application::make(basePath: dirname(__DIR__))
    ->registerCommands([
        new Day1Command(),
    ]);
