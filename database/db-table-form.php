<?php

//TODO: solve the problem with diacritic marks

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Database\Db,
	Nix\Database\Table;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/../temp/');

Db::connect(array('database' => 'nix_examples'));

$class = Table::init('albums');
$albums = new $class;

$form = $albums->getForm();
$form->renderer->javascript = false;

if($form->isSubmit() && $form->isValid()) {
	dump($form->data);
}
	
echo $form->renderer->render();