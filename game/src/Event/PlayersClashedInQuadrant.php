<?php

namespace lokothodida\Tournament\Event;

final class PlayersClashedInQuadrant extends Event
{
	private $player1Name;
	private $player2Name;
	private $quadrant;

	public function __construct(string $player1Name, string $player2Name, int $quadrant)
	{
		$this->player1Name = $player1Name;
		$this->player2Name = $player2Name;
		$this->quadrant = $quadrant;
	}

	public function name(): string
	{
		return 'PlayersClashedInQuadrant';
	}

	public function payload(): array
	{
		return [
			'player1Name' => $this->player1Name,
			'player1Name' => $this->player2Name,
			'quadrant' => $this->quadrant
		];
	}
}
