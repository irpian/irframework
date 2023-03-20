<?php
if(preg_match("/add/", $switch)){
	$atribute_title_page = "Add ";
} else {
	$atribute_title_page = "Edit ";
}

if(preg_match("/admin/", $switch)){
	$position = 1;
	$title_page = $atribute_title_page."Menu Admin".$parent_menu;
	$url_back = base_admin."/".$module."/menu/select/admin";
} else {
	$position = 0;
	$title_page = $atribute_title_page."Menu".$parent_menu;
	$url_back = base_admin."/".$module."/menu/select/public";
}

if($switch=="add-menu" || $switch=="add-menu-admin"){
	include "include/formPost.php";
	$module ="";

}elseif($switch=="edit-menu" || $switch=="edit-menu-admin"){
	$data = getDetail($select, $table, $primary, $_GET['id']);
	extract($data);
}else{
	echo "Url Not Registered";
}

if($switch=="edit-menu-admin" || $switch=="add-menu-admin") {
	$where_menu = "WHERE status=1 AND $child_parent=0 AND $field_group=1 ORDER BY name ASC";
}else{
	$where_menu = "WHERE status=1 AND $child_parent=0 AND $field_group=0 ORDER BY name ASC";
}

if ($_POST['submit']) {	
	if (trim($_POST['name'])=="") { 
		$pesan[] = $form->formAlert("name_required", $title_page);
	}

	if($field_ready_cek){
		if($switch=="add-menu" || $switch=="add-menu-admin") {
			$cek = $db->row($field_ready_cek, $table, "WHERE $field_ready_cek='".strtolower($_POST['name'])."' AND $field_group='".$position."' ");
			if ($cek==1){ 	
				$pesan[] = $form->formAlert("name_ready", "");
			}
		}
	}
	
	if (!count($pesan)==0 ) {
		errorList($pesan);
	}else {
		$_POST['position'] = $position;
		
		if($switch=="add-menu" || $switch=="add-menu-admin") {
			
			$query_set = setQuery($_POST, defaultUnsetQuery($unset_query_add));
			$qryAdd = "INSERT INTO $table SET
					".$query_set.",
					date_create = '".date("Y-m-d H:i:s")."'";
			$db->execute($qryAdd);
			success("Sucess Add ".$title_page);
			extract(unsetPost($_POST));
			
		}elseif($switch=="edit-menu" || $switch=="edit-menu-admin") {

			$query_set = setQuery($_POST, defaultUnsetQuery($unset_query_update));
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

foreach ($list_module as $value) {
	$list_module[] = $value;
}
?>

<h2 class="content-row-title"><?php echo $title_page; ?></h2>

<?php
$form->textEditor();
$form->formOpen("", "form1");
if($switch=="edit-menu" || $switch=="edit-menu-admin"){
	$form->formHidden("id", $id);
}
$form->formName("Nama $title",6);
$form->formText("name", $name); //name
$form->formGrupClose();

$form->formName("Module",3);
?>
<select name="module" class="form-control">
	<option value="">Select Module</option>
	<?php
	foreach($list_module as $data){
		if ($module==$data) {
			$cek="selected";
		}
		else {
			$cek="";
		}
		echo "<option value='$data' $cek>".name($data)."</option>";
	}
	?>
</select>
<?php
$form->formGrupClose();
	
$form->formName("Parent",3);
$extra = 'class="form-control input-menu-parent"';
$label = "- Parent Menu -";
$form->formOptionTable("parent", $parent, "*", "menu", $where_menu, "id", "name", $label, $extra);
$form->formGrupClose();

$form->formName("Url Menu",6);
$form->formText("url", $url);
$form->formGrupClose();

$form->formName("Status",3);
$form->formOptionStatus("status", $status); //Status
$form->formGrupClose();

if($switch=="edit-menu-admin" || $switch=="add-menu-admin") {
	$form->formName("Icon",8);
	$array_icon = listIcon();
	?>
	<label class="col-md-2">
	  <input name="icon" type="radio" value="" class="" checked="checked" style="margin:8px;"/>
	  No Icon 
	</label>
	<?php foreach($array_icon as $value){
		$checkRadio = "";
		if($value==$icon){
			$checkRadio = 'checked="checked"';
		}
		echo '<label class="col-md-2 input-menu-icon">
			<input name="icon" type="radio" value="'.$value.'" style="margin:8px;" class="" '.$checkRadio.'/>
			<span class="'.$value.'"></span>
		</label>';
	}
	$form->formGrupClose();
}

$form->formName("");
$form->formSubmit("submit", "Save");
$form->formBack($url_back);
$form->formGrupClose();

$form->formClose();
?>
