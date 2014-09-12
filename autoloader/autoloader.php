<?php

require_once('../../src/Nix/loader.php');

use Nix\Loaders;

$autoload = new Loaders\RobotLoader('temp/');
$autoload->addDir(dirname(__FILE__) . '/../../src/Nix');
$autoload->register();

echo "<pre>";
print_r($autoload->getClasses());
echo "</pre>";