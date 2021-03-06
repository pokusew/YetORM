<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/yetorm.php';
require_once __DIR__ . '/model/ServiceLocator.php';


Tester\Environment::setup();

function id($a) { return $a; }
function test(\Closure $function) { $function(); }

Tester\Environment::lock();

ServiceLocator::getCacheStorage()->clean(array(
	Nette\Caching\Cache::ALL => TRUE,
));

Aliaser\Container::setCacheStorage(ServiceLocator::getCacheStorage());

$loader = new Nette\Loaders\RobotLoader;
$loader->setCacheStorage(ServiceLocator::getCacheStorage());
$loader->addDirectory(__DIR__ . '/model');
$loader->register();
