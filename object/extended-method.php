<?php

require_once('../../src/Nix/loader.php');

use Nix\Object,
	Nix\Debugging\Debugger;

Debugger::setLogPath(dirname(__FILE__));
Debugger::init(true);

class Text extends Object
{
	public $names = array();

	public function add($name)
	{
		$this->names[] = $name;
	}
}

function printTextNames($_this, $separator = ", ")
{
	return implode($separator, $_this->names);
}

Text::extendMethod('text::printall', 'printtextnames');

$names = new Text();
$names->add('Tomáš Litera');
$names->add('Dita Kubátová');
$names->add('Liška Bystrouška');

echo $names->printall();