<?php
namespace O3Co\SymfonyExtension\Process;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

/**
 * CommandFormatter 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CommandFormatter  
{
	/**
	 * command 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $command;

	/**
	 * input 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $input;

	/**
	 * consolePath 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $consolePath;

	/**
	 * __construct 
	 * 
	 * @param Command $command 
	 * @param InputInterface $input 
	 * @access public
	 * @return void
	 */
	public function __construct(Command $command, InputInterface $input, $consolePath = 'php app/console')
	{
		$this->command = $command;
		$this->input = $input;
		$this->consolePath = $consolePath;
	}

	/**
	 * format 
	 * 
	 * @access public
	 * @return void
	 */
	public function format()
	{
		$this->input->bind($this->command->getDefinition());
	
		$this->input->validate();
		
		$args = array();
		foreach($this->input->getArguments() as $argument) {
			if($argument) {
				$args[] = $argument;
			}
		}
		foreach($this->input->getOptions() as $opt => $value) {
			if(is_bool($value)) {
				if($value) {
					$args[] = '--'  . $opt;
				}
			} else if(is_string($value)) {
				$args[] = '--' . $opt . '="' . $value . '"';
			} else if(!empty($value)) {
				$args[] = '--' . $opt . '=' . $value;
			}
		}

		return $this->consolePath . ' ' . $this->command->getName() . ' ' . implode(' ', $args);
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return (string)$this->format();
	}
    
    public function getConsolePath()
    {
        return $this->consolePath;
    }
    
    public function setConsolePath($consolePath)
    {
        $this->consolePath = $consolePath;
        return $this;
    }
    
    public function getCommand()
    {
        return $this->command;
    }
    
    public function setCommand(Command $command)
    {
        $this->command = $command;
        return $this;
    }
}

