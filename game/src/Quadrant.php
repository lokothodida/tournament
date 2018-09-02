<?php

namespace lokothodida\Tournament;

use DomainException;

class Quadrant
{
	private $number;

	public function __construct(int $number)
	{
		if ($number < 1 || $number > 4) {
			throw new DomainException('Only 1, 2, 3 and 4 are valid quadrants');
		}

		$this->number = $number;
	}

	public function number(): int
	{
		return $this->number;
	}

	public static function random(): Quadrant
	{
		return new Quadrant(rand(1, 4));
	}

	public static function randomPair(): array
	{
		$first  = rand(1, 4);
		$second = rand(1,4);

		while ($first === $second) {
			$second = rand(1,4);
		}

		return [new Quadrant($first), new Quadrant($second)];
	}
}
