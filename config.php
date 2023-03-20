<?php
$config['host']	= "localhost";
$config['user']	= "root";
$config['pass']	= "root";
$config['dbs']	= "irtools";

$config['session'] = "irtools".date("dmY");
$config['session_admin'] = "irtools".date("dmY");

$session = $config['session'];
$session_admin = $config['session_admin'];

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
	$server_http = "http";
} else {
	$server_http = "https";
}

define("base_root", dirname( __FILE__ ));
define("base_url", $server_http."://irtools.com", true);
define("base_admin", base_url."/admin", true);
define("base_image", base_url."/images", true);



$website = "ir-tools";

error_reporting(0);
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
?>
