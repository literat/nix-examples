<?php

require_once('../../src/Nix/loader.php');

use Nix\Caching\Cache,
	Nix\Debugging\Debugger;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/../temp/');

$cache = new Cache();
//$cache->delete('var');


if(isset($cache['var'])) {
	echo "Cached: " . $cache['var'];
} else {
	$var = date('H:i.s');
	echo "saving. ". $var;
	$cache->set('var', $var, array(
		'files' => array(__FILE__),
		'tags' => 'tag-test',
		'priority' => 6,
	));
}