<?php
$module 		= "config";
$table 			= "meta";
$primary 		= "id";
$field_orderby 		= "id";
$field_status 		= "status";
$field_ready_cek	= "title";
$limit 			= 50;
$select			= "*";
$default_order		= "ASC";

$where 		= "";
$orderby 		= "ORDER BY $field_orderby $default_order";

$switch_add		= "add-meta";
$switch_edit		= "edit-meta";
$switch_delete		= "delete-meta";
$switch_status		= "status-meta";
$switch_list		= "meta";

$title_module		= "Meta Title";
$title_list		= "List Meta Title";
$title_add		= "Add Meta Title";
$title_edit		= "Edit Meta Title";

$validation[]		= array(
				"type"=>"required",
				"alert"=>"custom_required",
				"form"=>"module",
				"title"=>"Module ".$title_module);
// $validation[]		= array(
// 				"type"=>"required",
// 				"alert"=>"custom_required",
// 				"form"=>"meta_switch",
// 				"title"=>"Switch ".$title_module);

$validation[]		= array(
				"type"=>"ready",
				"alert"=>"title_ready",
				"form"=>$field_ready_cek,
				"title"=>$title_module);

$url_back		= base_admin."/".$module."/".$switch_list."/page/".$page;
$back_url_delete	= base_admin."/".$module."/".$switch_list."/page/".$page;

$delete[] = array("switch"=>"delete-meta", "type"=>"data", "back"=>$back_url_delete);
?>