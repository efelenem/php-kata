<?php

namespace App;

class GetSearchType
{
	public function search1($searchValue)
	{
		$type = implode(array_map(function($value) use ($searchValue) {
			$series = substr(strtoupper(str_replace('-', '', $searchValue)), 0, 4);
			$lev = levenshtein($series, $value);

			return $lev == 1 || $lev == 0 ? $value : '';
		}, [
			'PPY', 'PPG', 'BOQ', '3753'
		]));

		switch ($type) {
			case 'BOQ':
				return 'cert_no';

			case 'PPG':
				return 'ref_no';

			case 'PPY':
				return 'batch_code';

			case '3753':
				return 'tracking_no';

			default:
				return 'customer_name';
		}
	}

	public function search2($searchValue)
	{
		if(preg_match("/^(PPGB){1}/", $searchValue) == 1) {
			return 'reference_no';
		}

		if(preg_match("/^(BOQ){1}/", $searchValue) == 1) {
			return 'certification_number';
		}
		
		if(preg_match("/^(3753){1}/", $searchValue) == "3753") {
			return 'delivery_tracking_no';
		}

		if(preg_match("/(PASSPORTSTOCK){1}/", $searchValue) == 1) {
			return 'attachment';
		}

		if(preg_match("/(\d+-+)/", $searchValue) == 1) {
			return 'created_at';
		}

		if(preg_match("/^\d+$/", $searchValue) == 1) {
			return 'stocks';
		}

		return 'name_or_remarks';
	}
}
