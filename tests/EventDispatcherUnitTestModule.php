<?php

namespace Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\ListenerProviderInterface;

class EventDispatcherUnitTestModule extends TestCase
{
    protected ListenerProviderInterface|MockObject $listenerProvider;

    protected function shouldGetListener(object $event, array $values): void
    {
        $this->listener()
            ->expects($this->exactly(1))
            ->method('getListenersForEvent')
            ->with(
                $this->equalTo($event),
            )
            ->will($this->returnValue($values));
    }

    protected function listener(): ListenerProviderInterface|MockObject
    {
        return $this->listenerProvider = $this->listenerProvider ?? $this->createMock(ListenerProviderInterface::class);
    }
}