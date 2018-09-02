<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Tournament\Player;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\Health;
use lokothodida\Tournament\Ki;

class PlayerTest extends TestCase
{
	public function testPlayersAreDefeatedWhenTheirHealthIsDepleted()
	{
		$player = Player::enterArena('person', new Quadrant(1));
		$player->receiveDamage(100);
		$this->assertTrue($player->isDefeated());
	}

	// public function testPlayersCanRaiseTheirKi()
	// {

	// }
}
