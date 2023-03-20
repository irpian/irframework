<?php
if(preg_match("/redirect/", $switch)){
	include "../modules/".$module."/controller/config.redirect.php";
	switch($switch){
		//redirect
		case 'redirect' : 
		include "redirect.php";
		break;
		
		case 'edit-redirect' : 
		case 'add-redirect' : 
		include "redirect.action.php";
		break;

		default : 
		include "redirect.php";	
		break;
	}

}elseif(preg_match("/meta/", $switch) && !preg_match("/meta-image/", $switch) ){
	include "../modules/".$module."/controller/config.meta.php";
	switch($switch){
		//redirect
		case 'meta' : 
		include "meta.php";
		break;
		
		case 'edit-meta' : 
		case 'add-meta' : 
		include "meta.action.php";
		break;

		default : 
		include "meta.php";	
		break;
		
	}

}elseif(preg_match("/menu/", $switch)){

	include "../modules/".$module."/controller/config.menu.php";
	switch($switch){
		//menu
		case 'menu' : 
		include "menu.php";
		break;
		
		case 'edit-menu' : 
		case 'edit-menu-admin' : 
		case 'add-menu' : 
		case 'add-menu-admin' : 
		include "menu.action.php";
		break;
		
		case 'detail-menu' : 
		include "menu.detail.php";
		include "menu.php";
		break;
		
		case 'delete-menu' : 
		include "menu.delete.php";
		break;
		
		case 'status-menu' :
		case 'status-menu-admin' : 
		include "menu.status.php";
		include "menu.php";
		break;
	}

} else {

	include "../modules/".$module."/controller/config.php";
	switch($switch){

		// config
		case '' : 
		include "main.php";
		break;
			
		case 'list' : 
		include "list.php";
		break;
		
		case 'add' : 
		case 'edit' : 
		include "action.php";
		break;
		
		case 'delete' : 
		delete("data", $module, $table, $primary, $_GET['id'], "", "", $page);
		break;

		case 'delete-file' : 
		if(isset($_GET['id'])!=""){
			$file = $_GET['id'];
			include $file.".php";
		}
		break;

		case 'status' :
		include "include/actionStatus.php";
		include "list.php";
		break;
		
		//module
		case 'module' : 
		include "module.php";
		break;
		
		case 'status-module' : 
		include "module.status.php";
		include "module.php";
		break;
		
		//image
		case 'icon' : 
		include "icon.php";
		break;

		case 'logo' : 
		include "logo.php";
		break;

		case 'meta-image' : 
		include "metaImage.php";
		break;

		case 'theme' : 
		include "theme.php";
		break;
		
		default : 
		include "list.php";	
		break;
	}
}
?>