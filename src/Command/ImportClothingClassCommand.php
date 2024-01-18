<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportClothingClassCommand extends AbstractCommand
{
    protected function configure(): void{
        $this
            ->setName('importObjectsOfCLothingClass')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Use fgets to get user input
        $output->writeln('Below are the classes for importing their objects: ');
        $output->writeln('1. Brand Class');
        $output->writeln('2. Store Class');
        $output->writeln('3. Category Class');
        $output->writeln('4. Product Class');
        $output->write('Enter your choice: ');
        $answer = trim(fgets(STDIN));

        switch ($answer){
            case 1:
                $this->getApplication()->find('importbrand')->run($input, $output);
                break;
            case 2:
                $this->getApplication()->find('importstore')->run($input, $output);
                break;
            case 3:
                $this->getApplication()->find('importcategory')->run($input, $output);
                break;
            case 4:
                $this->getApplication()->find('importproduct')->run($input, $output);
                break;
            default:
                $output->writeln('Invalid choice. Please enter a number between 1 and 4.');
        }
        return 0;
    }
}