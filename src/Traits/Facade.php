<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\iprice_CSVParserFormatter\Traits;


trait Facade
{
	public static function __callStatic($name, $arguments)
	{
		return (new static())->{$name}(...$arguments);
	}
}
