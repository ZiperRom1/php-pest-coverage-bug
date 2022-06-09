<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestingCommand extends Command
{
    protected static $defaultName        = 'test';
    protected static $defaultDescription = 'Test command that should print `test`';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Configures the current command.
     */
    protected function configure(): void
    {
        $this->addArgument('string', InputArgument::OPTIONAL, 'String to add after `test`');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->text('test');

        return Command::SUCCESS;
    }
}