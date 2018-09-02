<?php

namespace lokothodida\Tournament;

use lokothodida\Tournament\EventStream;

interface Action
{
	public function perform(Player $player, Player $opponent, EventStream $events): void;
}
