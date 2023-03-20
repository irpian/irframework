<?php
$title 		= "Logo Website";
$primary 	= "inisial";
$get 		= "logo";
$id		= "logo";

$field_file 	= "value";
$directory_file	= base_root."/images/";
$directory_url 	= base_url."/images/";
$url_back	= base_admin."/".$module;
//$type_upload 	= 1;

$data = getDetail($select, $table, $primary, $get);
$inisial	= $data['inisial'];	
$image	= $data['value'];

if($switch=="delete-file"){
	deleteFile($directory_file."/".$image);
	$db->execute("UPDATE $table SET $field_file = '' WHERE {$primary} = '".$id."'");
	success("Sucess Delete ".$title);
	$image = "";

}

if ($_POST['submit']) {	
	if (trim($_FILES['image']['name'])=="") {
		$error[] = $form->formAlert("file_required", $title);
	}
	
	if (!count($error)==0 ) {
		errorList($error);
	}else {
		include "include/formUpload.php";
		$image = $file_name;

		$qryUpdate = "UPDATE $table SET
				$field_file = '$file_name'
				WHERE {$primary} = '".$id."'";
		$db->execute($qryUpdate);
		success("Sucess Edit ".$title);
	}
}
?>
<h2 class="content-row-title"><?php echo $title; ?></h2>
<?php
$form->textEditor();
$form->formOpen(base_admin."/config/".$id, "form1");

if(($image<>"" || $file_name<>"")){
	$form->formName("",3);
	$form->formImage($image, $directory_url);
	$form->formDeleteFile($title, $module, $inisial, "");
	$form->formGrupClose();
}

$form->formName("Image",3);
$form->formFile("image", $image);
$form->formHidden("image_hidden", $image);
$form->formGrupClose();

$form->formName("");
$form->formSubmit("submit", "Save");
$form->formBack($url_back);
$form->formGrupClose();

$form->formClose();
?>
<div class="clear"></div>