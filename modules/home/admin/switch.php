<?php
include "../modules/home/controller/config.php";
switch($switch){	
	case '' : 
	case 'home' : 
	include "home.php";
	break;
	
	case 'logout' : 
	include "logout.php";
	break;
	
	default : 
	include "home.php";
	break;
}
?>