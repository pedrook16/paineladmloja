<?php
require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/paineladmloja/");
	$config['dbname'] = 'nova_loja';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "http://projects.crddeveloper.com/paineladmloja/");
	$config['dbname'] = 'crddev71_loja';
	$config['host'] = '162.241.2.184';
	$config['dbuser'] = 'crddev71_pedro';
	$config['dbpass'] = 'ba0896@P';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}