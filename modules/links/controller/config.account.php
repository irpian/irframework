<?php
$module 				= "links";
$table 					= "links_account";
$primary 				= "id";
$field_orderby 		= "name";
$field_status 		= "status";
$limit 					= 50;
$select 				= "*";
$default_order		= "ASC";

$where 				= "WHERE 1 ";
$where_parent	= "";
$orderby 				= "ORDER BY $field_orderby $default_order";

$switch_add		= "add-account";
$switch_edit			= "edit-account";
$switch_delete		= "delete-account";
$switch_status		= "status-account";
$switch_list			= "account";

$title_module		= "Account Links";
$title_list				= "List Account Links";
$title_add				= "Add Account Links";
$title_edit				= "Edit Account Links";
$title_detail			= "Detail Account Links";

//validation		//type, name validation, post name, atribute
$validation[]			= array(
							"type"=>"required",
							"alert"=>"name_required",
							"form"=>"name",
							"title"=>$title_module);

$validation[]			= array(
							"type"=>"ready",
							"alert"=>"name_ready",
							"form"=>"name",
							"title"=>$title_module);

$child_table			= "links";
$child_parent		= "account";

$url_back				= base_admin."/".$module."/".$switch_list."/page/".$page;
$back_url_delete	= base_admin."/".$module."/".$switch_list."/page/".$page;

$delete[] 				= array("switch"=>"delete-account", "type"=>"child", "back"=>"");
$delete[] 				= array("switch"=>"delete-account", "type"=>"data", "back"=>$back_url_delete);
?>