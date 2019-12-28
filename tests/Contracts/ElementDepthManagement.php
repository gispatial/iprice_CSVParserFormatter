<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\iprice_CSVParserFormatter\Test\Contracts;


interface ElementDepthManagement
{
	/**
	 *  It manages to parse child elements with same parent name
     *
     *  <booklist>
     *      <book>
     *          <title>Hello world</title>
     *          <book>456788</book>  <----- THIS IS ALSO PARSED
     *      </book>
     * </booklist>
     *
	 */

	public function test_it_parses_child_with_same_parent_name();
}
