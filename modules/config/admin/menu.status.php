<?php
$title_module = "Menu";
if (!$_GET['id']=="") {
	$table = "menu";
	$field_status = "status";
	$primary = "id";
	if(preg_match("/admin/", $switch)){
		$_GET['select']="admin";
	} else {
		
	}
	
	$db->update($table, "$field_status='".$_GET['status']."'", "WHERE $primary ='".$_GET['id']."'");

	//redirect
	//if (! $_GET['page']=="") {
	//	echo "<meta http-equiv='refresh' content='0; url=".base_admin."/".$module."/menu/select/page/".$_GET['page']."'>";
	//} else{
	//	echo "<meta http-equiv='refresh' content='0; url=".base_admin."/".$module."menu/select/'>";
	//}
	
	//langsung ke list
	//$_GET = "";
	
	success("Success Update Status ".$title_module);
}else { 
	error("Error Update Status ".$title_module);
}
?>