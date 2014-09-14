<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Sessions\Session;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/../temp/');

$ns = Session::getNamespace('test');
if (!$ns->exists('var1')) {
	$ns->set('var1', 'val');
	$ns->set('var2', 'val', time() + 15);
	header('location: variable-expiration.php');
} elseif (isset($_GET['delete'])) {
	$ns->delete('var1');
	$ns->delete('var2');
	header('location: variable-expiration.php');
} else {
	echo "var 1: " . $ns->var1 . "<br/>";
	echo "var 2: " . $ns->var2 . "<br/>";
	echo "<a href='?delete'>delete</a>";
}