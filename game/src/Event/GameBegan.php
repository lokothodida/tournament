<?php

namespace lokothodida\Tournament\Event;

final class GameBegan extends Event
{
	public function name(): string
	{
		return 'GameBegan';
	}

	public function payload(): array
	{
		return [
		];
	}
}
