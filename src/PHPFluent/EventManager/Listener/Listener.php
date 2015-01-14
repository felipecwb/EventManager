<?php

namespace PHPFluent\EventManager\Listener;

use PHPFluent\EventManager\Event;

interface Listener
{
    /**
     *
     * @param \PHPFluent\EventManager\Event $event
     * @param array $context
     */
    public function execute(Event $event, array $context = array());
}
