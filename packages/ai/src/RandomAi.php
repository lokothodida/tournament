<?php

namespace lokothodida\Tournament\Ai;

use lokothodida\Tournament\Strategy;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\Actions\PowerUp;
use lokothodida\Tournament\Actions\MeleeBattle;
use lokothodida\Tournament\Action;

class RandomAi implements Ai
{
	public function nextStrategy(): Strategy
	{
		return new Strategy(Quadrant::random(), $this->randomizeAction());
	}

	private function randomizeAction(): Action
	{
		switch (rand(1, 2)) {
			case 1:
				return new PowerUp();
			case 2:
				return new MeleeBattle(Quadrant::random());
		}
	}
}
