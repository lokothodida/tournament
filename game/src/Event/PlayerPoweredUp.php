<?php

namespace lokothodida\Tournament\Event;

final class PlayerPoweredUp extends Event
{
	private $playerName;
	private $poweredUpBy;

	public function __construct(string $playerName, int $poweredUpBy)
	{
		$this->playerName = $playerName;
		$this->poweredUpBy = $poweredUpBy;
	}

	public function name(): string
	{
		return 'PlayerPoweredUp';
	}

	public function payload(): array
	{
		return [
			'playerName' => $this->playerName,
			'poweredUpBy' => $this->poweredUpBy
		];
	}
}
