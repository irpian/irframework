<?php
if($_GET['switch']=="add"){
	$title_page = $title_add;
	include "include/formPost.php";

}elseif($_GET['switch']=="edit"){
	$title_page = $title_edit;
	$data = getDetail($select, $table, $primary, $_GET['id']);
	extract($data);

	if($web_config=="1"){
		$url_back		= defaultBackUrl($url_back, $module, "web", $page);
	} else {
		$url_back		= defaultBackUrl($url_back, $module, $switch_list, $page);
	}
	
}else{
	echo "Url Not Registerd";
}

if ($_POST['submit']) {	
	if (trim($_POST['name'])=="") { 
		$error[] = $form->formAlert("name_required", $title_module); 
	}

	if (trim($_POST['inisial'])=="") { 
		$error[] = $form->formAlert("inisial_required", $title_module); 
	}

	if($field_ready_cek){
		if($switch=="add") {
			$cek = $db->row($field_ready_cek, $table, "WHERE $field_ready_cek='".strtolower($_POST['inisial'])."'");
			if ($cek==1){ 	
				$error[] = $form->formAlert("data_ready", "");
			}
		} else {}
	}
	
	if (!count($error)==0 ) {
		errorList($error);
	}else {
		//save
		
		if($switch=="add") {
			$query_set = setQuery($_POST, defaultUnsetQuery($unset_query_add));
			$query_add = "INSERT INTO $table SET
					".$query_set.",
					date_create = '".date("Y-m-d H:i:s")."' ";
			$db->execute($query_add);
			success("Sucess Add ".$title_module);
			extract(unsetPost($_POST));

		}elseif($switch=="edit") {
			$query_set = setQuery($_POST, $unset_query_update);
			$query_update = "UPDATE $table SET
					".$query_set."
					WHERE {$primary} = '".$id."'";
			$db->execute($query_update);
			success("Sucess Edit ".$title_module);
			extract($_POST);

		}else{
			failed("No Action");
		}
	}
}
?>

<?php 
$form->formTitle($title_page);
 ?>

<script src="<?php echo base_admin;?>/assets/js/ajax.js" type="text/javascript"></script>
<script type="text/javascript">
function getAjaxDataForm(base, target)
{
   var input = document.getElementById("select");
   var data = input.value;
   var url = base + "?select=" + data;
   getAjaxData(url, target);
}
</script>
<?php
$form->textEditor();
$form->formOpen("", "form1");
if($switch=="edit"){
	$form->formHidden("id", $id);
}else{
	//$form->formHidden("id", $id);
}
$form->formName("Name $title_module",6);
$form->formText("name", $name); //name
$form->formGrupClose();

$form->formName("Inisial $title_module",3);
$form->formText("inisial", $inisial);
$form->formGrupClose();

if(($switch=="edit" || $_POST['submit']) && $type<>"") { 
	$form->formHidden("type", $type);
}else{
	$form->formName("Type Input",3);
	$extra = 'id="select" onchange="getAjaxDataForm(\''.base_url.'/modules/'.$module.'/admin/ajax.php\', \'type\');"';
	$array_option_type = array(1=>"text", 2=>"textarea", 3=>"option");
	$form->formOption("type", $type, $array_option_type, $extra);
	$form->formGrupClose();
}

$form->formName("Value",3);
if(($switch=="edit" || $_POST['submit']) && $type<>"") {
	echo '<div id="type">';
	if($type==2){
		$form->formTextarea("value", $value,'class="form-control"'); //text
	}elseif($type==3){
		$array_option_value = array(1=>"Yes", 0=>"No");
		$form->formOption("value", $value, $array_option_value, $extra);
	}else{
		$form->formText("value", $value);
	}
	echo '</div>';
} else {
	echo '<div id="type">
		<input name="value" size="60" value="" class="form-control" type="text">
	</div>';
}
$form->formGrupClose();

if(($switch=="edit" || $_POST['submit']) && $web_config<>"") {
	$form->formHidden("web_config", $web_config);
} else {
	$form->formName("Web Content",3);
	$array_option = array(1=>"Yes", 0=>"No");
	$form->formOption("web_config", $web_config, $array_option);
	$form->formGrupClose();
}

$form->formName("Status",3);
$form->formOptionStatus("status", $status); //Status
$form->formGrupClose();

$form->formName("");
$form->formSubmit("submit", "Save");
$form->formBack($url_back);
$form->formGrupClose();

$form->formClose();
?>
<div class="clear"></div>