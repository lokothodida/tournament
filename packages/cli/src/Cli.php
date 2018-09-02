<?php

namespace lokothodida\Tournament\Cli;

use lokothodida\Tournament\Game;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\Strategy;
use lokothodida\Tournament\Actions\MeleeBattle;
use lokothodida\Tournament\Actions\PowerUp;
use lokothodida\Tournament\Ai\Ai;

class Cli
{
	private $game;
	private $ai;
	private $io;

	public function __construct(Game $game, Ai $ai, IoChannel $io)
	{
		$this->game = $game;
		$this->ai = $ai;
		$this->io = $io;
	}

	public function run(): void
	{
		$this->io->writeLine('Welcome to (DBZ) Tournament CLI!');
		$this->nextMove();
	}

	private function nextMove(): void
	{
		while (!$this->game->isOver()) {
			$quadrant = new Quadrant((int)$this->io->prompt('Select quadrant > '));
			$action = $this->io->prompt('Select action (powerup, melee) > ');

			switch ($action) {
				case 'powerup':
					$action = new PowerUp();
					break;
				case 'melee':
					$action = new MeleeBattle(new Quadrant((int)$this->io->prompt('Select quadrant for melee > ')));
					break;
				case 'exit':
					$this->io->writeLine('Quitting game');
					return;
				default:
					$this->io->writeLine('Command not recognised - try again');
					$this->nextMove();
					return;
			}

			$this->io->writeLine('');

			$this->game->play(new Strategy($quadrant, $action), $this->ai->nextStrategy());
		}

		$this->io->writeLine('Game over!');
	}
}
