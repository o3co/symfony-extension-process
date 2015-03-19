<?php
namespace O3Co\SymfonyExtension\Process\Tests;

use O3Co\SymfonyExtension\Process\CommandFormatter;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Console\Input\ArrayInput;

class CommandFormatterTest extends \PHPUnit_Framework_TestCase 
{
	public function testFormat()
	{
		$command = new ListCommand();

		$input = new ArrayInput(array('--xml' => true));

		$formatter = new CommandFormatter($command, $input); 

		$this->assertEquals('app/console list --xml --format="txt"', $formatter->format());
		$this->assertEquals('app/console list --xml --format="txt"', (string)$formatter);
	}
}

