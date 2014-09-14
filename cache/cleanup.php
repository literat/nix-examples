<?php

require_once('../../src/Nix/loader.php');

use Nix\Caching\Cache,
	Nix\Debugging\Debugger;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/../temp/');

$cache = new Cache();
$cache->clean(array(
	'priority' => 5,
	'tags' => 'tag-test',
));