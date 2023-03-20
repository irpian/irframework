<?php
$module 		= "config";
$table 			= "config";
$primary 		= "id";
$field_orderby 		= "name";
$field_status 		= "status";
$field_ready_cek	= "inisial";
$limit 			= 100;
$select			= "*";
$default_order		= "ASC";

$where 		= "WHERE 1 ";
$orderby 		= "ORDER BY $field_orderby $default_order";
$unset_query_add 	= ["id", "image_hidden", "file_hidden", "submit"];
$unset_query_update 	= ["id", "image_hidden", "file_hidden", "submit"];

$title_module		= "Cofiguration";
$title_list 		= "List Config";
$title_add 		= "Add Config";
$title_edit 		= "Edit Config";

$inisial_upload 	= "default";

$install['menu_admin'][] =
    [
        "name"=>"Config",
        "url"=>"config",
        "icon"=>"glyphicon glyphicon-cog"
    ];

//-- variable --//
$install['variable'][] =
    [
        "name"=>"Website Name",
        "inisial"=>"site_name",
        "value"=>'Website Name',
        "type"=>"1",
        "web_config"=>"1"
    ];
$install['variable'][] =
    [
        "name"=>"Website Email",
        "inisial"=>"site_email",
        "value"=>'email@domain.com',
        "type"=>"1",
        "web_config"=>"1"
    ];
$install['variable'][] = ["name"=>"Theme", "inisial"=>"theme", "value"=>'default', "type"=>"1", "web_config"=>"0"];
$install['variable'][] = ["name"=>"Favicon", "inisial"=>"icon", "value"=>'', "type"=>"1", "web_config"=>"0"];
$install['variable'][] = ["name"=>"Logo Website", "inisial"=>"logo", "value"=>'', "type"=>"1", "web_config"=>"0"];
$install['variable'][] = ["name"=>"Meta Image", "inisial"=>"meta_image", "value"=>'', "type"=>"1", "web_config"=>"0"];
?>
