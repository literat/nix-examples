<?php

# nacteme knihovnu
ob_start();
# loader Nix libraries
require_once('../../src/Nix/loader.php');

use Nix\Templating\Template,
	Nix\Debugging\Debugger,
	Nix\Utils\Paginator,
	Nix\Templating\Helpers\HtmlHelper,
	Nix\Http\Http;

Debugger::setLogPath(__DIR__.'/../temp/');
Debugger::init(TRUE);

/**
 * Processes the framework url
 * 
 * @param string $url url
 * @param array $args rewrite args
 * @param array|false $params rewrite params
 * @return string
 */
function frameworkUrl($url, $args = array(), $params = false) {
	if(empty($url)) {
		$url = Http::$request->request;
	} else {
		$url = preg_replace('#\<\:([a-z0-9]+)\>#ie', "isset(\$args['\1']) ? \$args['\1'] : ''", $url);
	}

	if($params !== false) {
		$p = array();
		$params = array_merge($_GET, (array) $params);
		foreach($params as $name => $value) {
			if($value == null) {
				continue;
			}
			$p[] = urlencode($name) . '=' . urlencode($value);
		}

		if(!empty($p)) {
			$url .= '?' . implode('&', $p);
		}
	}

	return Http::$baseURL /*. '/'*/ . ltrim($url, '/');
}

# nase data, ktera chceme strankovat
$data = array('Petr', 'Anna', 'Martin', 'Jan', 'Pavla', 'Romana', 'Alice', 'Lukas');
# stranka, kterou chceme zobrazit; ziskame z utl
$page = (isset($_GET['page']))? $_GET['page']: 1;
# pocet polozek na strance
$onpage = 2;
# vytvorime instanci strankovace
$paginator = new Paginator($page, count($data), $onpage);


# vybareme potrebna data
$data = array_slice($data, ($page - 1) * $onpage, $onpage);
# data vypiseme
foreach ($data as $name)
    echo $name . '<br />';


$html = new HtmlHelper();
echo $html->paginator($paginator);

# jeste pripojime styly
?>
<style>
div.pagination {
	margin-bottom: 20px;
	height: 28px;
}

div.pagination span.hellip {
	float: left;
	padding: 5px 0;
}

div.pagination span.button, div.pagination a {
	float: left;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	padding: 2px 4px;
	margin: 2px;
	text-align: center;
}

div.pagination a {
	background: #3B699F;
	color: white;
	text-decoration: none;
}

div.pagination a.page-link {
	width: 16px;
}

div.pagination span.button {
	background: #99BBDF;
	color: white;
}

div.pagination span {
	margin: 0 4px;
}
</style>