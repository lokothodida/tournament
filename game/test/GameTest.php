<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Tournament\Game;
use lokothodida\Tournament\Player;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\Strategy;
use lokothodida\Tournament\EventStream;
use lokothodida\Tournament\Event\Event;
use lokothodida\Tournament\Action;

class GameTest extends TestCase
{
	private $eventStream;

	public function setUp()
	{
		$this->eventStream = new class() implements EventStream {
			public function append(Event $event): void
			{
			}
		};
	}

	/**
	 * @expectedException DomainException
	 */
	public function testPlayersCannotStartTheGameInTheSameQuadrant()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(1));
		$game = new Game($player1, $player2, $this->eventStream);
	}

	public function testWhenPlayersSelectTheSameQuadrantTheyClashAndBothLose10HealthPoints()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$game = new Game($player1, $player2, $this->eventStream);

		$noAction = new class() implements Action {
			public function perform(Player $player, Player $opponent, EventStream $events): void
			{
			}
		};

		$game->play(
			new Strategy(new Quadrant(1), $noAction),
			new Strategy(new Quadrant(1), $noAction)
		);

		$this->assertEquals(90, $player1->health());
		$this->assertEquals(90, $player2->health());
	}

	public function testWhenPlayersSelectDifferentQuadrantsBothOfTheirActionsPlayOut()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$game = new Game($player1, $player2, $this->eventStream);

		$fullPowerUp = new class() implements Action {
			public function perform(Player $player, Player $opponent, EventStream $events): void
			{
				$player->raiseKi(100);
			}
		};

		$game->play(
			new Strategy(new Quadrant(2), $fullPowerUp),
			new Strategy(new Quadrant(4), $fullPowerUp)
		);

		$this->assertEquals(100, $player1->ki());
		$this->assertEquals(100, $player2->ki());
	}

	public function testGameIsOverWhenAPlayerIsDefeated()
	{
		$player1 = Player::enterArena('p1', new Quadrant(1));
		$player2 = Player::enterArena('p2', new Quadrant(2));
		$game = new Game($player1, $player2, $this->eventStream);

		$noAction = new class() implements Action {
			public function perform(Player $player, Player $opponent, EventStream $events): void
			{
			}
		};

		$eradicate = new class() implements Action {
			public function perform(Player $player, Player $opponent, EventStream $events): void
			{
				$player->receiveDamage(100);
			}
		};

		$this->assertFalse($game->isOver());

		$game->play(
			new Strategy(new Quadrant(3), $noAction),
			new Strategy(new Quadrant(4), $eradicate)
		);

		$this->assertTrue($game->isOver());
	}
}
