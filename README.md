## Execute Command in Isolated Process

````php
$command = $this->application->find('acme:hello');
$process = new CommandProcess($command, new ArrayInput(array('name' => 'joe')));


$process->run();
````
