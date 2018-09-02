<?php

namespace lokothodida\Tournament\Ai;

use lokothodida\Tournament\Strategy;

interface Ai
{
	public function nextStrategy(): Strategy;
}
