<?php

namespace TransferObjects\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TransferObjects\DefinitionBuilder;
use TransferObjects\Generator\Generator;

class GenerateTransferCommand extends Command
{
    protected static $defaultName = 'transfer:generate';

    protected function configure(): void
    {
        $this
            ->setDescription('Create Database')
            ->setHelp('Initial database creation');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $generator = new Generator(new DefinitionBuilder());
        $generator->generate();
        return Command::SUCCESS;
    }
}
