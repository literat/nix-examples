<?php

require_once('../../src/Nix/loader.php');

use Nix\Caching\Cache,
	Nix\Debugging\Debugger;

Debugger::setLogPath(dirname(__FILE__));
Debugger::init(true);

$cache = new Cache();
$cache->clean(array(
	'priority' => 5,
	'tags' => 'tag-test',
));