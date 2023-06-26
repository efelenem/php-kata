<?php

use App\RomanNumerals;
use PHPUnit\Framework\TestCase;

class RomanNumeralsTest extends TestCase
{
	/** 
	 * @test
	 * @dataProvider numbers
	 */
	function it_generates_roman_numerals_for($number, $numeral)
	{
		$this->assertEquals($numeral, RomanNumerals::generate($number));
	}

	/** @test */
	function it_generates_roman_numerals_less_than_1()
	{
		$this->assertFalse(RomanNumerals::generate(0));
	}

	/** @test */
	function it_generates_roman_numerals_more_than_4000()
	{
		$this->assertFalse(RomanNumerals::generate(4000));
	}

	public function numbers()
	{
		return [
			[1, 'I'],
			[2, 'II'],
			[3, 'III'],
			[4, 'IV'],
			[5, 'V'],
			[6, 'VI'],
			[7, 'VII'],
			[8, 'VIII'],
			[9, 'IX'],
			[10, 'X'],
			[40, 'XL'],
			[50, 'L'],
			[90, 'XC'],
			[100, 'C'],
			[400, 'CD'],
			[500, 'D'],
			[900, 'CM'],
			[1000, 'M'],
			[3999, 'MMMCMXCIX'],
		];
	}
}
