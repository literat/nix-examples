<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Config\Configurator,
	Nix\Forms\Html,
	Nix\Forms\Rule,
	Nix\Forms\Form;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/temp/');

Configurator::write('core.debug', 2);

$form = new Form();

$label_age = Html::el('label', 'Věk')->append(Html::el('small', ' (nepovinné)'));

$form->addText('name', 'Jméno')
	 ->addTextarea('aboutMe', 'O mně')
	 ->addText('age', $label_age)
	 ->addRadio('sex', array(
	 	'male' => Html::el('img')->src('male.png'),
	 	'female' => Html::el('img')->src('female.png'),
	 ), 'Pohlaví')
	 ->addSelect('city', array('brno', 'Brno', 'ostrava', 'Ostrava', 'praha', 'Praha'))
	 ->addPassword('password', 'Heslo')
	 ->addPassword('password2', 'Heslo znovu')
	 ->addCheckbox('agree', 'Souhlasím')
	 ->addSubmit('Register');

$form['name']->addRule(Rule::FILLED);
$form['name']->addRule(Rule::LENGTH, '>5', 'Zadejte délku větší jak 5.');
$form['age']->addCondition(Rule::FILLED)
			->addRule(Rule::INTEGER)
			->addRule(Rule::RANGE, array(15,99));
$form['sex']->addRule(Rule::FILLED);
$form['password']->addRule(Rule::EQUAL, $form['password2'], 'Hesla se musí shodovat');
$form['agree']->addRule(Rule::FILLED, null, 'Musíte souhlasit s podmínkami');

if($form->isSubmit() && $form->isValid()) {

	echo "<h1>Odeslano:</h1>";
	Debugger::dump($form->data);
	exit;

}

// ======== html render ========

?>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="validation/jquery.js"></script>
<script type="text/javascript" src="validation/jquery.validation.js"></script>
<link rel="stylesheet" href="style.css" type="text/css" />
<h1>Nix Forms</h1>

<?php

	$form->setRenderer('dl');
	echo $form->renderer->render('start');

	echo $form->renderer->render('part', array('name'), 'Osobní údaje');
	echo $form->renderer->render('part', array('aboutMe', 'age', 'sex'), 'Další');
	echo $form->renderer->render('part', array(), 'Odeslání');

	echo $form->renderer->render('end');

?>