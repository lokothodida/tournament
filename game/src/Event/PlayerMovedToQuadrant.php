<?php

namespace lokothodida\Tournament\Event;

final class PlayerMovedToQuadrant extends Event
{
	private $playerName;
	private $quadrant;

	public function __construct(string $playerName, int $quadrant)
	{
		$this->playerName = $playerName;
		$this->quadrant = $quadrant;
	}

	public function name(): string
	{
		return 'PlayerMovedToQuadrant';
	}

	public function payload(): array
	{
		return [
			'playerName' => $this->playerName,
			'quadrant' => $this->quadrant
		];
	}
}
