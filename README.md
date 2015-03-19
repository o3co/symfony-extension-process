
## Install with Composer

add `"o3co/symfony-extension-process" : "~0.1.0"` to `require` 

## Execute Command in Isolated Process

````php
$command = $this->application->find('acme:hello');
$process = new CommandProcess($command, new ArrayInput(array('name' => 'joe')));


$process->run();
````
