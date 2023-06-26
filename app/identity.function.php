<?php
	$directory_function  = opendir("app/function");
	while (false !== ($fileFunction = readdir($directory_function))) {
		if(preg_match("/.php/", $fileFunction)){
			$fileFunction = base_root."/app/function/" . $fileFunction;
			if(is_file($fileFunction)){
				include_once $fileFunction;
			}
		}
	}

	foreach ($config['module']['list'] as $key => $value) {
		$fileFunction = base_root."/modules/".$value."/controller/function.php";
		if(is_file($fileFunction)){
			include_once $fileFunction;
		}
	}
?>
