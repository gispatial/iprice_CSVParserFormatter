<?php
/**
 * Created by Atom.
 * User: Crocslut/Justed
 * Date: 28/12/19
 * Time: 20:45
 */

namespace gispatial\iprice_CSVParserFormatter\Test;

use PHPUnit\Framework\TestCase as BaseTest;
use gispatial\CSVParse2Justed\Test\Contracts\ElementToCollectionTransformation;
use gispatial\CSVParse2Justed\Test\Contracts\MainElementsDetection;

abstract class TestCase extends BaseTest
implements
	MainElementsDetection,
	ElementToCollectionTransformation
{}
