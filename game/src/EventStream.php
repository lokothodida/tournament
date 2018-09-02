<?php

namespace lokothodida\Tournament;

use lokothodida\Tournament\Event\Event;

interface EventStream
{
	public function append(Event $event): void;
}
