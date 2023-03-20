<?php
if( $switch==$switch_add || $switch==$switch_edit
	|| $switch=="add" || $switch=="edit") {

	include "include/formSet.php";

	if ($_POST['submit']) {

		include "include/formValidation.php";

		if($_POST['account']=="" || $_POST['account']==0){
			$error[] = $form->formAlert("custom_required", "Account");
		}

		if (!count($error)==0 ) {
			echo errorList($error);
		}else {

			if($switch==$switch_edit){
				include "include/formSave.php";
			} else {

				$url = $_POST['url'];
				$explode_url = explode(",", $url);

				foreach($explode_url as $key => $value) {
					$each_url = str_replace(" ", "", $value);

					if($each_url!=""){
						$cek_url = $db->row("url", $table, "WHERE url='".$each_url."' AND account='".$_POST['account']."' ");
						if ($cek_url>=1){
							error("Error Add ".$each_url);
						} else {
							$query_set = "url='".$each_url."', ";
							$query_set .= "account='".$_POST['account']."', ";
							$query_set .= "status='0' ";
							$query_add = "INSERT INTO $table SET
							".$query_set.",
							date_create = '".date("Y-m-d H:i:s")."' ";
							$db->execute($query_add);

							success("Sucess Add ".$each_url);
						}
					}
				}
				extract(unsetPost($_POST));
			}
		}
	}

} else {

}

$form->formTitle($title_page);

$form->formOpen("", "form_action");

$form->formHidden("id", $id);

$form->groupOptionTable("Account", "account", $account, "id, name", $table2, "WHERE status=1 ORDER BY name ASC", "id", "name", "-Select Account-");

if($switch=="edit"){
	$form->groupText("Url", "url", $url);
} else {
	$help = '<small>Pisah url dengan tanda koma</small>';
	$form->groupTextarea("Url $help", "url", $url);
}

$form->groupOptionStatus("Status", "status", $status); //Status

$form->groupSubmit("", "submit", "Save", $url_back);

$form->formClose();
?>
