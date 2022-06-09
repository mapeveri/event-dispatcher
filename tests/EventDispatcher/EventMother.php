<?php

namespace Tests\EventDispatcher;

use EventDispatcher\Event;

final class EventMother
{
    public static function create(): Event
    {
        return new class extends Event {
            private bool $called = false;

            public function call() {
                $this->called = true;
            }

            public function isCalled(): bool
            {
                return $this->called;
            }
        };
    }
}