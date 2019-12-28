<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\iprice_CSVParserFormatter\Parsers;


use gispatial\CSVParse2Hw\Services\JsonCollectionParser as Parser;
use gispatial\CSVParse2Hw\StreamParserInterface;
use Tightenco\Collect\Support\Collection;

class JSONParser implements StreamParserInterface
{
	protected $reader, $source;

	public function from(String $source): StreamParserInterface
	{
		$this->source = $source;

		return $this;
	}

	public function each(callable $function)
	{
		$this->start();
		$this->reader->parse($this->source, function(array $item) use ($function){
			$function((new Collection($item))->recursive());
		});
	}

	private function start()
	{
		$this->reader = new Parser();

		return $this;
	}
}
