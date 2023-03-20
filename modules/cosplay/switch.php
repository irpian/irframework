<?php
$theme =  new theme();
switch($switch){
	case '' :
	case 'main' :
	include_once "action.php";
	include $theme->template("cosplay.php", "cosplay");
	break;

	// case 'list' :
	// $template['layout'] =  $theme->base()."/layout.blank.php";
	// include_once "action.php";
	// break;
	//
	// case 'saved' :
	// $template['layout'] =  $theme->base()."/layout.blank.php";
	// include "action.php";
	// break;

	case 'sorting' :
	include "sorting.php";
	break;

	default :
	include_once "action.php";
	include $theme->template("cosplay.php", "cosplay");
	break;
}
