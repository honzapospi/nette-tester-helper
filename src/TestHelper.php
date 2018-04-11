<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Tester;

/**
 * TestHelper
 * @author Jan Pospisil
 */

class TestHelper extends \Nette\Object {

	public static function setPrivate($object, $name, $value){
		$reflectionClass = new \ReflectionClass($object);
		$property = $reflectionClass->getProperty($name);
		$property->setAccessible(true);
		$property->setValue($object, $value);
	}

}