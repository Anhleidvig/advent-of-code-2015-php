<?php

use App\Core\Application;
use App\Console\Day1\InstructionSolver;
use App\Console\Day1\Command as Day1Command;

return Application::make(basePath: dirname(__DIR__))
    ->registerCommands([
        new Day1Command(new InstructionSolver()),
    ]);
