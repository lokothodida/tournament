<?php

use lokothodida\Tournament\Cli\Cli;
use lokothodida\Tournament\Cli\IoChannel;
use lokothodida\Tournament\Game;
use lokothodida\Tournament\Player;
use lokothodida\Tournament\Quadrant;
use lokothodida\Tournament\EventStream;
use lokothodida\Tournament\Ai\RandomAi;
use lokothodida\Tournament\Event\Event;

require __DIR__ . '/vendor/autoload.php';

$game = new Game(
	Player::enterArena('Goku', new Quadrant(1)),
	Player::enterArena('Vegeta', new Quadrant(2)),
	new class() implements EventStream {
		public function append(Event $event): void
		{
			var_dump($event->name(), $event->payload());
		}
	}
);

$io = new class() implements IoChannel {
	public function prompt(string $withMessage): string
	{
		return readline($withMessage);
	}

	public function write(string $message): void
	{
		echo $message;
	}

	public function writeLine(string $message): void
	{
		$this->write($message . "\n");
	}
};

(new Cli($game, new RandomAi(), $io))->run();
