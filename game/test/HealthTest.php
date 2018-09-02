<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Tournament\Health;

class HealthTest extends TestCase
{
	public function testHealthStartsAt100()
	{
		$this->assertEquals(100, Health::fullBar()->amount());
	}

	public function testHealthCanBeDecreased()
	{
		$this->assertEquals(90, Health::fullBar()->decreaseBy(10)->amount());
	}

	public function testHealthCanBeIncreased()
	{
		$this->assertEquals(70, Health::fullBar()->decreaseBy(40)->increaseBy(10)->amount());
	}

	public function testHealthDoesNotDecreaseBelow0()
	{
		$this->assertEquals(0, Health::fullBar()->decreaseBy(110)->amount());
	}

	public function testHealthDoesNotIncreaseAbove100()
	{
		$this->assertEquals(100, Health::fullBar()->increaseBy(30)->amount());
	}
}
