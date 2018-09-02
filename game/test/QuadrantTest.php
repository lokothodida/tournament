<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Tournament\Quadrant;

class QuadrantTest extends TestCase
{
	/**
	 * @dataProvider validQuadrants
	 */
	public function testThereAreFourValidQuadrants(int $number)
	{
		$quadrant = new Quadrant($number);
		$this->assertEquals($number, $quadrant->number());
	}

	/**
	 * @expectedException DomainException
	 * @dataProvider invalidQuadrants
	 */
	public function testItErrorsWhenConstructedWithInvalidQuadrants(int $number)
	{
		$quadrant = new Quadrant($number);
	}

	public function validQuadrants(): array
	{
		return [ [1], [2], [3], [4] ];
	}

	public function invalidQuadrants(): array
	{
		return [ [0], [-3], [5], [10] ];
	}
}
