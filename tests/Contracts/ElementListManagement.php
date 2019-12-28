<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\iprice_CSVParserFormatter\Test\Contracts;


interface ElementListManagement
{
	/**
	 *  It manages to parse child lists with same keys (element lists):
	 */

	public function test_elements_lists_are_managed();
}
