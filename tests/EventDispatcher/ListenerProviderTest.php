<?php

namespace Tests\EventDispatcher;

use EventDispatcher\ListenerProvider;
use Tests\EventDispatcherUnitTestModule;

final class ListenerProviderTest extends EventDispatcherUnitTestModule
{
    private ListenerProvider $SUT;

    protected function setUp(): void
    {
        $this->SUT = new ListenerProvider();
        parent::setUp();
    }

    public function test_should_not_get_listeners(): void
    {
        $event = EventMother::create();

        $result = $this->SUT->getListenersForEvent($event);
        $this->assertEquals([], $result);
    }

    public function test_should_get_listeners(): void
    {
        $event = EventMother::create();
        $eventHandler = new EventHandler();
        $eventName = get_class($event);

        $this->SUT->addListener($eventName, $eventHandler);

        $result = $this->SUT->getListenersForEvent($event);
        $this->assertEquals([$eventHandler], $result);

        $this->SUT->clearListeners($eventName);
        $result = $this->SUT->getListenersForEvent($event);
        $this->assertEquals([], $result);
    }
}