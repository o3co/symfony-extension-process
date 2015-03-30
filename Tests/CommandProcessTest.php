<?php
namespace O3Co\SymfonyExtension\Process\Tests;

use O3Co\SymfonyExtension\Process\CommandProcess;
use O3Co\SymfonyExtension\Process\Command\EchoCommand;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Console\Command\HelpCommand;
use Symfony\Component\Console\Input\ArrayInput;

class CommandProcessTest extends \PHPUnit_Framework_TestCase 
{
	public function testFormat()
	{
		$command = new ListCommand();
		$input = new ArrayInput(array('--xml' => true));

		$process = new CommandProcess($command, $input); 

        $this->assertInstanceof('O3Co\SymfonyExtension\Process\CommandFormatter', $process->getCommandLine());
        $this->assertInstanceof('Symfony\Component\Console\Command\ListCommand', $process->getCommandLine()->getCommand());


        $process->setCommand(new HelpCommand(), new ArrayInput(array()));
        $this->assertInstanceof('Symfony\Component\Console\Command\HelpCommand', $process->getCommandLine()->getCommand());

	}

    public function testStart()
    {
		$process = new CommandProcess(new EchoCommand(), new ArrayInput(array('message' => 'test message')));

        $process->getCommandLine()->setConsolePath('echo');

        $response = $process->run();
        if (!$process->isSuccessful()) {
            $this->fail((string)$process->getErrorOutput());
        }
        // Echo replace '"' double quote, and append eol  
        $this->assertEquals("message test message\n", $process->getOutput());
    }
}

