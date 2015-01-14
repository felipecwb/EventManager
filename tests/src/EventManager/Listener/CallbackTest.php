<?php

namespace PHPFluent\EventManager\Listener;

use PHPFluent\EventManager\Event;
use ReflectionFunction;

/**
 * @covers PHPFluent\EventManager\Listener\Callback
 */
class CallbackTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldDefineCallbackOnConstructor()
    {
        $callback   = function () {};
        $reflection = new ReflectionFunction($callback);
        $listener   = new Callback($callback);

        $this->assertAttributeEquals($reflection, 'reflection', $listener);
    }

    public function testShouldRunDefinedCallback()
    {
        $callback = function () {
            return 'Whatever';
        };

        $listener       = new Callback($callback);
        $event          = new Event('name');
        $result         = $listener->execute($event);
        $expectedResult = 'Whatever';

        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldRunDefinedCallbackWhenItUsesEventAsFirstArgument()
    {
        $callback = function (Event $event) {
            return get_class($event);
        };

        $listener       = new Callback($callback);
        $event          = new Event('name');
        $result         = $listener->execute($event, range(1, 3));
        $expectedResult = 'PHPFluent\EventManager\Event';

        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldRunDefinedCallbackWhenItUsesEventAsFirstArgumentAndParamsAsSecondArgument()
    {
        $callback = function (Event $event, array $params = array()) {
            return json_encode(func_get_args());
        };

        $listener       = new Callback($callback);
        $event          = new Event('name');
        $result         = $listener->execute($event, range(1, 3));
        $expectedResult = '[{},[1,2,3]]';

        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldRunDefinedCallbackWhenItUsesArrayAsFirstArgument()
    {
        $callback = function (array $params = array()) {
            return json_encode($params);
        };

        $listener       = new Callback($callback);
        $event          = new Event('name');
        $result         = $listener->execute($event, range(1, 3));
        $expectedResult = '[1,2,3]';

        $this->assertEquals($expectedResult, $result);
    }
}
