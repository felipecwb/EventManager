<?php

namespace PHPFluent\EventManager\Listener;

use Arara\Process\Action\Action;

class ListenerFactory
{
    /**
     * @throws \InvalidArgumentException
     * @return \PHPFluent\EventManager\Listener
     */
    public static function create($listener)
    {
        if ($listener instanceof Listener) {
            return $listener;
        }

        if (is_callable($listener)) {
            return new Callback($listener);
        }

        // pthreads extension
        if (extension_loaded('pthreads')
            && is_subclass_of($listener, '\Thread')
        ) {
            return new PThread($listener);
        }

        if ($listener instanceof Action) {
            return new Process($listener);
        }

        throw new \InvalidArgumentException('Invalid listener! Try a callback ;)');
    }
}
