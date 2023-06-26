<?php

use App\GetSearchType;
use PHPUnit\Framework\TestCase;

class GetSearchTypeTest extends TestCase
{
	/** @test */
	function it_gets_search_type_value()
	{
		$searchType = (new GetSearchType)->search1('PPGBOQ1SL2AFFDX');

		$this->assertEquals('ref_no', $searchType);
	}
}
