<?php
    $directory_config  = opendir("app/config");
    while (false !== ($fileConfig = readdir($directory_config))) {
        if(preg_match("/.php/", $fileConfig)){
            $fileConfig = base_root."/app/config/" . $fileConfig;
            if(is_file($fileConfig)){
                include_once $fileConfig;
            }
        }
    }

	foreach ($config['module']['list'] as $key => $value) {
        
		$fileConfig = base_root."/modules/".$value."/controller/config.php";
		if(is_file($fileConfig)){
			include_once $fileConfig;
		}
	}
?>
