<?php

namespace lokothodida\Tournament;

class Player
{
	private $health;
	private $ki;
	private $name;
	private $quadrant;

	private function __construct(string $name, Quadrant $quadrant, Health $health, Ki $ki)
	{
		$this->name = $name;
		$this->quadrant = $quadrant;
		$this->health = $health;
		$this->ki = $ki;
	}

	public static function enterArena(string $name, Quadrant $atQuadrant): Player
	{
		return new Player(
			$name,
			$atQuadrant,
			Health::fullBar(),
			Ki::emptyBar()
		);
	}

	public function name(): string
	{
		return $this->name;
	}

	public function health(): int
	{
		return $this->health->amount();
	}

	public function ki(): int
	{
		return $this->ki->amount();
	}

	public function receiveDamage(int $amount): void
	{
		$this->health = $this->health->decreaseBy($amount);
	}

	public function raiseKi(int $amount): void
	{
		$this->ki = $this->ki->raiseBy($amount);
	}

	public function lowerKi(int $amount): void
	{
		$this->ki = $this->ki->lowerBy($amount);
	}

	public function goToQuadrant(Quadrant $quadrant): void
	{
		$this->quadrant = $quadrant;
	}

	public function isInQuadrant(Quadrant $quadrant): bool
	{
		return $this->quadrant == $quadrant;
	}

	public function isDefeated(): bool
	{
		return $this->health->amount() === 0;
	}
}
