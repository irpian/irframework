<?php
	foreach ($module['list'] as $key => $value) {
		$fileFunction = base_root."/modules/".$value."/controller/function.php";
		if(is_file($fileFunction)){
			include_once $fileFunction;
		}
	}
?>
