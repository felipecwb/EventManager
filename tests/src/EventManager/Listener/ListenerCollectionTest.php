<?php

namespace PHPFluent\EventManager\Listener;

use ReflectionFunction;

/**
 * @covers PHPFluent\EventManager\Listener\ListenerCollection
 */
class ListenerCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldAddListenerToCollection()
    {
        $listener   = $this->getMock('PHPFluent\EventManager\Listener\Listener');
        $collection = new ListenerCollection();

        $collection->add($listener);

        $this->assertCount(1, $collection);
    }

    public function testShouldBeIterable()
    {
        $collection = new ListenerCollection();

        $collection->add($this->getMock('PHPFluent\EventManager\Listener\Listener'));

        foreach ($collection as $listener) {
            $this->assertInstanceOf(
                'PHPFluent\EventManager\Listener\Listener',
                $listener
            );
        }
    }
}
