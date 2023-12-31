<?php

namespace App;

use Exception;

class StringCalculator
{
	const MAX_NUMBER_ALLOWED = 1000;

	protected string $delimiter = ",|\n";

	public function add(string $numbers)
	{
		if(!$numbers) {
			return 0;
		}

		$numbers = $this->parseString($numbers);

		$this->isNegativeNumber($numbers);

		return array_sum($this->ignoreGreaterThan1000($numbers));
	}

	protected function parseString(string $numbers): array
	{
		$customDelimiter = "\/\/(.)\n";

		if(preg_match("/{$customDelimiter}/", $numbers, $matches)) {
			$this->delimiter = $matches[1];

			$numbers = str_replace($matches[0], '', $numbers);
		}
		
		return preg_split("/{$this->delimiter}/", $numbers);
	}

	protected function isNegativeNumber(array $numbers): void
	{
		foreach ($numbers as $number) {
			if($number < 0) {
				throw new Exception('Negative numbers not allowed.');
			}
		}
	}

	protected function ignoreGreaterThan1000(array $numbers): array
	{
		return array_filter($numbers, fn($number) => $number <= self::MAX_NUMBER_ALLOWED);
	}
}
