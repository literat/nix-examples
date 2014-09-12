<?php

require_once('../../../libs/Nix/loader.php');

use Nix\Caching\Cache,
	Nix\Debugging\Debugger;

Debugger::setLogPath(dirname(__FILE__));
Debugger::init(true);

$cache = new Cache();
if($cache->isCached('var')) {
	echo "cached: " . $cache['var'];
} else {
	$cache->set('var', 'variable', array(
		'expires' => 60,
		'sliding' => true,
	));

	echo "saved";
}