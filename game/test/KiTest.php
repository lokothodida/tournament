<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Tournament\Ki;

class KiTest extends TestCase
{
	public function testKiStartsAt0()
	{
		$this->assertEquals(0, Ki::emptyBar()->amount());
	}

	public function testKiCanBeIncreased()
	{
		$this->assertEquals(20, Ki::emptyBar()->raiseBy(20)->amount());
	}

	public function testKiCanBeDecreased()
	{
		$this->assertEquals(30, Ki::emptyBar()->raiseBy(40)->lowerBy(10)->amount());
	}

	public function testKiDoesNotDecreaseBelow0()
	{
		$this->assertEquals(0, Ki::emptyBar()->lowerBy(10)->amount());
	}

	public function testKiDoesNotIncreaseAbove100()
	{
		$this->assertEquals(100, Ki::emptyBar()->raiseBy(110)->amount());
	}
}
