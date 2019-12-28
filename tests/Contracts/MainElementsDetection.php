<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\iprice_CSVParserFormatter\Test\Contracts;


interface MainElementsDetection
{
	/**
	 *  It gets the main elements automatically:
	 *
	 *  <booklist>
	 *      <book>...</book> <-- main elements
	 *      <book>...</book>
	 *      <book>...</book>
	 *  </booklist>
	 *
	 *  or
	 *
	 *  [
	 *      {title: 'Hello'}, <-- main elements
	 *      {title: 'World'},
	 *  ]
	 *
	 */

	public function test_detects_main_elements_automatically();
}
