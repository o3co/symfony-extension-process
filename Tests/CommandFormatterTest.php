<?php
namespace O3Co\SymfonyExtension\Process\Tests;

use O3Co\SymfonyExtension\Process\CommandFormatter;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Console\Command\HelpCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;

class CommandFormatterTest extends \PHPUnit_Framework_TestCase 
{
    public function testGetterSetter()
    {
		$command = new ListCommand();

		$input = new ArrayInput(array('--xml' => true));

		$formatter = new CommandFormatter($command, $input); 

        $this->assertEquals('php app/console', $formatter->getConsolePath());
        $formatter->setConsolePath('app/console');
        $this->assertEquals('app/console', $formatter->getConsolePath());

        $this->assertInstanceof('Symfony\Component\Console\Command\ListCommand', $formatter->getCommand());
        $formatter->setCommand(new HelpCommand());
        $this->assertInstanceof('Symfony\Component\Console\Command\HelpCommand', $formatter->getCommand());
    }

	public function testFormat()
	{
		$command = new ListCommand();

		$input = new ArrayInput(array('--xml' => true));

		$formatter = new CommandFormatter($command, $input); 

		$this->assertEquals('php app/console list --xml --format="txt"', $formatter->format());
		$this->assertEquals('php app/console list --xml --format="txt"', (string)$formatter);


        // command with application
        $application = new Application();

        $command = $application->find('list');
        // 
        $command->getDefinition()->addOption(new InputOption('hoge', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY));

        $input = new ArrayInput(array('--xml' => true, '--hoge' => array('foo', 'bar')));
		$formatter = new CommandFormatter($command, $input); 

		$this->assertEquals('php app/console list --xml --format="txt" --hoge=foo --hoge=bar', $formatter->format());
	}
}

