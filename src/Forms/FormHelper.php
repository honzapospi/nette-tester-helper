<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Tester\Forms;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

/**
 * FormHelper
 * @author Jan Pospisil
 */

class FormHelper extends \Nette\Object {

	/**
	 * @param Form $form
	 * @param array $values
	 * @return ArrayHash
	 * @throws \Nette\Application\UI\BadSignalException
	 * TODO:
	 * - submit by different button (Forms/Form:422 fireEvents())
	 *
	 */
	public function sendForm(Form $form, array $values){
		$presenter = new FormPresenter($form, $values);
		$form->setParent($presenter);
		$form->signalReceived('submit');
		return $form;
	}

}
