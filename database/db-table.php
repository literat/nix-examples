<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Database\Db,
	Nix\Database\Table;

Debugger::init(true);

Db::connect(array('database' => 'nix_examples'));

$class = Table::init('Albums');

echo "<h2>reading get</h2>";
$person = new $class(3);
Debugger::dump($person->get());


echo "<h2>reading getby</h2>";
$album = new $class;
$album->setName('Test album - ' . date('d.m.Y'));
Debugger::dump($album->getBy('name'));


echo "<h2>writing</h2>";
if(isset($_GET['add'])) {
	$album = new $class;
	$album->setName("Test album - " . date('d.m.Y'))
	      ->setArtistId(1)
	      ->save();

	header('location: db-table.php');
} else {
	echo "<a href='?add'>Vlozit zaznam</a>";
}