<?php

namespace lokothodida\Tournament;

final class Health
{
	private $amount;

	public static function fullBar(): Health
	{
		return new Health(100);
	}

	public function __construct(int $amount)
	{
		$this->amount = $amount;
	}

	public function increaseBy(int $amount): Health
	{
		return new Health(min(100, $this->amount + $amount));
	}

	public function decreaseBy(int $amount): Health
	{
		return new Health(max(0, $this->amount - $amount));
	}

	public function amount(): int
	{
		return $this->amount;
	}
}
