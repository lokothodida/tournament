<?php

namespace lokothodida\Tournament;

use lokothodida\Tournament\Event\PlayersClashedInQuadrant;
use lokothodida\Tournament\Event\PlayerMovedToQuadrant;
use lokothodida\Tournament\Event\GameBegan;
use DomainException;

class Game
{
	private $player1;
	private $player2;
	private $events;

	public function __construct(Player $player1, Player $player2, EventStream $events)
	{
		for ($quadrantNumber = 1; $quadrantNumber < 5; $quadrantNumber++) {
			$quadrant = new Quadrant($quadrantNumber);
			if ($player1->isInQuadrant($quadrant) && $player2->isInQuadrant($quadrant)) {
				throw new DomainException('Players cannot start the game in the same quadrant');
			}
		}

		$this->player1 = $player1;
		$this->player2 = $player2;
		$this->events = $events;
		$this->events->append(new GameBegan(
			$this->player1->name(),
			$this->player1->health(),
			$this->player1->ki(),
			$this->player2->name(),
			$this->player2->health(),
			$this->player2->ki()
		));
	}

	public function play(Strategy $player1Strategy, Strategy $player2Strategy): void
	{
		if ($this->isOver()) {
			throw new DomainException('Game is already over');
		}

		if ($player1Strategy->quadrant == $player2Strategy->quadrant) {
			$this->processPlayerQuadrantClash();
		} else {
			$this->processPlayerStrategies($player1Strategy, $player2Strategy);
		}
	}

	private function processPlayerQuadrantClash(): void
	{
		$this->player1->receiveDamage(10);
		$this->player2->receiveDamage(10);
		list($player1Quadrant, $player2Quadrant) = Quadrant::randomPair();
		$this->player1->goToQuadrant($player1Quadrant);
		$this->player2->goToQuadrant($player2Quadrant);

		$this->events->append(new PlayersClashedInQuadrant($this->player1->name(), 10, $this->player2->name(), 10));
		$this->events->append(new PlayerMovedToQuadrant($this->player1->name(), $player1Quadrant->number()));
		$this->events->append(new PlayerMovedToQuadrant($this->player2->name(), $player2Quadrant->number()));
	}

	private function processPlayerStrategies(Strategy $player1Strategy, Strategy $player2Strategy): void
	{
		$this->player1->goToQuadrant($player1Strategy->quadrant);
		$this->player2->goToQuadrant($player2Strategy->quadrant);

		$this->events->append(new PlayerMovedToQuadrant($this->player1->name(), $player1Strategy->quadrant->number()));
		$this->events->append(new PlayerMovedToQuadrant($this->player2->name(), $player2Strategy->quadrant->number()));
		$player1Strategy->action->perform($this->player1, $this->player2, $this->events);
		$player2Strategy->action->perform($this->player2, $this->player1, $this->events);
	}

	public function isOver(): bool
	{
		return $this->player1->isDefeated() || $this->player2->isDefeated();
	}
}
