<?php
session_start();

include "config.php";
include_once "app/app.php";
include_once "app/routes.php";


//var_dump($config);



include $route->set();

// require_once "include/class.db.php";
// require_once "include/config.function.php";
// require_once "include/config.class.php";
// require_once "include/config.request.php";
// require_once $theme->base()."/config.php";
// timeZone();
// if($layout!=""){
// 	include $layout;
// } else {
// 	include $theme->base()."/layout.php";
// }


?>
