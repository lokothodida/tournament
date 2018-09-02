<?php

namespace lokothodida\Tournament\Actions;

use lokothodida\Tournament\Action;
use lokothodida\Tournament\Player;
use lokothodida\Tournament\EventStream;
use lokothodida\Tournament\Event\PlayerPoweredUp;

class PowerUp implements Action
{
	public function perform(Player $player, Player $opponent, EventStream $events): void
	{
		$player->raiseKi(20);
		$events->append(new PlayerPoweredUp($player->name(), 20));
	}
}
