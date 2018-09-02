<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Tournament\Player;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\ArrayEventStream;
use lokothodida\Tournament\Actions\KiBlast;

class KiBlastTest extends TestCase
{
	private $events;

	public function setUp()
	{
		$this->events = new ArrayEventStream();
	}

	/**
	 * @expectedException DomainException
	 */
	public function testKiBlastsRequire30KiToUse()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$meleeBattle = new KiBlast($player1, new Quadrant(3));
	}

	public function testWhenTheOpponentIsNotInTheTargetQuadrantKiBlastsDoNoDamage()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$player1->raiseKi(30);
		$meleeBattle = new KiBlast($player1, new Quadrant(3));
		$meleeBattle->perform($player1, $player2, $this->events);

		$this->assertEquals(100, $player2->health());
		$this->assertEquals(0, $player1->ki());
	}

	public function testWhenTheOpponentIsInTheTargetQuadrantKiBlastsDoDamage()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$player1->raiseKi(30);
		$player2->raiseKi(30);
		$meleeBattle = new KiBlast($player1, new Quadrant(2));
		$meleeBattle->perform($player1, $player2, $this->events);

		$this->assertEquals(80, $player2->health());
		$this->assertEquals(20, $player2->ki());
		$this->assertEquals(0, $player1->ki());
	}
}
