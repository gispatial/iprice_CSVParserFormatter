<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\CSVParse2Hw\Test\Parsers;

use gispatial\CSVParse2Justed\StreamParser;
use gispatial\CSVParse2Justed\Test\Contracts\ElementAttributesManagement;
use gispatial\CSVParse2Justed\Test\Contracts\ElementListManagement;
use gispatial\CSVParse2Justed\Test\Contracts\ElementDepthManagement;
use gispatial\CSVParse2Justed\Test\TestCase;
use Tightenco\Collect\Support\Collection;

class XMLParserTest extends TestCase implements ElementAttributesManagement, ElementListManagement, ElementDepthManagement {

	private $stub = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Stubs".DIRECTORY_SEPARATOR."sample.xml";

	public function test_detects_main_elements_automatically()
	{
		$count = 0;

		StreamParser::xml($this->stub)->each(function() use (&$count){
			$count++;
		});

		$this->assertEquals(6, $count);
	}

	public function test_transforms_elements_to_collections()
	{
		StreamParser::xml($this->stub)->each(function($hello_world){
			$this->assertInstanceOf(Collection::class, $hello_world);
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
			"The Greatest Element"
		];

		StreamParser::xml($this->stub)->each(function($hello_world) use ($titles){
			$this->assertContains($hello_world->get('title'), $titles);
		});
	}

	public function test_also_transforms_element_childs_to_collections_recursively()
	{
		StreamParser::xml($this->stub)->each(function($hello_world){
			if($hello_world->has('comments')){
				$this->assertInstanceOf(Collection::class, $hello_world->get('comments'));
			}
		});
	}

	public function test_element_attributes_are_in_the_values()
	{
		$ISBNList = [
			"10-000000-001",
			"11-000000-002",
			"11-000000-003",
			"11-000000-004",
			"10-000000-999",
			"11-000000-005"
		];

		StreamParser::xml($this->stub)->each(function($hello_world) use ($ISBNList){
			$this->assertContains($hello_world->get('ISBN'), $ISBNList);
		});
	}

	public function test_elements_lists_are_managed()
	{
		$totalComments = 6;
		$countedComments = 0;

		StreamParser::xml($this->stub)->each(function($hello_world) use (&$countedComments){
			if($hello_world->has('comments')){
				$countedComments += $hello_world->get('comments')->count();
			}
		});

		$this->assertEquals($totalComments, $countedComments);
	}

    public function test_element_is_empty()
    {
	    StreamParser::xml($this->stub)->each(function($hello_world) {
		    if($hello_world->has('reviews')) {
			    $this->assertEmpty($hello_world->get('reviews'));
		    }
	    });
	}

	public function test_it_parses_child_with_same_parent_name(){
		StreamParser::xml($this->stub)->each(function($hello_world){
			if($hello_world->has('book')){
				$this->assertEquals($hello_world->get('book'), "The nested element named like the parent");
			}
		});
	}
}
