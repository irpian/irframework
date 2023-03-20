<?php
foreach ($list_module as $key => $value) {
	$file_function = base_root."/modules/".$value."/controller/services.php";
	if(is_file($file_function)){
		include_once $file_function;
	}
}
?>
