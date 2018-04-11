<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Tester;
use Nette\StaticClass;

/**
 * TestHelper
 * @author Jan Pospisil
 */

class TestHelper {
	use StaticClass;

	public static function setPrivate($object, $name, $value){
		$reflectionClass = new \ReflectionClass($object);
		$property = $reflectionClass->getProperty($name);
		$property->setAccessible(true);
		$property->setValue($object, $value);
	}

}