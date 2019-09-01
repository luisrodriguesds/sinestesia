<?php
	$db = parse_ini_file(__DIR__ . "/../env.ini", true);
	$db = $db['BANCO_DE_DADOS'];
	
	//LOCAL
	//BANCO DE DADOS
	define('HOSTNAME', $db['server']);
	define('PORT', $db['port']);
	define('USERNAME', $db['user']);
	define('PASSWORD', $db['pass']);
	define('DATABASE', $db['data']);
	define('PREFIX', 'sn');
	define('CHARSET', 'utf8');

	define('URLBASE', $db['url']);

	//URLS
	define('URL_BASE', $db['url'].'login/');
	define('URL_PAINEL', URL_BASE.'painel/');

	//DIRS
	define('DIR_BASE', $_SERVER['DOCUMENT_ROOT'].'/');
	define('DIR_SYSTEM', DIR_BASE.'sistema/');
	define('DIR_IMG', DIR_BASE.'images/');
	// define('DIR_IMG_BOL', DIR_BASE.'login/painel/imagensBolsistas/');

	//DIRS PARA PDF
	define('DIR_PDF', DIR_BASE.'painel/pdfs/');
	define('DIR_VIDEOS', DIR_BASE.'painel/videos/');

	//FILES
	define('FLIE_CONFIG', DIR_SYSTEM.'config.php');
	define('FLIE_HELPERS', DIR_SYSTEM.'helpers.php');
	define('FLIE_DATABASE', DIR_SYSTEM.'database.php');
	define('FILE_CONNECTION', DIR_SYSTEM.'connection.php');


	

?>