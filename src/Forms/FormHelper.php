<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Tester\Forms;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;
use Nette\StaticClass;

/**
 * FormHelper
 * @author Jan Pospisil
 */

class FormHelper {
	use StaticClass;

	/**
	 * @param Form $form
	 * @param array $values
	 * @return ArrayHash
	 * @throws \Nette\Application\UI\BadSignalException
	 * TODO:
	 * - submit by different button (Forms/Form:422 fireEvents())
	 *
	 */
	public static function sendForm(Form $form, array $values){
		$presenter = (new FormPresenter())->setup($form, $values);
		$form->setParent($presenter);
		$form->signalReceived('submit');
		return $form;
	}

}
