<?php

namespace App;

class TennisMatch
{
	protected Player $playerOne;
	protected Player $playerTwo;

	public function __construct(Player $playerOne, Player $playerTwo)
	{
		$this->playerOne = $playerOne;
		$this->playerTwo = $playerTwo;
	}
	
	public function score()
	{
		if($this->hasWinner()) {
			return "Winner: " . $this->leader()->name;
		}

		if($this->hasAdvantage()) {
			return "Advantage: " . $this->leader()->name;
		}

		if($this->isDuece()) {
			return 'duece';
		}

		return sprintf(
			"%s-%s",
			$this->playerOne->toScore(),
			$this->playerTwo->toScore()
		);
	}

	protected function leader(): Player
	{
		return $this->playerOne->points > $this->playerTwo->points ? $this->playerOne : $this->playerTwo;
	}

	protected function isDuece(): bool
	{
		if(!$this->gamePoint()) {
			return false;
		}

		return $this->playerOne->points === $this->playerTwo->points;
	}

	protected function gamePoint(): bool
	{
		return $this->playerOne->points >= 3 && $this->playerTwo->points >= 3;
	}

	protected function hasAdvantage(): bool
	{
		if(!$this->gamePoint()) {
			return false;
		}

		return !$this->isDuece();
	}

	protected function hasWinner(): bool
	{
		if($this->playerOne->points < 4 && $this->playerTwo->points < 4) {
			return false;
		}

		return abs($this->playerOne->points - $this->playerTwo->points) >= 2;
	}
}
