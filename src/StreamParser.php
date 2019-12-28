<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\JustedCSVParser;


use gispatial\CSVParse2Hw\Parsers\CSVParser;
use gispatial\CSVParse2Hw\Parsers\JSONParser;
use gispatial\CSVParse2Hw\Parsers\XMLParser;
use gispatial\CSVParse2Hw\Traits\Facade;
use Tightenco\Collect\Support\Collection;

class StreamParser
{
	use Facade;

	private function __construct()
	{
		Collection::macro('recursive', function () {
			return $this->map(function ($value) {
				if (is_array($value) || is_object($value)) {
					return (new Collection($value))->recursive();
				}
				return $value;
			});
		});
	}

	private function xml(String $source){
		return (new XMLParser())->from($source);
	}

	private function json(String $source){
		return (new JSONParser())->from($source);
	}

	private function csv(String $source){
		return (new CSVParser())->from($source);
	}
}
