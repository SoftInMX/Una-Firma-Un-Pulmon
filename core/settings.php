<?php
	session_start();
	
	# Para accesar a la base de datos
	const DBHOST = 'localhost';
	const DBUSER = 'root';
	const DBPASS = 'olamund0';
	const DBNAME = 'ufup';
	const HTML = 'static/';
	const WEB_RAIZ = '/';
	const TEMPLATE = 'static/template.html';
	const PRODUCCION = true;
	
	if(PRODUCCION) {
		ini_set('display_errors', '0');
	} else {
		error_reporting(E_ALL);
		ini_set("display_errors", 'On');
	}
	
	require_once('helpers/helper.php');
?>
