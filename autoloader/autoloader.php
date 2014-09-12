<?php

require_once('../../../libs/Nix/loader.php');

use Nix\Loaders;

$autoload = new Loaders\RobotLoader('temp/');
$autoload->addDir(dirname(__FILE__) . '/../../../libs/Nix');
$autoload->register();

echo "<pre>";
print_r($autoload->getClasses());
echo "</pre>";