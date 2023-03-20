<?php
//config
$install['module']  = "user";

$install['menu_admin'][] = array("name"=>"User", "url"=>"user", "icon"=>"glyphicon glyphicon-user");
$install['menu_admin']['sub'][] = array("name"=>"List User", "url"=>"user", "icon"=>"", "order"=>"1");
$install['menu_admin']['sub'][] = array("name"=>"Add User", "url"=>"user/add", "icon"=>"", "order"=>"2");

if($in_admin==1){
    $module             = "user";
    $table              = "admin";
    $primary            = "id";
    $field_orderby          = "name";
    $field_status           = "status";
    $field_ready_cek        = "name";
    $field_ready_cek2       = "email";
    $field_ready_cek3       = "password";
    $limit              = 50;
    $select             = "id, name";
    $select             = "*";
    $default_order          = "ASC";

    $where          = "WHERE 1 ";
    $orderby            = "ORDER BY $field_orderby $default_order";

    $unset_query_add        = array("id", "password_new", "password_repeat", "submit");
    $unset_query_update         = array("id", "password_new", "password_repeat", "submit");
}
?>
