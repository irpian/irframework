<?php
$title_module ="Module";
if (!$_GET['id']=="") {
	$table 		= "module";
	$field_status 	= "status";
	$field_name 	= "name";
	$primary 	= "id";
	$db->update($table, "$field_status='".$_GET['status']."'", "WHERE $primary ='".$_GET['id']."'");
	$get_name = $db->value($field_name, $table, "WHERE $primary='".$_GET['id']."'");
	
	if($_GET['status']==1){
		installMenu($get_name);
		installDirectory($get_name);
		installVariable($get_name);
		installMeta($get_name);
	}

	//update status menu
	$db->update("menu", "$field_status='".$_GET['status']."'", "WHERE module='".$get_name."'");

	success("Success Update Status ".$title_module);
}else { 
	error("Error Update Status ".$title_module);
}
?>