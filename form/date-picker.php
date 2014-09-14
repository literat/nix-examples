<?php

ob_start();

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Config\Configurator,
	Nix\Forms\Form;

Configurator::write('core.debug', 2);

$form = new Form();
$form->addDatepicker('date')
     ->addSubmit();

if ($form->isSubmit()) {
	dump($form->data);
}
     
?>

<link rel="stylesheet" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/cupertino/jquery-ui.min.css" type="text/css" />
<script src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", '1');
	google.load("jqueryui", '1');
	google.setOnLoadCallback(function() {
		$('.calendar').datepicker();
	});
</script>

<?php echo $form ?>