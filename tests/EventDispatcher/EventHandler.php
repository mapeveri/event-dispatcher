<?php

namespace Tests\EventDispatcher;

use EventDispatcher\Event;

final class EventHandler
{
    public function __invoke(Event $event): void {
        $event->call();
    }
}