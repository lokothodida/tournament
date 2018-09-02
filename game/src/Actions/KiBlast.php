<?php

namespace lokothodida\Tournament\Actions;

use lokothodida\Tournament\Action;
use lokothodida\Tournament\Player;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\EventStream;
use lokothodida\Tournament\Event\PlayerPoweredUp;
use DomainException;

class KiBlast implements Action
{
	private $targetQuadrant;

	public function __construct(Player $player, Quadrant $targetQuadrant)
	{
		if ($player->ki() < 30) {
			throw new DomainException('Not enough ki to throw a blast');
		}

		$this->targetQuadrant = $targetQuadrant;
	}

	public function perform(Player $player, Player $opponent, EventStream $events): void
	{
		$player->lowerKi(30);

		if ($opponent->isInQuadrant($this->targetQuadrant)) {
			$opponent->receiveDamage(20);
			$opponent->lowerKi(10);
		}
	}
}
