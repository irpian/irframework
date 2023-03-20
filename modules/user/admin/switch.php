<?php
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
 
    case 'change-password' : 
    include "action.php";
    break;
    
    case 'delete' : 
    delete("data", $module, $table, $primary, $_GET['id'], $field_file, $dir_file, $page);
    break;
    
    default : 
    include "list.php"; 
    break;
}
?>