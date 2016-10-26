<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Tester\Forms;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\NotImplementedException;
use Tracy\Debugger;

/**
 * FormPresenter
 * @author Jan Pospisil
 */

class FormPresenter extends Presenter {

	private $form;
	private $values;


	/**
	 * @param Form $form
	 * @param array $values
	 */
	public function setup(Form $form, array $values){
		parent::__construct();
		$this->form = $form;
		$this->values = $values;
		return $this;
	}

	/**
	 * @return FormRequest
	 */
	public function getRequest(){
		return new FormRequest($this->form, $this->values);
	}

	/**
	 * @param $component
	 * @param null $signal
	 * @return bool
	 */
	public function isSignalReceiver($component, $signal = NULL) {
		if(!$component instanceof Form)
			throw new NotImplementedException();
		if($signal != 'submit')
			throw new NotImplementedException();
		return true;
	}

}
