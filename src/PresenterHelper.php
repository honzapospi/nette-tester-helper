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
use Nette\Application\IResponse;
use Nette\DI\Container;
use Tester\Assert;
use Nette\StaticClass;

/**
 * PresenterHelper
 * @author Jan Pospisil
 */

class PresenterHelper {
	use StaticClass;

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
	public function createPresenter(string $name): Presenter {
		$presenter = $this->container->getByType('Nette\Application\IPresenterFactory')->createPresenter($name);
		$presenter->autoCanonicalize = FALSE;
		return $presenter;
	}

	public function processRequest(Request $request): IResponse {
		return $this->createPresenter($request->getPresenterName())->run($request);
	}

	public function textResponse($response): string {
		Assert::type('Nette\Application\Responses\TextResponse', $response);
		$s = (string) $response->getSource();
		Assert::true(gettype($s) == 'string');
		return $s;
	}

	public function jsonResponse($response): void{
		Assert::type('Nette\Application\Responses\JsonResponse', $response);
		Assert::true(is_array($response->getPayload()));
	}

	public function redirectResponse($response, $code = 302, $urlEnding = NULL): void {
		Assert::type('Nette\Application\Responses\RedirectResponse', $response);
		Assert::true($response->getCode() == $code);
		if($urlEnding){
			$parts = explode('?', $response->getUrl());
			Assert::true(substr($parts[0], -strlen($urlEnding)) == $urlEnding);
		}
	}
}


