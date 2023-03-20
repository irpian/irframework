<?php 
	//array_regex, replace
	$replace_parameter[] = array(
		"regex" => "/\/det\//", 
		"search" => "/det/",
		"replace" => "/",
	);
	$replace_parameter[] = array(
		"regex" => "/\/cat\//", 
		"search" => "/cat/", 
		"replace" => "/category/",
	);
	$replace_parameter[] = array(
		"regex" => "/\/sbk\//", 
		"search" => "/sbk/",
		"replace" => "/category/",
	);
	$replace_parameter[] = array(
		"regex" => "/\/cri\//", 
		"search" => "/cri/",
		"replace" => "/search/",
	);
	$replace_parameter[] = array(
		"regex" => "/\/produk\//", 
		"search" => "/produk/",
		"replace" => "/product/",
	);
	$replace_parameter[] = array(
		"regex" => "/\/berita\//", 
		"search" => "/berita/",
		"replace" => "/news/",
	);

	$replace_ready = 0;
	foreach ($replace_parameter as $key => $value) {
		if(preg_match($value['regex'], $url)){
			$replace_ready = $replace_ready + 1;
			$url = str_replace($value['search'], $value['replace'], $url);
		}
	}

	if($replace_ready > 0){
		//backup url lama
		$url = str_replace("_", "-", $url);
		$url = str_replace("---", "-_-", $url);

		redirect301($url);
		exit();
	}

	foreach ($parameter_allow as $key => $value) {
		if(preg_match('/\/'.$value.'\//', $url)){
			$get_parameter = $site->getParameter($value, $explode_url);
		}
	}

	//backup redirect url lama
	// if($parameter2!=""){
	// 	$slug = getSeo($parameter2, $parameter_allow);
	// 	$pos = strpos($slug, "_");
	// 	if ($pos === true) {
	// 		$explode_slug = explode("_", $slug);
	// 		$count_explode_slug = count($explode_slug);
	// 		if($count_explode_slug >= 2){
	// 			//redirect ke url baru
	// 		}
	// 	}
	// }
	

	autoRedierct($url);
	autoRedierctModuleNonActive($alias, base_url."/404");
	$meta = meta($alias, $switch);
	$meta['url'] = removeLastSlash($url);
?>