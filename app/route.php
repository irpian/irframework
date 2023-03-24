<?php

class Route(){

	public $request;

	public function __construct() {
	  $this->request = new Request();
	}

	function get_name() {

	}

	function state(){
		global $config;
		if($param[1] == "admin"){
			$state = "backend";
		} else {
			$state = "frontend";
		}

		return $this->state;
	}

	function alias(){

		return $alias;
	}

	function last(){

	}

	function set(){
		global $config;
		if($this->state() == "backend"){
			if(in_array($alias, $list_module)){
				include "modules/".$alias."/backend/route.php";
			}else{
				include "modules/".$config['module']['default']."/backend/route.php";
			}
		} else {
			if(in_array($alias, $list_module)){
				include "modules/".$alias."/route.php";
			}else{
				include "modules/".$config['module']['default']."/route.php";
			}
		}
	}
}


$route = new Route():
$route->set();
?>
