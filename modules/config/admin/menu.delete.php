<?php
$data = getDetail("position", $table, $primary, $_GET['id']);
if($data['position']==1){
	$redirect_url = base_admin."/config/menu/select/admin"; 
} else {
	$redirect_url = base_admin."/config/menu/select/public"; 
}
delete("child", $module, $table, $primary, $_GET['id'], $child_table, $child_parent, $page);
delete("data", $module, $table, $primary, $_GET['id'], "", "", $redirect_url);
?>
