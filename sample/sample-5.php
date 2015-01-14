<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (! extension_loaded('pthreads')) {
    echo 'Need pthreads extension to execute.' . PHP_EOL;
}

use PHPFluent\EventManager\Manager;

class AsyncOperation extends \Thread
{
    private $closure;
    private $args;

    public function __construct(\Closure $closure, array $args = [])
    {
        $this->closure = $closure;
        $this->args    = $args;
    }

    public function run()
    {
        call_user_func_array($this->closure, $this->args);
    }
}

$thread = new AsyncOperation(function () {
    echo "-async.event start: " . date('H:i:s') . PHP_EOL;
    sleep(5);
    echo "-async.event end: " . date('H:i:s') . PHP_EOL;
});

$eventManager = new Manager();
$eventManager->addEventListener('async', $thread);
$eventManager->dispatchEvent('async');

echo '* Script Execution Continued...' . PHP_EOL;
sleep(2);
echo '* Script Execution Finished!' . PHP_EOL;
