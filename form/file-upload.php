<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Forms\Form,
	Nix\Forms\Rule;

Debugger::init(true);

$form = new Form();
$form->addFile('photo')
	 ->addSubmit();
	 
$form['photo']->addRule(Rule::FILLED);

if ($form->isSubmit() && $form->isValid()) {

	echo "<h1>Odeslano:</h1>";
	Debugger::dump($form->data);
	$file = $form->data['photo'];
	if($file->ok()) {
		unlink('./test.jpeg');
		$file->move("./test.jpeg");
	}

}

// ======== html render ========

?>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />

<script type="text/javascript" src="validation/jquery.js"></script>
<script type="text/javascript" src="validation/jquery.validation.js"></script>
<link rel="stylesheet" href="style.css" type="text/css" />
<hr />

<?= $form->renderer->render() ?>