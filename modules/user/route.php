<?php
if($module->state() == "api"){ 

	$route->get('/', function(){
		echo 'Api User';
	});

	$route->get('/test', function(){
		echo 'Api User test';
	});

	$route->get('/api/user/callback', function(){
		echo 'Callback executed 2';
	});

}elseif($module->state() == "backend"){ 
	// $route->get('/', 'view/backend/index.php');
	// $route->get('/test', 'view/backend/index.php');

	$route->get('/', function(){
		echo 'Admin User';
	});

	$route->get('/test', function(){
		echo 'Admin User test';
	});
} else {
	$route->get('/', function(){
		echo 'Public User';
	});

	$route->get('/test', function(){
		echo 'public User test';
	});
	
	// $route->get('/', 'view/index.php');
	// $route->get('/test', 'view/backend/index.php');
}
