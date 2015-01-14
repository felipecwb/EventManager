<?php

namespace PHPFluent\EventManager\Listener;

use PHPFluent\EventManager\Event;

/**
 * work with pthreads extension
 */
class PThread implements Listener
{
    /**
     * @var \Thread
     */
    private $thread;

    public function __construct(\Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * @param Event $event
     * @param array $context
     * @return \Thread
     */
    public function execute(Event $event, array $context = array())
    {
        $this->thread->start();
        return $this->thread;
    }
}
