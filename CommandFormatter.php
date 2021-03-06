<?php
namespace O3Co\SymfonyExtension\Process;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

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
		$command = clone $this->command;

        if($command->getApplication()) {
    		$command->mergeApplicationDefinition($command->getApplication()->getDefinition());
        }
        if(!$command->getDefinition()->hasArgument('command')) {
            $arguments = $command->getDefinition()->getArguments();
            array_unshift($arguments, new InputArgument('command', InputArgument::REQUIRED, 'command name'));
            $command->getDefinition()->setArguments($arguments);
        }
		$this->input->bind($command->getDefinition());

        $this->input->setArgument('command', $command->getName());
		$this->input->validate();
		
		$args = array();
		foreach($this->input->getArguments() as $argument) {
			if($argument) {
                if(is_string($argument) && preg_match('/\s/u', $argument)) {
                    $args[] = sprintf('"%s"', $argument);
                } else {
				    $args[] = $argument;
                }
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
                foreach($value as $v) {
				    $args[] = '--' . $opt . '=' . $v;
                }
			}
		}

		return $this->consolePath . ' ' . implode(' ', $args);
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

