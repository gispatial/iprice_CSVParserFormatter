<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\JustedCSVParser;


interface StreamParserInterface
{
	public function from(String $source): StreamParserInterface;
	public function each(callable $function);
}
