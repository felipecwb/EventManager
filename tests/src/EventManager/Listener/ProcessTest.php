<?php

namespace PHPFluent\EventManager\Listener;

use PHPFluent\EventManager\Event;
use Arara\Process\Control;
use Arara\Process\Child;

/**
 * @covers PHPFluent\EventManager\Listener\Process
 */
class ProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorShouldDefineChild()
    {
        $action   = $this->getMock('Arara\Process\Action\Action');
        $child    = new Child($action, new Control());
        $listener = new Process($action);

        $this->assertAttributeEquals($child, 'child', $listener);
    }

    public function testExecuteShouldReturnChild()
    {
        $action   = $this->getMock('Arara\Process\Action\Action');
        $child    = new Child($action, new Control());
        $listener = new Process($action);
        
        $this->assertInstanceOf('Arara\Process\Child', $listener->execute(new Event('')));
    }
}
