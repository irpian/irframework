<?php

if($is_backend){
	if(in_array($alias, $list_module)){
		include "modules/".$alias."/backend/route.php";
	}else{
		include "modules/home/backend/route.php";
	}
} else {
	if(in_array($alias, $list_module)){
		include "modules/".$alias."/route.php";
	}else{
		include "modules/home/route.php";
	}
}
?>
