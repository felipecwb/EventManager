<?php

namespace PHPFluent\EventManager\Listener;

use PHPFluent\EventManager\Event;
use Arara\Process\Action\Action;
use Arara\Process\Control;
use Arara\Process\Child;

/**
 * Work with Arara\Process
 */
class Process implements Listener
{
    /**
     * @var \Arara\Process\Child
     */
    private $child;

    public function __construct(Action $action)
    {
        $this->child = new Child($action, new Control());
    }

    /**
     * @param Event $event
     * @param array $context
     * @return \Arara\Process\Child
     */
    public function execute(Event $event, array $context = array())
    {
        $this->child->start();
        return $this->child;
    }
}
