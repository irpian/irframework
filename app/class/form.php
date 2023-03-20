<?php
class form {

	var $defaut_class_form 	= 'class="form-horizontal"';
	var $defaut_class_default 	= 'class="form-control"';
	var $defaut_class_text 	= 'class="form-control"';
	var $defaut_class_textarea 	= 'class="form-control"';
	var $defaut_class_option 	= 'class="form-control"';
	var $defaut_class_file 		= 'class="form-control"';
	var $defaut_class_submit 	= 'class="btn btn-primary"';
	var $defaut_class_back 	= 'class="btn btn-info"';

	function formTitle($title){
		echo '<h2 class="content-row-title">'.$title.'</h2>';
	}

	function formOpen($action, $name, $metode="post", $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_form);
		?>
		<form action="<?php echo $action; ?>" method="<?php echo $metode; ?>" enctype="multipart/form-data" role="form" <?php echo $extra; ?> name="<?php echo $name; ?>">
		<?php
	}

	function formClose(){
		echo "</form>";
	}

	function cekExtra($extra, $default_class){
		if(preg_match("/class/", $extra)){
			$set_extra = str_replace('class="'.$default_class,'', $extra);
		}else{
			$set_extra = $default_class.' '.$extra;
		}
		return $set_extra;
	}

	function formAlert($name, $atribute){
		//input
		$alert = array(
		"custom_required" 		=> "$atribute required",
		"custom_integer" 		=> "$atribute is integer",
		"name_required" 		=> "name $atribute required",
		"title_required" 		=> "tittle $atribute required",
		"text_required" 		=> "teks $atribute required",
		"description_required" 		=> "$atribute description required",
		"link_required" 			=> "link $atribute required",
		"user_required" 		=> "user $atribute required",
		"password_required" 		=> "password $atribute required",
		"password_repeat_required"	=> "repeat password $atribute required",
		"password_not_same" 	=> "password $atribute not same",
		"password_old_required" 	=> "new password $atribute required",
		"password_new_required" 	=> "old password $atribute required",
		"password_old_false"	 	=> "old password by $atribute false",
		"status_required" 		=> "status required",
		"price_required" 		=> "price $atribute is integer",
		"discount_required" 		=> "diskon $atribute is integer",
		"limit_required" 		=> "limit $atribute is integer",
		"email_required" 		=> "email required",
		"directori_required" 		=> "directory $atribute required", //tema
		"inisial_required" 		=> "initial required",
		"script_required" 		=> "scripts required",
		"code_required" 		=> "code $atribute required",
		"category_required" 		=> "category required",
		"category_sub_required" 	=> "sub category required",
		"file_required" 			=> "fle $atribute required",
		"page_required" 		=> "page required",
		"image_type_jpg" 		=> "please insert .jpg image",
		"image_type_png" 		=> "please insert .png image",

		//cek
		"custom_ready" 		=> "$atribute ready",
		"data_ready" 			=> "data has ready",
		"name_ready" 			=> "name $atribute has ready, use other name",
		"title_ready" 			=> "title $atribute has ready, use other name",
		"user_ready" 			=> "$atribute has ready, use other user name",
		"email_ready" 			=> "email $atribute has ready, use other user email",
		"url_ready" 			=> "url $atribute has ready, use other url",

		// validate
		"email_validate" 		=> "email $atribute false",
		"integer_validate" 		=> "value $atribute not integer",
		"min_char_validate" 		=> "char for $atribute above minimum limit",
		"max_char_validate" 		=> "char for $atribute more than maximum limit",
		"date_validate" 		=> "date $atribute not validate",
		"time_validate" 		=> "time $atribute not validate",
		);

		return ucwords($alert[$name]);
	}

	function textEditor(){
		//echo '<script src="'.base_admin.'/assets/js/jquery.min.js" type="text/javascript">';
		echo '<script src="'.base_admin.'/include/tinymce/tinymce.min.js" type="text/javascript"></script>';
	}

	function inputText($name, $value, $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_text);
		?><input type="text" name="<?php echo $name; ?>" size="60" value="<?php echo $value; ?>" <?php echo $extra; ?> /><?php
	}

	function inputTextArea($name, $value, $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_textarea);
		?>
		<textarea name="<?php echo $name; ?>" cols="20" rows="3" <?php echo $extra; ?>><?php echo $value; ?></textarea>
		<?php
	}

	function inputFile($name, $value, $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_file);
		?><input type="file" name="<?php echo $name; ?>" size="60" value="<?php echo $value; ?>" <?php echo $extra; ?> /><?php
	}

	function inputOption($name, $value, $array, $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_option);
		?>
		<select name="<?php echo $name; ?>" <?php echo $extra; ?>>
		<?php
		foreach($array as $key=>$data){
			if ($key==$value) {
				$cek="selected";
			}
			else {
				$cek="";
			}
			echo "<option value='$key' $cek>$data</option>";
		}
		?>
		</select>
	<?php }

	function inputOptionTable($name, $value, $select, $table, $where, $primary, $field_name, $label, $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_option);
		?>
		<select name="<?php echo $name; ?>" <?php echo $extra; ?>>
		<option value="0"><?php echo $label; ?></option>
		<?php
		global $db;
		$array = $db->all($select, $table, $where);
		foreach($array as $key=>$data){
			if ($data[$primary]==$value) {
				$cek="selected";
			}
			else {
				$cek="";
			}
			echo "<option value='$data[$primary]' $cek>$data[$field_name]</option>";
		}
		?>
	  </select>
	<?php
	}

	function inputOptionStatus($name, $value, $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_option);
		?>
		<select name="<?php echo $name; ?>" <?php echo $extra; ?>>
			<option value="1" <?php if ($value=="1"){ echo "selected='selected'"; } ?> > Active </option>
			<option value="0" <?php if ($value=="0"){ echo "selected='selected'"; } ?> > Non Active </option>
		</select>
		<?php
	}

	function inputHidden($name, $value, $extra=""){
		?><input type="hidden" name="<?php echo $name; ?>" size="60" value="<?php echo $value; ?>" <?php echo $extra; ?> /><?php
	}

	function inputPassword($name, $value, $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_textarea);
		?><input type="password" name="<?php echo $name; ?>" size="60" value="<?php echo $value; ?>" <?php echo $extra; ?> /><?php
	}

	function inputSubmit($name, $value, $extra=""){
		$extra = $this->cekExtra($extra, $this->defaut_class_submit);
		?><input name="<?php echo $name; ?>" type="submit" <?php echo $extra; ?> value="<?php echo $value; ?>"><?php
	}

	function inputImage($image, $directory){
		if ($image)
		{
			echo '<img src="'.$directory.$image.'" class="img-responsive img-thumbnail">';
		}
	}

	function inputDeleteFile($name, $module, $nid, $page){
		$alert = "Apakah Anda benar-benar ingin mengHapus File ";
		$url = "";
		$url .= base_admin."/".$module."/delete-file/id/".$nid;
		if($page!=""){
			$url .= "/page/".$page;
		}
		?>
			<a onclick="return confirm('<?php echo $alert.$name; ?>')" href="<?php echo $url; ?>" class="btn btn-danger pull-right media"> Delete File </a>
		<?php
	}

	function inputName($title, $size=10, $size_label=2){
		echo '<div class="form-group"><label class="col-md-'.$size_label.' control-label">'.$title.'</label><div class="col-md-'.$size.'">';
	}

	function inputGrupClose(){
		echo "</div></div>";
		echo '<div class="clear"></div>';
	}

	function inputBack($url){
		if($url<>""){
			echo '<a class="btn btn-default pull-right" href="'.$url.'">Back</a>';
		}
	}

	/* Form Default Group */
	function groupText($title, $name, $value, $size=6, $size_label=2, $extra=""){
		$this->inputName($title, $size, $size_label);
		$this->inputText($name, $value, $extra); //name
		$this->inputGrupClose();
	}

	function groupTextarea($title, $name, $value, $size=6, $size_label=2, $extra=""){
		$this->inputName($title, $size, $size_label);
		$this->inputTextarea($name, $value, $extra);
		$this->inputGrupClose();
	}

	function groupFile($title, $name="file", $value, $size=3, $size_label=2, $extra=""){
		$this->inputName($title, $size, $size_label);
		$this->inputFile($name, $value, $extra);
		$this->inputHidden($name."_hidden", $value);
		$this->inputGrupClose();
	}

	function groupImage($title, $value, $module, $directory_url, $id, $page, $size=3, $size_label=2, $extra=""){
		$this->inputName("", $size, $size_label);
		$this->inputImage($value, $directory_url);
		$this->inputDeleteFile($title, $module, $id, $page);
		$this->inputGrupClose();
	}

	function groupOptionTable($title, $name, $value, $select, $table, $where, $primary, $field_name, $label, $size=3, $size_label=2, $extra=""){
		$this->inputName($title, $size, $size_label);
		$this->inputOptionTable($name, $value, $select, $table, $where, $primary, $field_name, $label, $extra);
		$this->inputGrupClose();
	}

	function groupOption($title, $name, $value, $array_option, $size=3, $size_label=2, $extra=""){
		$this->inputName($title, $size, $size_label);
		$this->inputOption($name, $value, $array_option, $extra);
		$this->inputGrupClose();
	}

	function groupOptionStatus($title, $name="status", $value, $size=3, $size_label=2, $extra=""){
		$this->inputName($title, $size, $size_label);
		$this->inputOptionStatus($name, $value, $extra); //Status
		$this->inputGrupClose();
	}

	function groupSubmit($title, $name, $value, $url_back, $size=10, $size_label=2, $extra=""){
		$this->inputName($title, $size, $size_label);
		$this->inputSubmit($name, $value, $extra);
		$this->inputBack($url_back);
		$this->inputGrupClose();
	}
}

$form = new form();
?>
