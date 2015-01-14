<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPFluent\EventManager\Manager;
use Arara\Process\Action\Callback;

$process = new Callback(function () {
    echo "-arara.process.event start: " . date('H:i:s') . PHP_EOL;
    sleep(5);
    echo "-arara.process.event end: " . date('H:i:s') . PHP_EOL;
});

$eventManager = new Manager();
$eventManager->addEventListener('process', $process);
$eventManager->dispatchEvent('process');

echo '* Script Execution Continued...' . PHP_EOL;
sleep(2);
echo '* Script Execution Finished!' . PHP_EOL;
