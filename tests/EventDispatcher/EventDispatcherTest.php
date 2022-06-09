<?php

namespace Tests\EventDispatcher;

use EventDispatcher\EventDispatcher;
use Tests\EventDispatcherUnitTestModule;

final class EventDispatcherTest extends EventDispatcherUnitTestModule
{
    private EventDispatcher $SUT;

    protected function setUp(): void
    {
        $this->SUT = new EventDispatcher($this->listener());
        parent::setUp();
    }

    public function test_should_not_dispatch_event(): void
    {
        $event = EventMother::create();
        $this->shouldGetListener($event, []);

        $result = $this->SUT->dispatch($event);
        $this->assertEquals($event, $result);
        $this->assertFalse($event->isCalled());
    }

    public function test_should_dispatch_event(): void
    {
        $event = EventMother::create();
        $eventHandler = new EventHandler();

        $this->shouldGetListener($event, [$eventHandler]);

        $result = $this->SUT->dispatch($event);
        $this->assertEquals($event, $result);
        $this->assertTrue($event->isCalled());
    }
}