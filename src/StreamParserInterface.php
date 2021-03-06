<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\iprice_CSVParserFormatter;


interface StreamParserInterface
{
	public function from(String $source): StreamParserInterface;
	public function each(callable $function);
}
