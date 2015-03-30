<?php
namespace O3Co\SymfonyExtension\Process\Tests\Command;

use O3Co\SymfonyExtension\Process\Command\EchoCommand;
use Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Output\BufferedOutput
;


class EchoCommandTest extends \PHPUnit_Framework_TestCase 
{
    public function testRun()
    {
        $command = new EchoCommand();

        $input = new ArrayInput(array('message' => 'test message'));
        $output = new BufferedOutput();

        $command->run($input, $output);

        $this->assertEquals("test message\n", $output->fetch());
    }
}

