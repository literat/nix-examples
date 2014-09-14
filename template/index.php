<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Templating\Template;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/../temp/');

$template = new Template('template.tpl');
$template->variable = 'obsah a <tag> s .';
$template->bool = true;
$template->byte = 101293400;
$template->text = "adipiscing elit. Nunc vitae odio dui. In congue turpis nec mi consequat pretium consequat ipsum sodales.
Phasellus porttitor, quam id feugiat egestas, lectus diam malesuada metus, at luctus magna eros sit amet quam.
Sed odio lacus, tempus sit amet ultricies sit amet, iaculis eget augue. Nam elementum luctus tortor,
congue tristique odio pharetra ultricies. In posuere nisi nec neque feugiat lobortis. ";


echo $template->render();
echo Debugger::renderToolbar();