<?php

namespace PHPFluent\EventManager\Listener;

class ListenerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateSholdReturnSameListener()
    {
        $listener = $this->getMock(__NAMESPACE__ . '\Listener');
        $created = ListenerFactory::create($listener);

        $this->assertSame($listener, $created);
    }

    public function testCreateSholdReturnCallbackListener()
    {
        $created = ListenerFactory::create(function () {});

        $this->assertInstanceOf(__NAMESPACE__ . '\Callback', $created);
    }

    public function testCreateSholdReturnProcessListener()
    {
        $action = $this->getMock('Arara\Process\Action\Action');
        $created = ListenerFactory::create($action);

        $this->assertInstanceOf(__NAMESPACE__ . '\Process', $created);
    }

    public function testCreateSholdReturnPThreadListener()
    {
        if (! extension_loaded('pthreads')) {
            $this->markTestSkipped('The pthreads extension is not available.');
        }
        $thread = $this->getMock('\Thread');
        $created = ListenerFactory::create($thread);

        $this->assertInstanceOf(__NAMESPACE__ . '\PThread', $created);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateSholdThrowInvalidArgumentExceptionOnNotCallback()
    {
        ListenerFactory::create(null);
    }
}
