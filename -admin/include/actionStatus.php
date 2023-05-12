<?php
if (!$_GET['id']=="") {
    $db->update($table , "$field_status='".$_GET['status']."'", "WHERE $primary ='".$_GET['id']."'");
    $_GET = "";
    success("Success Update Status ".$title_module);
}else { 
    error("Error Update Status ".$title_module);
}
?>