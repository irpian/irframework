<?php
class theme {

	public function __construct() {
		$this->module = new Module();
	  }

	function name(){
		global $config;

		return $config['theme']['default'];
	}

	function url(){
		return base_url."/themes/".$this->name()."/";
	}

	function base(){
		return base_root."/themes/".$this->name()."/";
	}

	// function template($template, $module){
	// 	$theme = $this->name();
	// 	$default = base_root."/modules/".$module."/".$template;
	// 	$file_template = base_root."/themes/".$theme."/templates/".$template;
	// 	if(is_file($file_template)){
	// 		return $file_template;
	// 	} else {
	// 		return $default;
	// 	}
	// }
	
	function start() {
		ob_start();
	}
	
	function clean() {
		ob_end_clean(); 
	}
	
	function close() {
		$content = ob_get_contents();
		ob_end_clean();
		return $content; 
	}

	function template($path_to_include){
		$modules = $this->module->set();

		$file_default = base_root.'/modules/'.$modules.'/'.$path_to_include;
		$file_template = $this->base().'modules/'.$modules.'/'.$path_to_include;

		if(file_exists($file_template)){
			$path_to_include = 'themes/'.$this->name().'/modules/'.$modules.'/'.$path_to_include;
		} elseif(file_exists($file_default)){
			$path_to_include = 'modules/'.$modules.'/'.$path_to_include;
		} else {

		}
		//die($path_to_include);

	  	return $path_to_include;
	}

	function set($state="frontend"){
		global $config;

		$theme = $this->name();
		if(empty($theme)){
			$theme = $config['theme'][$state];
		}
		return $theme;
	}
	
}

$theme = new theme();
?>