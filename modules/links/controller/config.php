<?php
//config
$module 		= "links";
$table 			= "links";
$table2 		= "links_account";
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

$title_page 		= "Links";

if(isset($in_function)==1){
	$alias[$module][]	= $module; //default
}

$install['module'] 	= "links";

$install['menu'][] = array("name"=>"Links", "url"=>"links");
$install['menu_admin'][] = array("name"=>"Links", "url"=>"links", "icon"=>"glyphicon glyphicon-link");
$install['menu_admin']['sub'][] = array("name"=>"List Links", "url"=>"links", "icon"=>"", "order"=>"1");
$install['menu_admin']['sub'][] = array("name"=>"Add Links", "url"=>"links/add", "icon"=>"", "order"=>"2");
$install['menu_admin']['sub'][] = array("name"=>"Acount Links", "url"=>"links/account", "icon"=>"", "order"=>"2");

$install['directory'][]	= $directory_file;

$install['meta'][] = array();

if($in_admin==1){
	$field_orderby 		= "status";
	$field_ready_cek	= "url";
	$limit 			= 50;
	$select			= "*";
	$default_order		= "ASC";

	$where 		= "WHERE 1 ";
	$orderby 		= "ORDER BY $field_orderby $default_order";

	$title_module		= "Links";
	$title_list		= "List Links";
	$title_add		= "Add Links";
	$title_edit		= "Edit Links";
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