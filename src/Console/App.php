<?php

namespace App\Console;

use Symfony\Component\Console\Application;
use Traversable;
use function iterator_to_array;

class App extends Application
{
    public function __construct(iterable $commands)
    {
        $commands = $commands instanceof Traversable ? iterator_to_array($commands) : $commands;

        foreach ($commands as $command) {
            $this->add($command);
        }

        $this->setAutoExit(false);

        parent::__construct("Symphony console application", "1.0");
    }

}