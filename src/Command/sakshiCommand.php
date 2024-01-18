<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class sakshiCommand extends AbstractCommand
{

    protected function configure()
    {
        $this
            ->setName('my')
            ->setDescription('My custom command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Use fgets to get user input
        $output->write('Enter something: ');
        $answer = trim(fgets(STDIN));

        // Process the user input
        $output->writeln('You entered: ' . $answer+5);

        return 0;
    }


}

