<?php

require __DIR__ . '/../vendor/autoload.php';
\Tester\Environment::setup();

// setup
$configurator = new \Nette\Configurator();
$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__.'/../app')
	->register();

$configurator->addConfig(__DIR__ . '/../app/config/common.neon');
$configurator->addConfig(__DIR__ . '/../app/config/local.neon');
$container = $configurator->createContainer();

return $container;