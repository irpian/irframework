<?php
$module 		= "config";
$title_page 		= "menu";
$table 			= "menu";
$primary 		= "id";
$select		 	= "*";
$field_ready_cek 	= "name";
$field_orderby 		= "orderby";
$field_group 		= "position";
$limit 			= 50;

$child_table		= "menu";
$child_parent		= "parent";

$default_order		= "ASC";
$orderby 		= "ORDER BY $field_orderby $default_order";

$switch_add		= "add-menu";
$switch_edit		= "edit-menu";
$switch_delete		= "delete-menu";
$switch_status		= "status-menu";
$switch_detail		= "detail-menu";
$switch_list		= "menu";

$title_module		= "Menu";
$title_list 		= "List Menu";
$title_add 		= "Add Menu";
$title_edit 		= "Edit Menu";
$title_detail 		= "List Sub Menu";

?>