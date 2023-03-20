<?php
//config
$module 		= "cosplay";
$table 			= "cosplay";
$table2 		= "cosplay_account";
$primary 		= "id";
$field_orderby 		= "status";
$field_status 		= "status";
$field_file 		= "image";
$directory_file 		= "";
$directory_url 		= "";
$limit 			= 20;
$select 		= "*";
$default_order		= "ASC";

$where 		= "";
$where 		.= "WHERE 1 ";
$orderby 		= "ORDER BY $field_orderby $default_order";

$title_page 		= "Cosplay";

if(isset($in_function)==1){
	$alias[$module][]	= $module; //default
}

$install['module'] 	= "cosplay";

$install['menu'][] = array("name"=>"Cosplay", "url"=>"cosplay");
$install['menu_admin'][] = array("name"=>"Cosplay", "url"=>"cosplay", "icon"=>"glyphicon glyphicon-user");
$install['menu_admin']['sub'][] = array("name"=>"List Cosplay", "url"=>"cosplay", "icon"=>"", "order"=>"1");
$install['menu_admin']['sub'][] = array("name"=>"Add Cosplay", "url"=>"cosplay/add", "icon"=>"", "order"=>"2");
$install['menu_admin']['sub'][] = array("name"=>"Acount Cosplay", "url"=>"cosplay/account", "icon"=>"", "order"=>"2");

$install['directory'][]	= $directory_file;

$install['meta'][] = array();

if($in_admin==1){
	$field_orderby 		= "status";
	$field_ready_cek	= "url";
	$limit 			= 10;
	$select			= "*";
	$default_order		= "ASC";

	$where 		= "WHERE 1 ";
	$orderby 		= "ORDER BY $field_orderby $default_order";

	$title_module		= "Cosplay";
	$title_list		= "List Cosplay";
	$title_add		= "Add Cosplay";
	$title_edit		= "Edit Cosplay";
	$title_detail		= "";

	$inisial_upload 	= ""; //default //name module
	$type_upload 		= ""; //default //resize //thumbnail

	$form_search = array('search', 'status', 'sort', 'category');

	$validation[]		= array(
					"type"=>"required",
					"alert"=>"custom_required",
					"form"=>"url",
					"title"=>$title_module);

		$validation[]		= array(
					"type"=>"required",
					"alert"=>"custom_required",
					"form"=>"account",
					"title"=>"Account");

	$url_back		= base_admin."/".$module."/page/".$page;

	$delete[] = array("switch"=>"delete", "type"=>"data", "back"=>$page);
}
?>
