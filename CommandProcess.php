<?php
namespace O3Co\SymfonyExtension\Process;

use Symfony\Component\Console\CommandInterface;
use Symfony\Component\Process\PhpProcess;

/**
 * CommandProcess 
 * 
 * @uses PhpProcess
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CommandProcess extends PhpProcess 
{
	/**
	 * __construct 
	 * 
	 * @param Command $command 
	 * @param InputInterface $input 
	 * @param mixed $cwd 
	 * @param array $env 
	 * @param int $timeout 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(Command $command, InputInterface $input, $cwd = null, array $env = array(), $timeout = 60, array $options = array())
	{
		parent::__construct(new CommandFormatter($command, $input), $cwd, $env, $timeout, $options);
	}

	/**
	 * setCommand 
	 * 
	 * @param Command $command 
	 * @param InputInterface $input 
	 * @access public
	 * @return void
	 */
	public function setCommand(Command $command, InputInterface $input)
	{
		$this->setInput(new CommandFormatter($command, $input, 'app/console'));
		return $this;
	}
}

