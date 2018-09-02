<?php

namespace lokothodida\Tournament;

use lokothodida\Tournament\Event\Event;

class ArrayEventStream implements EventStream
{
	private $events = [];

	public function append(Event $event): void
	{
		$this->events[] = $event;
	}

	public function toArray(): array
	{
		return $this->events;
	}
}
