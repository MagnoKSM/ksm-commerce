<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$query = new \MagnoKsm\DB\Sql();
	$result = $query->select('SELECT * FROM tb_users');

	echo json_encode($result);

});

$app->run();

 ?>