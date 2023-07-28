<?php
$config['host']	= "localhost";
$config['user']	= "root";
$config['pass']	= "root";
$config['dbs']	= "irtools";

$config['session'] = "irtools".date("dmY");
$config['session_backend'] = "irtools".date("dmY");

$session = $config['session'];
$session_admin = $config['session_backend'];

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
	$serverHttp = "http";
} else {
	$serverHttp = "https";
}

define("base_root", dirname( __FILE__ ));
define("base_url", $serverHttp.$_SERVER['SERVER_NAME']);
define("base_admin", base_url."/admin");
define("base_image", base_url."/images");

// $config['module']['alias']['main'] = "main";
// $config['module']['alias']['berita'] = "news";
// $config['module']['alias']['user'] = "user";

// $config['state']['backend'] = "admin";
// $config['state']['api'] = "api";

// $config['module']['default'] = "main";
// $config['module']['list'][] = "main";
// $config['module']['list'][] = "user";

// $config['theme']['default'] = 'default';

$config['module']['list'] = []; 
$config['module']['list'][] = "main";
$config['module']['list'][] = "user";

$website = "ir-tools";

//error_reporting(0);
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
