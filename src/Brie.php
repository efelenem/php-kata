<?php

namespace App;

class Brie extends Item
{
	public function tick()
	{
		$this->quality += 1;

		if($this->sellIn <= 0) {
			$this->quality += 1;
		}

		if($this->quality > 50) {
			$this->quality = 50;
		}

		$this->sellIn -= 1;
	}
}
