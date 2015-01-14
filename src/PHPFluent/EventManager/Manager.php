<?php

namespace PHPFluent\EventManager;

class Manager
{
    /**
     * @var array
     */
    protected $events = array();

    /**
     * Get an Event by name
     *
     * @param string $eventName
     * @return \PHPFluent\EventManager\Event
     */
    public function getEvent($eventName)
    {
        if (! isset($this->events[$eventName])) {
            $this->events[$eventName] = new Event($eventName);
        }

        return $this->events[$eventName];
    }

    /**
     * Add an Event Listener
     *
     * @param string $eventName
     * @param mixed $listener
     * @throws \InvalidArgumentException If argument cannot be interpreted
     */
    public function addEventListener($eventName, $listener)
    {
        $listener = Listener\ListenerFactory::create($listener);

        $this->getEvent($eventName)
            ->getListeners()
            ->add($listener);
    }

    /**
     * Dispatch an Event
     *
     * @param string $eventName
     * @param array $context
     */
    public function dispatchEvent($eventName, array $context = array())
    {
        $event = $this->getEvent($eventName);

        foreach ($event->getListeners() as $listener) {
            if ($event->isPropagationStopped()) {
                break;
            }

            $listener->execute($event, $context);
        }
    }

    public function __set($eventName, $listener)
    {
        $this->addEventListener($eventName, $listener);
    }

    public function __call($eventName, array $arguments = array())
    {
        $argument = array();

        if (! empty($arguments)) {
            $argument = array_shift($arguments);
        }

        $this->dispatchEvent($eventName, $argument);
    }
}
