<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Tournament\Player;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\ArrayEventStream;
use lokothodida\Tournament\Actions\PowerUp;
use lokothodida\Tournament\Event\PlayerPoweredUp;

class PowerUpTest extends TestCase
{
	private $events;

	public function setUp()
	{
		$this->events = new ArrayEventStream();
	}

	public function testPoweringUpRaisesTheStrategistsKiBy20()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$meleeBattle = new PowerUp();
		$meleeBattle->perform($player1, $player2, $this->events);

		$this->assertEquals(20, $player1->ki());
		$this->assertTrue(in_array(new PlayerPoweredUp('p1', 20), $this->events->toArray()));
	}
}
