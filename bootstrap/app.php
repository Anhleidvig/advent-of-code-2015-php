<?php

use App\Core\Application;
use App\Console\Day1\Day1Command;
use App\Console\Day2\Day2Command;
use App\Console\Day1\InstructionSolver;

return Application::make(basePath: dirname(__DIR__))
    ->registerCommands([
        new Day1Command(new InstructionSolver()),
        new Day2Command(),
    ]);
