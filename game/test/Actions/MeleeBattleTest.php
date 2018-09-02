<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Tournament\Player;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\ArrayEventStream;
use lokothodida\Tournament\Actions\MeleeBattle;
use lokothodida\Tournament\Event\PlayerMeleeAttackMissed;
use lokothodida\Tournament\Event\PlayerMeleeAttacked;

class MeleeBattleTest extends TestCase
{
	private $events;

	public function setUp()
	{
		$this->events = new ArrayEventStream();
	}

	public function testWhenTheOpponentIsNotInTheTargetQuadrantAttacksCompletelyMiss()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$meleeBattle = new MeleeBattle(new Quadrant(3));
		$meleeBattle->perform($player1, $player2, $this->events);
		$events = $this->events->toArray();

		$this->assertEquals(100, $player2->health());
		$this->assertEquals(0, $player2->ki());
		$this->assertTrue(in_array(new PlayerMeleeAttackMissed('p1', 3), $events));
	}

	public function testAMeleeBattleInTheTargetQuadrantReducesTheOpponentsHealthAndKi()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$player2->raiseKi(100);
		$meleeBattle = new MeleeBattle(new Quadrant(2));
		$meleeBattle->perform($player1, $player2, $this->events);
		$events = $this->events->toArray();

		$this->assertEquals(80, $player2->health());
		$this->assertEquals(70, $player2->ki());
		$this->assertTrue(in_array(new PlayerMeleeAttacked('p1', 'p2', 2, 20, 10), $events));
	}
}
