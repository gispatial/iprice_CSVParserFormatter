<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\iprice_CSVParserFormatter\Test\Parsers;

use PHPUnit\Framework\TestCase;
use gispatial\CSVParse2Hw\StreamParser;
use gispatial\CSVParse2Hw\Parsers\CSVParser;
use Tightenco\Collect\Support\Collection;

class CSVParserTest extends TestCase
{
	private $stub = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Stubs".DIRECTORY_SEPARATOR."sample.csv";

	public function test_detects_main_elements_automatically()
	{
		$count = 0;

		StreamParser::csv($this->stub)->each(function() use (&$count){
			$count++;
		});

		$this->assertEquals(6, $count);
	}

	public function test_transforms_elements_to_collections()
	{
		StreamParser::csv($this->stub)->each(function($book){
			$this->assertInstanceOf(Collection::class, $book);
		});
	}

	public function test_element_values_are_there_after_transform()
	{
		$titles = [
			"The Iliad and The Odyssey",
			"Anthology of World Literature",
			"Computer Dictionary",
			"Cooking on a Budget",
			"Great Works of Art",
			"0"
		];

		$prices = [
			'12.95',
			'24.95',
			'24.90',
			'0',
			'29.95',
		];

		StreamParser::csv($this->stub)->each(function($book) use ($titles, $prices){
			$this->assertContains($book->get('title'), $titles);
			$this->assertContains($book->get('price'), $prices);
		});
	}

	public function test_also_transforms_element_childs_to_collections_recursively()
	{
		StreamParser::csv($this->stub)->each(function($book){
			if($book->has('output')){
				$this->assertInstanceOf(Collection::class, $book->get('output'));
			}
		});
	}

	public function test_allow_empty_string()
	{
		CSVParser::$skipsEmptyLines = false;

		$count = 0;
		StreamParser::csv($this->stub)->each(function() use (&$count){
			$count++;
		});

		$this->assertEquals(8, $count);
	}
}
