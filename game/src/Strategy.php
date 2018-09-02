<?php

namespace lokothodida\Tournament;

class Strategy
{
	public $quadrant;
	public $action;

	public function __construct(Quadrant $quadrant, Action $action)
	{
		$this->quadrant = $quadrant;
		$this->action = $action;
	}
}
