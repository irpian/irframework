<?php
class theme {

	function name(){
		return config("theme");
	}

	function url(){
		return base_url."/themes/".$this->name();
	}

	function base(){
		return base_root."/themes/".$this->name();
	}

	function template($template, $module){
		$theme = $this->name();
		$default = base_root."/modules/".$module."/".$template;
		$file_template = base_root."/themes/".$theme."/templates/".$template;
		if(is_file($file_template)){
			return $file_template;
		} else {
			return $default;
		}
	}
	
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
	
}

$theme = new theme();
?>