<?php
function autoRedierct($url){
	global $db;
	$save_url = $db->xxs($db->injection($url));
	$cek_redirect = $db->value("url_to", "redirect", "WHERE url_from='".$save_url."' AND status=1");
	if($cek_redirect){
		redirect301($cek_redirect);
	}
}

function autoRedierctModuleNonActive($alias, $url){
	global $db;
	$alias = $db->xxs($db->injection($alias));
	$status_module = $db->value("status", "module", "WHERE name='".$alias."' ");
	if($status_module=="0" && $alias!="home" && $alias!="config"){
		redirect301($url);
		exit();
	}
}

function meta($alias, $switch){
	global $db;
	global $site;
	$set_meta = $db->value("title, meta_keyword, meta_description, module, meta_switch", "meta", "WHERE 1 AND module='".$alias."' AND meta_switch='".$switch."' AND status=1");
	$meta['title'] 		= $set_meta['title'];
	$meta['keyword']	= $set_meta['meta_keyword'];
	$meta['description']	= $set_meta['meta_description'];
	$meta['canonical'] 	= removeLastSlash(base_url."/".$set_meta['module']."/".$set_meta['meta_switch']);
	$meta['image']		= $site->metaImage();
	return $meta;
}
?>