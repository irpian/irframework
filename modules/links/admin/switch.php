<?php
if(preg_match("/account/", $switch)){
	include "../modules/".$module."/controller/config.account.php";
	switch($switch){	
		case 'account' : 
		include "account.php";
		break;
		
		case 'add-account' : 
		case 'edit-account' : 
		include "account.action.php";
		break;

		default : 
		include "account.php";	
		break;
	}
}else{
	include "../modules/".$module."/controller/config.php";
	switch($switch){	
		
		case '' : 
		case 'list' : 
		include "list.php";
		break;
		
		case 'add' : 
		case 'edit' : 
		include "action.php";
		break;
		
		case 'delete' : 
		include "include/actionDelete.php";
		break;
		
		case 'status' : 
		include "list.php";
		break;

		default : 
		include "list.php";	
		break;
	}
}

?>