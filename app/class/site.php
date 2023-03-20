<?php
class site {

	function icon(){
		if(config("icon")!=""){
			return base_image."/".config("icon");
		} else {
			return "";
		}
	}

	function logo(){
		if(config("logo")!=""){
			return base_image."/".config("logo");
		} else {
			return "";
		}
	}

	function metaImage(){
		if(config("meta_image")!=""){
			return base_image."/".config("meta_image");
		} else {
			return "";
		}
	}

	function copyright(){
		return config("copyright");
	}

	function getAlias($list_module){
		global $db;
		global $_SERVER;
		$set_request =  explode("/", $db->xxs($db->injection($_SERVER["REQUEST_URI"])));
		$request = $set_request[1];
		$in_function = 1;
		if($request==""){
			$alias = "home";
		} else {
			ob_start();
			foreach ($list_module as $key => $value) {
				$alias[] = include base_root."/modules/".$value."/controller/config.php";
					if(!is_array($alias[$value])){
						unset($alias[$key]);
					}
			}

			foreach ($alias as $key => $value) {
				$keys = array_search($request, $alias[$key]);
				if($alias[$key][$keys]==$request){
					$alias = $key;
				}
			}

			if(!in_array($alias, $list_module)){
				$alias = "page";
			}
		}
		$in_function = 0;
		ob_end_clean();
		return $alias;
	}

	//url
	//-- domain
	//-- domain/module
	//-- domain/module/page/1
	//-- domain/module/detail
	//-- domain/module/kategory/kategory_name
	//-- domain/module/kategory/kategory_name/page/1
	//-- domain/module/search/query
	//-- domain/module/search/query/page/1
	//-- domain/default

	function getSwitch($alias, $parameter_allow){
		global $db;
		global $_SERVER;
		$explode_url = explode("/", $db->xxs($db->injection($_SERVER["REQUEST_URI"])));
		$switch = $explode_url[2];

		if($explode_url[4]!="" && in_array($explode_url[3], $parameter_allow)){

		}

		if($explode_url[3]!="" && in_array($explode_url[2], $parameter_allow)){
			$switch = "";
		}

		if($switch!="" && $explode_url[3]!="" && !in_array($explode_url[3], $parameter_allow)){
			redirect301(base_url."/".$explode_url[1]."/".$explode_url[2]);
		}

		if($alias=="page"){
			$switch = $explode_url[1];
		}

		return $switch;
	}

	function getParameter($type){
		global $db;
		global $_SERVER;
		$parameter 	= "";
		$selected 	= "";
		$redirect	= "";
		$explode_url = explode("/", $_SERVER["REQUEST_URI"]);
		foreach ($explode_url as $key => $value) {
			if($value==$type){
				$selected = $key;
				break;
			}else{
				$redirect .= $value."/";
			}
		}

		if($selected!=""){
			if($explode_url[$selected+1]!=""){
				$parameter = $explode_url[$selected+1];
			}
		}

		if($explode_url[$selected]!="" && $parameter==""){
			redirect(substr(base_url.$redirect, 0, -1));
		}

		return $db->xxs($db->injection($parameter));
	}

	function getPage(){
		$explode_url = explode("/", $_SERVER["REQUEST_URI"]);
		$page = 1;
		$page = $this->getParameter("page", $explode_url);

		if($page==""){
			$page =1;
		} else {
			if(!is_numeric($page)){
				$page = 1;
			}
		}
		return $page;
	}
}

$site = new site();
?>
