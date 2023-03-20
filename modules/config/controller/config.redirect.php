<?php
$module 		= "config";
$table 			= "redirect";
$primary 		= "id";
$field_orderby 		= "id";
$field_status 		= "status";
$field_ready_cek	= "url_from";
$limit 			= 50;
$select			= "*";
$default_order		= "DESC";

$where 		= "";
$orderby 		= "ORDER BY $field_orderby $default_order";

$switch_add		= "add-redirect";
$switch_edit		= "edit-redirect";
$switch_delete		= "delete-redirect";
$switch_status		= "status-redirect";
$switch_list		= "redirect";

$title_module		= "Redirect";
$title_list		= "List Redirect";
$title_add		= "Add Redirect";
$title_edit		= "Edit Redirect";

$validation[]		= array(
				"type"=>"required",
				"alert"=>"url_required",
				"form"=>"url_from",
				"title"=>"From ".$title_module);
$validation[]		= array(
				"type"=>"required",
				"alert"=>"url_required",
				"form"=>"url_to",
				"title"=>"To ".$title_module);

$validation[]		= array(
				"type"=>"ready",
				"alert"=>"url_ready",
				"form"=>$field_ready_cek,
				"title"=>$title_module);

$url_back		= base_admin."/".$module."/".$switch_list."/page/".$page;
$back_url_delete	= base_admin."/".$module."/".$switch_list."/page/".$page;

$delete[] = array("switch"=>"delete-redirect", "type"=>"data", "back"=>$back_url_delete);
?>