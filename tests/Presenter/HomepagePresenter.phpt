<?php

namespace Test;

use JP\Tester\PresenterHelper;
use JP\Tester\RequestBuilder;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';


class HomepagePresenter extends Tester\TestCase
{
	private $container;
	private $presenterHelper;
	private $requestBuilder;


	function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
		$this->presenterHelper = new PresenterHelper($container);
		$this->requestBuilder = new RequestBuilder();
	}


	function setUp()
	{
	}


	function testHomepage() {
		$request = $this->requestBuilder->createRequest('Homepage');
		$presenter = $this->presenterHelper->createPresenter($request->getPresenterName());
		$response = $presenter->run($request);
		$html = $this->presenterHelper->textResponse($response);
		$dom = \Tester\DomQuery::fromHtml($html);
		Assert::true( $dom->has('#conten"]') );
	}

}


$test = new HomepagePresenter($container);
$test->run();