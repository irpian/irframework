<?php
if ($_POST['submit']) {
	
	if(!empty($validation)){
		include_once "admin/include/formValidation.php";
	}

	if (!count($error)==0 ) {
		extract($_POST);
		$alert = errorList($error);
	} else {
		include_once "include/module.action.save.php";
		$alert =  success($alert_success_message);
	}
}
?>