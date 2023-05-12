<?php
if($module->state() == "api"){  
	$route->get('/', function(){
		echo 'api main';
	});

	$route->get('/test', function(){
		echo 'api main test';
	});
}elseif($module->state() == "backend"){ 
	$route->get('/', 'view/backend/index.php');

	$route->get('/test', function(){
		echo 'backend main test';
	});
} else {
	$route->get('/', 'view/index.php');

	$route->get('/test', 'view/backend/index.php');
}

//any('/404', 'view/any.php');
