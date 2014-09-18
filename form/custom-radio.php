<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Forms\Form;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/../temp/');

$data = array(1,2,3,5,6,7);

$form = new Form();
$form->addRadio('radio', array_flip($data))
	 ->addSubmit();

//echo $form;
/*
if($form->isSubmit()) {
	Debugger::dump($form->data);
	exit;
}
*/

$html = $form->startTag();
$html .= $form['radio']->label();
$html .= "<table border=1>";
foreach($data as $i) {
	$html .= "<tr><td>";
	$html .= $form['radio']->getControl($i);
	$html .= "</td><td>Entry $i</td></tr>";
}

$html .= $form->addSubmit();

$html .= $form->endTag();

if($form->isSubmit()) {
	Debugger::dump($form->data);
	exit;
}

echo $html;