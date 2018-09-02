<?php

namespace lokothodida\Tournament;

final class Ki
{
	private $amount;

	public static function emptyBar(): Ki
	{
		return new Ki(0);
	}

	public function __construct(int $amount)
	{
		$this->amount = $amount;
	}

	public function raiseBy(int $amount): Ki
	{
		return new Ki(min(100, $this->amount + $amount));
	}

	public function lowerBy(int $amount): Ki
	{
		return new Ki(max(0, $this->amount - $amount));
	}

	public function amount(): int
	{
		return $this->amount;
	}
}
