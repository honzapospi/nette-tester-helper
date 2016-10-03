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

	public static function setPrivate(\Nette\Object $object, $name, $value){
		$property = $object->getReflection()->getProperty($name);
		$property->setAccessible(TRUE);
		$property->setValue($object, $value);
	}

}