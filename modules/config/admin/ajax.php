<?php
error_reporting(0);
include "../../../config.php";
include "../../../include/system/db.php";
include "../../../include/class.form.php";

  $select=$_GET["select"];
  if ($select==""){ 	
		echo "Type input mohon diisi"; 
  } else { 
	if($select==2){
		$form->formTextarea("value", $value, 'class="form-control"'); //text
	}elseif($select==3){
		$array_option = array(1=>"Yes", 0=>"No");
		$form->formOption("value", $value, $array_option, $extra);
	}else{
		$form->formText("value", $value);
	}
  }
?>
