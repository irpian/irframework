<?php
$theme =  new theme();
switch($switch){
	case '' : 
	case 'main' : 
	default : 
	include_once "action.php";
	include $theme->template("links.php", "links");
	break;
}