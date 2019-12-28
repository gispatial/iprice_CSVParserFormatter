<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\CSVParse2Hw\Test\Parsers;

use gispatial\CSVParse2Hw\Test\TestCase;
use gispatial\CSVParse2Hw\StreamParser;
use Tightenco\Collect\Support\Collection;

class JSONParserTest extends TestCase
{
	private $stub = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Stubs".DIRECTORY_SEPARATOR."sample.json";

	public function test_detects_main_elements_automatically()
	{
		$count = 0;

		StreamParser::json($this->stub)->each(function() use (&$count){
			$count++;
		});

		$this->assertEquals(5, $count);
	}

	public function test_transforms_elements_to_collections()
	{
		StreamParser::json($this->stub)->each(function($book){
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
			"Great Works of Art"
		];

		StreamParser::json($this->stub)->each(function($book) use ($titles){
			$this->assertContains($book->get('title'), $titles);
		});
	}

	public function test_also_transforms_element_childs_to_collections_recursively()
	{
		StreamParser::json($this->stub)->each(function($book){
			if($book->has('output')){
				$this->assertInstanceOf(Collection::class, $book->get('output'));
			}
		});
	}
}
