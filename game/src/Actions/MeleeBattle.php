<?php

namespace lokothodida\Tournament\Actions;

use lokothodida\Tournament\Player;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\Action;
use lokothodida\Tournament\EventStream;
use lokothodida\Tournament\Event\PlayerMeleeAttacked;
use lokothodida\Tournament\Event\PlayerMeleeAttackMissed;

class MeleeBattle implements Action
{
	private $quadrant;

	public function __construct(Quadrant $quadrant)
	{
		$this->quadrant = $quadrant;
	}

	public function perform(Player $player, Player $opponent, EventStream $events): void
	{
		if ($opponent->isInQuadrant($this->quadrant)) {
			$opponent->receiveDamage(20);
			$opponent->lowerKi(30);
			$events->append(new PlayerMeleeAttacked($player->name(), $opponent->name(), $this->quadrant->number(), 20, 10));
		} else {
			$events->append(new PlayerMeleeAttackMissed($player->name(), $this->quadrant->number()));
		}
	}
}
