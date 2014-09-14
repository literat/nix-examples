<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Forms\Form;

Debugger::init(true);

$multi = array(
	'desk' => 'Desk',
	'pencil' => 'Pencil',
	'tv' => 'Televesion',
	'pc' => 'Computer',
);

$form = new Form();

$form->addText('text-field');
$form->addTextarea('textarea');
$form->addMultiCheckbox('multi-checks', $multi);
$form->addMultiSelect('multi-select', $multi);
$form->addSelect('select', $multi);
$form->addSubmit();

$form['select']->setEmptyValue('-- select value --');

if($form->isSubmit()) {
	Debugger::dump($form->data);
}

echo $form;