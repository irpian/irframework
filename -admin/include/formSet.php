<?php
$switch_add = defaultSwitchAdd($switch_add);
$switch_edit    = defaultSwitchEdit($switch_edit);
$switch_list    = defaultSwitchEdit($switch_list);
$url_back   = defaultBackUrl($url_back, $module, $switch_list, $page);

if ($_GET['switch']==$switch_add){ //add
    $title_page = $title_add;
    include "include/formPost.php";

}elseif($_GET['switch']==$switch_edit){ //edit
    $title_page = $title_edit;
    $data = getDetail($select, $table, $primary, $_GET['id']);
    extract($data);
    
}else{
    //error("Url Not Registerd");
}
?>