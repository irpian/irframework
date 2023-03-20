<?php

if (!empty($_GET['action'])){ 
    $module = $_GET['action'];
}else{
    $module = "home";
}

if (!empty($_GET['switch'])){ 
    $switch = $_GET['switch'];
}else{
    $switch ="";
}

if(in_array($module, $list_module)){
    include "../modules/".$module."/admin/switch.php";
}else{
    $switch = $_GET['action'];
    include "../modules/home/admin/switch.php";
}
?>