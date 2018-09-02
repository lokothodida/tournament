<?php

namespace lokothodida\Tournament\Event;

abstract class Event
{
	abstract public function name(): string;

	abstract public function payload(): array;
}
