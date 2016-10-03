<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace JP\Tester;
use Nette\Application\Request;
use Nette\Application\Responses\JsonResponse;
use Nette\Application\Responses\RedirectResponse;
use Nette\Application\Responses\TextResponse;
use Nette\Application\UI\Presenter;
use Nette\DI\Container;
use Tester\Assert;

/**
 * PresenterHelper
 * @author Jan Pospisil
 */

class PresenterHelper extends \Nette\Object {

	protected $container;
	public $requestBuilder;

	public function __construct(Container $container){
		$this->container = $container;
		$this->requestBuilder = new RequestBuilder();
	}

	/**
	 * @param $name
	 * @return Presenter
	 */
	public function createPresenter($name){
		$presenter = $this->container->getByType('Nette\Application\IPresenterFactory')->createPresenter($name);
		$presenter->autoCanonicalize = FALSE;
		return $presenter;
	}

	public function processRequest(Request $request){
		return $this->createPresenter($request->getPresenterName())->run($request);
	}

	public function textResponse(TextResponse $textResponse){
		$s = (string) $textResponse->getSource();
		Assert::true(gettype($s) == 'string');
		return $s;
	}

	public function jsonResponse(JsonResponse $response){
		Assert::true(is_array($response->getPayload()));
	}

	public function redirectResponse(RedirectResponse $response, $code = 302, $urlEnding = NULL){
		Assert::true($response->getCode() == $code);
		if($urlEnding){
			$parts = explode('?', $response->getUrl());
			Assert::true(substr($parts[0], -strlen($urlEnding)) == $urlEnding);
		}
	}
}


