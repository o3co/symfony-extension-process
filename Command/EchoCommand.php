<?php
namespace O3Co\SymfonyExtension\Process\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface
;

class EchoCommand extends Command 
{
    protected function configure()
    {
        $this
            ->setName('message')
            ->setDescription('Echo message')
            ->setDefinition(array(
                    new InputArgument('message', InputArgument::REQUIRED, 'String to output'),
                ))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = $input->getArgument('message');

        $output->writeln($message);
    }
}

