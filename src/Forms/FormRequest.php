<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Tester\Forms;
use Nette\Application\Request;
use Nette\Application\UI\Form;
use Nette\Forms\Container;
use Nette\Forms\Controls\Button;
use Nette\NotImplementedException;

/**
 * FormRequest
 * @author Jan Pospisil
 */

class FormRequest extends Request {

	private $form;
	private $values;

	/**
	 * FormRequest constructor.
	 * @param Form $form
	 * @param array $values
	 */
	public function __construct(Form $form, array $values){
		parent::__construct('test_request', $form->getMethod());
		$this->form = $form;
		$this->values = $values;
	}

	/**
	 * @param $method
	 * @return bool
	 */
	public function isMethod($method){
		return $method == $this->form->getMethod() ? TRUE : FALSE;
	}

	/**
	 * @param null $key
	 * @return array
	 */
	public function getPost($key = NULL) { // UI/From: 117
		if($key)
			throw new NotImplementedException();
		$return = $this->values;
		$return = self::getValuesFromContainer($this->form, $return);
		$return['_do'] = 'xxxx'; // ??
		return $return;
	}

	//************************************************* HELPERS ******************************************************//

	/**
	 * @param Container $container
	 * @param array $values
	 * @return array
	 */
	private static function getValuesFromContainer(Container $container, array $values){
		foreach($container->getComponents() as $name => $control){
			if($control instanceof Container){
				$values[$name] = self::getValuesFromContainer($control, isset($values[$name]) ? $values[$name] : array());
			} else {
				if(!isset($values[$name]))
					$values[$name] = self::getValue($control);
			}
		}
		return $values;
	}

	/**
	 * @param $control
	 * @return null|string
	 */
	private static function getValue($control){
		if($control instanceof Button){
			return $control->caption;
		} else
			return $control->getValue();
	}

}
