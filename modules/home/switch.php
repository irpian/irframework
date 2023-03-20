<?php
switch($switch){	
	
	case '' : 
	include $theme->template("home.php", "home");
	break;

	default : 
	include "home.php";
	break;
	
}