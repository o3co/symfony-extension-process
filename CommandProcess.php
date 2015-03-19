<?php
namespace O3Co\SymfonyExtension\Process;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Process\Process;

/**
 * CommandProcess 
 * 
 * @uses Process
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CommandProcess extends Process 
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
		return $this->setCommandLine(new CommandFormatter($command, $input));
	}
}

