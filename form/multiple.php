<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Forms\Form,
	Nix\Config\Configurator;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/../temp/');

Configurator::write('core.debug', 3);

$form = new Form();
$form->addMultiCheckbox('spotrebice', array('pc' => 'PC', 'dvd' => 'DVD', 'bluray' => 'Blu-Ray'),"Spotřebiče")
     ->addMultiSelect('spotrebice2', array('pc' => 'PC', 'dvd' => 'DVD', 'bluray' => 'Blu-Ray'),"Mé druhé spotřebiče")
     ->addSubmit();

$form->setDefaults(array('spotrebice' => array('pc', 'bluray', 'dvd')));
$form->setDefaults(array('spotrebice2' => array('pc', 'bluray')));

if($form->isSubmit() && $form->isValid()) {
    echo "<h1>Odeslano:</h1>";
    Debugger::dump($form->data);
}

$form->setRenderer('dl');

// ======== html render ========

?>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<link rel="stylesheet" href="style.css" type="text/css" />

<h1>Multiple Form</h1>

<?= $form ?>