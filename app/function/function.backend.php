<?php
function titleMainPage($title){
	if (!empty($title)){
		$title = $title;
	}else{
		$title = "home";
	}
	return ucwords($title);
}

function delete($status, $module, $table, $primary, $id, $field_file, $directory_file, $page){
	//status
	//status1 = data 		| hanya data
	//status2 = data-file 		| data & gambar / file
	//status3 = data-files		| data , gambar & thumnail
	//status4 = child		| kategory & subcategory
	//status5 = file 		| hanya gambar / file
	//status6 = files 		| hanya gambar & thumbnail

	global $db;

	if(!is_numeric($page)){
		$back_url 	= "<meta http-equiv='refresh' content='0; url=".$page."'>";
		$back_page 	= "<meta http-equiv='refresh' content='0; url=".$page."'>";
		$back_edit 	= "<meta http-equiv='refresh' content='0; url=".$page."'>";
	}else{
		$back_url 	= "<meta http-equiv='refresh' content='0; url=".base_admin."/$module/list'>";
		$back_page 	= "<meta http-equiv='refresh' content='0; url=".base_admin."/$module/list/page/".$page."'>";
		$back_edit 	= "<meta http-equiv='refresh' content='0; url=".base_admin."/$module/edit/".$id."/page/".$page."'>";
	}

	if($status!=""){

		if($status=="data-file" or $status=="data-files" or $status=="file" or $status=="files" ){
			$data = $db->value($field_file, $table, "WHERE {$primary}='".$id."'");
			$data_image = $data;
			if($data_image!=""){
				unlink("$directory_file/$data_image");

				if ($status=="file" or $status=="files"){
					$db->update($table, "$field_file=''", "WHERE {$primary}='".$id."'");
				}

				if ($status=="data-files" or $status=="files"){
					unlink("$directory_file/thumbnail/$data_image");
				}
			}
		}

		if($status=="file" or $status=="files"){

		} else {
			$db->execute("DELETE FROM {$table} WHERE {$primary}='".$id."'");
		}

		if($status=="child"){
			$child_table = $field_file;
			$parent_field = $directory_file;
			$db->execute("DELETE FROM $child_table WHERE $parent_field='".$id."'");
		}

		if($status=="file" or $status=="files"){
			echo $back_edit;
		} else {
			//echo "Data Telah Dihapus<br>";
			$row = $db->row($primary, $table, "ORDER BY {$primary}");
			if($row==0){
				echo $back_url;
			} else {
				echo $back_page;
			}
		}

	}
}

function deleteFile($file){
	unlink($file);
}

//switch
function defaultSwitchAdd($add){
	if($add!=""){
		$switch_add = $add;
	} else {
		$switch_add = "add";
	}
	return $switch_add;
}

function defaultSwitchEdit($edit){
	if($edit!=""){
		$switch_edit = $edit;
	} else {
		$switch_edit = "edit";
	}
	return $switch_edit;
}

function defaultSwitchList($list){
	if($list!=""){
		$switch_list = $list;
	} else {
		$switch_list = "list";
	}
	return $switch_list;
}

//menu
function action($type, $module, $nid, $page, $status){
	//edit 	= 1
	//delete= 2
	//status= 3
	//detail = 4
	//back 	= 5
	if($type=="edit"){ ?>
		<a href="<?php echo base_admin.'/'.$module.'/edit/'.$nid.'/page/'.$page; ?>" title="Edit" class="btn btn-warning">
			<i class="glyphicon glyphicon-pencil"></i>
		</a>
	<?php } elseif($type=="delete"){ ?>
		<a href="<?php echo base_admin.'/'.$module.'/delete/'.$nid.'/page/'.$page; ?>"
		onclick="return confirm('Apakah Anda benar-benar ingin mengHapus data ini')" title="Delete" class="btn btn-danger">
			<i class="glyphicon glyphicon-remove"></i>
		</a>
	<?php }elseif($type=="status"){ ?>
		<?php if($status=="1"){ ?>
			<a href="<?php echo base_admin."/".$module."/status/0/id/".$nid.""; ?>/page/<?php echo $page; ?>" title="Active" class="btn btn-success">
				<i class="glyphicon glyphicon-eye-open"></i>
			</a>
		<?php } else { ?>
			<a href="<?php echo base_admin."/".$module."/status/1/id/".$nid.""; ?>/page/<?php echo $page; ?>"title="Non Active" class="btn btn-normal">
				<i class="glyphicon glyphicon-eye-open"></i>
			</a>
		<?php } ?>
	<?php }elseif($type=="detail"){ ?>
		<a href="<?php echo base_admin.'/'.$module.'/detail/'.$nid.'/page/'.$page; ?>" title="Detail" class="btn btn-primary">
			<i class="glyphicon glyphicon-file"></i>
		</a>
	<?php } elseif($type=="back"){ ?>
		<a href="<?php echo base_admin.'/'.$module.'/page/'.$page; ?>" title="Back" class="btn btn-info">
			<i class="glyphicon glyphicon-arrow-left"></i>
		</a>
	<?php } else { }
}

function menuAdmin($parent=0, $uri=""){
	global $db;
	$array_menu = $db->all("*", "menu", "WHERE parent='".$parent."' AND position=1 AND status=1  ORDER BY orderby ASC");
	?>
	<ul class="list-group panel">
	<?php
	foreach($array_menu as $key=>$data){
		$count_child = $db->row("*", "menu", "WHERE parent='".$data['id']."' AND position=1 AND status=1");
		if($count_child==0){ ?>
			<li class="list-group-item"><a href="<?php echo base_admin."/".$data['url']; ?>">
			<i class="<?php echo $data['icon']; ?>"></i><?php echo name($data['name']); ?></a>
			</li>
		<?php }else{
			if($uri==$data['url']){
				$colapse = "colapse in";
			} else {
				$colapse = "";
			}
			?>
			<li>
				<a href="#menu<?php echo $data['id']; ?>" class="list-group-item <?php echo $colapse; ?>" data-toggle="collapse">
				<i class="<?php echo $data['icon']; ?>"></i>
				<?php echo name($data['name']); ?>
				<span class="glyphicon glyphicon-chevron-right"></span></a>
			</li>
			<li style="" class="collapse <?php echo $colapse; ?>" id="menu<?php echo $data['id']; ?>">
				<?php
				 $array_sub_menu = $db->all("*", "menu", "WHERE parent='".$data['id']."' AND position=1 AND status=1 ORDER BY orderby ASC");
				 foreach($array_sub_menu as $key=>$data){ ?>
				 <a href="<?php echo base_admin."/".$data['url']; ?>" class="list-group-item"><?php echo name($data['name']); ?></a>
				 <?php } ?>
			</li>
		<?php
		}
	} ?>
	</ul>
	<?php
}

function addDataButton($module, $url, $title){
	echo '<a href="'.base_admin."/".$module."/".$url.'" title="Add Data" class="btn btn-primary button-add">
		<i class="glyphicon glyphicon-plus"></i>
		'.$title.'
		</a>
		<div class="clear"></div>';
}

function urlPagingAdmin($module){
	global $_GET;
	$get = array_keys($_GET);
	$url_combine = "";
	foreach($get as $data){
		if($data=="switch"){
			$url_combine .= $_GET[$data]."/";
		}elseif($data<>"page" && $data<>"action"){
			$url_combine .= $data."/".$_GET[$data]."/";
		}else{

		}
	}
	return "admin/".$module."/".$url_combine."page";
}

function defaultBackUrl($back, $module, $switch_list, $page){
	$switch_list = defaultSwitchList($switch_list);
	if($back!=""){
		$back = $back;
	} else {
		$back = base_admin."/".$module."/".$switch_list."/page/".$page;
	}
	return $back;
}

function listSubPanel($module, $title, $table, $row_parent, $id, $row_id, $row_name, $row_status, $orderby, $array_action, $page){
	global $db;
	$cek = $db->row($row_parent, $table, "WHERE $row_parent='".$id."'");
	if($cek > 0){
	?>
	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Sub <?php echo $title; ?> <span class="caret"></span></button>
		 <ul class="dropdown-menu dropdown-sub-pannel" role="menu">
			<?php
			$list = $db->all("$row_id, $row_name, $row_status", $table, "WHERE $row_parent='$id' ORDER BY $orderby ASC ");
			foreach($list as $key=>$data){
			?>
				  <li>
					<div class="sub-pannel">
						<?php echo $data[$row_name]; ?>
						<?php if(!empty($array_action)){ ?>
						<span class="group-action btn-group pull-right">
						<?php action("status", $array_action[2], $data[$row_id], $page, $data[$row_status]); ?>
						<?php action("edit", $array_action[0], $data[$row_id], $page, ""); ?>
						<?php action("delete", $array_action[1], $data[$row_id], $page, ""); ?>
						</span>
						<?php } ?>
					</div>
				   </li>
			<?php } ?>
		</ul>
	 </div>
	 <?php
	}
}

function sortingSet($select, $table, $where, $row_name, $id, $row_id, $row_orderby, $key){
	global $db;
	$array = $db->all($select, $table, $where);
	?>
	<input type="hidden" name="movefrom[]" value="<?php echo $key+1; ?>" />
	<input type="hidden" name="moveid[]" value="<?php echo $id; ?>" />
	<select name="moveto[]" class="form-control" id="orderby_<?php echo $key+1; ?>" onchange="document.form_list_sort.submit()">
		<option value="" selected="selected">Move</option>
		<option value="1">Move First</option>
			<?php
			$no = 2;
			$count_data = count($array);
			foreach($array as $key=>$data){
				if($no<=$count_data){
					echo "<option value='$no'>Move After $data[$row_name]</option>";
				}
				$no++;
			}

			$cek_orderby = $db->value($row_orderby, $table, "WHERE $row_id='".$id."'");
			if($cek_orderby[$row_orderby]==0){
				$db->update($table, "$row_orderby='".($no-2)."'", "WHERE $row_id='".$id."'");
			}
			?>
		<option value="<?php echo $no-2; ?>">Move Last</option>
	</select>
	<?php
}

function sorting($table, $where, $row_orderby, $row_id){
	global $db;
	global $_POST;
	$update = 0;
	foreach($_POST['moveto'] as $key=>$data){
		if($data<>"" && $_POST['movefrom'][$key]<>$_POST['moveto'][$key]){
			if($data > (count($_POST['movefrom'])) ){
				//berarti gak kemana-mana
				//echo "Tidak ada perubahan<br>";
			}elseif($_POST['movefrom'][$key] < $_POST['moveto'][$key]){
				$update = 1;
				$db->update($table, "$row_orderby=$row_orderby-1", "$where AND $row_orderby>'".$_POST['movefrom'][$key]."' AND $row_orderby<=$data ");
				//echo "Update sort di bawah urutan $data<br>";
			}elseif($_POST['movefrom'][$key] > $_POST['moveto'][$key]){
				$update = 1;
				$db->update($table, "$row_orderby=$row_orderby+1", "$where AND $row_orderby<'".$_POST['movefrom'][$key]."' AND $row_orderby>=$data");
				//echo "Update sort di atas urutan $data<br>";
			}else{
				//berarti gak kemana-mana
				//echo "Tidak ada perubahan<br>";
			}
			if($update==1){
				$db->update($table, "$row_orderby='".($data)."'", "$where AND $row_id='".$_POST['moveid'][$key]."'");
				//echo "Update sort dari ".$_POST['movefrom'][$key]." ke $data<br>";
			}
		}
	$update = 0;
	}

}

//content
function autoKeyword($website, $module, $title, $post){
	$title = ucwords($title);
	if($post==""){
			$keyword = "";
			$keyword .= $website.", ";
			$keyword .= $module." - ".$title.", ";
			$keyword .= date('d-m-Y');
	} else {
		$keyword = $post;
	}
	return $keyword;
}

function autoDescription($website, $module, $title, $post){
	$title = ucwords($title);
	if($post==""){
			$description = "";
			$description .= $website.", ";
			$description .= $module." - ".$title.", ";
			$description .= date('d-m-Y');
	} else {
		$description = $post;
	}
	return $description;
}

function listIcon(){
	$arrayIcon = array();
	$arrayIcon[] = "glyphicon glyphicon-asterisk";
	$arrayIcon[] = "glyphicon glyphicon-plus";
	$arrayIcon[] = "glyphicon glyphicon-euro";
	$arrayIcon[] = "glyphicon glyphicon-minus";
	$arrayIcon[] = "glyphicon glyphicon-cloud";
	$arrayIcon[] = "glyphicon glyphicon-envelope";
	$arrayIcon[] = "glyphicon glyphicon-pencil";
	$arrayIcon[] = "glyphicon glyphicon-glass";
	$arrayIcon[] = "glyphicon glyphicon-music";
	$arrayIcon[] = "glyphicon glyphicon-search";
	$arrayIcon[] = "glyphicon glyphicon-heart";
	$arrayIcon[] = "glyphicon glyphicon-star";
	$arrayIcon[] = "glyphicon glyphicon-star-empty";
	$arrayIcon[] = "glyphicon glyphicon-user";
	$arrayIcon[] = "glyphicon glyphicon-film";
	$arrayIcon[] = "glyphicon glyphicon-th-large";
	$arrayIcon[] = "glyphicon glyphicon-th";
	$arrayIcon[] = "glyphicon glyphicon-th-list";
	$arrayIcon[] = "glyphicon glyphicon-ok";
	$arrayIcon[] = "glyphicon glyphicon-remove";
	$arrayIcon[] = "glyphicon glyphicon-zoom-in";
	$arrayIcon[] = "glyphicon glyphicon-zoom-out";
	$arrayIcon[] = "glyphicon glyphicon-off";
	$arrayIcon[] = "glyphicon glyphicon-signal";
	$arrayIcon[] = "glyphicon glyphicon-cog";
	$arrayIcon[] = "glyphicon glyphicon-trash";
	$arrayIcon[] = "glyphicon glyphicon-home";
	$arrayIcon[] = "glyphicon glyphicon-file";
	$arrayIcon[] = "glyphicon glyphicon-time";
	$arrayIcon[] = "glyphicon glyphicon-road";
	$arrayIcon[] = "glyphicon glyphicon-download-alt";
	$arrayIcon[] = "glyphicon glyphicon-download";
	$arrayIcon[] = "glyphicon glyphicon-upload";
	$arrayIcon[] = "glyphicon glyphicon-inbox";
	$arrayIcon[] = "glyphicon glyphicon-play-circle";
	$arrayIcon[] = "glyphicon glyphicon-repeat";
	$arrayIcon[] = "glyphicon glyphicon-refresh";
	$arrayIcon[] = "glyphicon glyphicon-list-alt";
	$arrayIcon[] = "glyphicon glyphicon-lock";
	$arrayIcon[] = "glyphicon glyphicon-flag";
	$arrayIcon[] = "glyphicon glyphicon-headphones";
	$arrayIcon[] = "glyphicon glyphicon-volume-off";
	$arrayIcon[] = "glyphicon glyphicon-volume-down";
	$arrayIcon[] = "glyphicon glyphicon-volume-up";
	$arrayIcon[] = "glyphicon glyphicon-qrcode";
	$arrayIcon[] = "glyphicon glyphicon-barcode";
	$arrayIcon[] = "glyphicon glyphicon-tag";
	$arrayIcon[] = "glyphicon glyphicon-tags";
	$arrayIcon[] = "glyphicon glyphicon-book";
	$arrayIcon[] = "glyphicon glyphicon-bookmark";
	$arrayIcon[] = "glyphicon glyphicon-print";
	$arrayIcon[] = "glyphicon glyphicon-camera";
	$arrayIcon[] = "glyphicon glyphicon-font";
	$arrayIcon[] = "glyphicon glyphicon-bold";
	$arrayIcon[] = "glyphicon glyphicon-italic";
	$arrayIcon[] = "glyphicon glyphicon-text-height";
	$arrayIcon[] = "glyphicon glyphicon-text-width";
	$arrayIcon[] = "glyphicon glyphicon-align-left";
	$arrayIcon[] = "glyphicon glyphicon-align-center";
	$arrayIcon[] = "glyphicon glyphicon-align-right";
	$arrayIcon[] = "glyphicon glyphicon-align-justify";
	$arrayIcon[] = "glyphicon glyphicon-list";
	$arrayIcon[] = "glyphicon glyphicon-indent-left";
	$arrayIcon[] = "glyphicon glyphicon-indent-right";
	$arrayIcon[] = "glyphicon glyphicon-facetime-video";
	$arrayIcon[] = "glyphicon glyphicon-picture";
	$arrayIcon[] = "glyphicon glyphicon-map-marker";
	$arrayIcon[] = "glyphicon glyphicon-adjust";
	$arrayIcon[] = "glyphicon glyphicon-tint";
	$arrayIcon[] = "glyphicon glyphicon-edit";
	$arrayIcon[] = "glyphicon glyphicon-share";
	$arrayIcon[] = "glyphicon glyphicon-check";
	$arrayIcon[] = "glyphicon glyphicon-move";
	$arrayIcon[] = "glyphicon glyphicon-eject";
	$arrayIcon[] = "glyphicon glyphicon-chevron-left";
	$arrayIcon[] = "glyphicon glyphicon-chevron-right";
	$arrayIcon[] = "glyphicon glyphicon-plus-sign";
	$arrayIcon[] = "glyphicon glyphicon-minus-sign";
	$arrayIcon[] = "glyphicon glyphicon-remove-sign";
	$arrayIcon[] = "glyphicon glyphicon-ok-sign";
	$arrayIcon[] = "glyphicon glyphicon-question-sign";
	$arrayIcon[] = "glyphicon glyphicon-info-sign";
	$arrayIcon[] = "glyphicon glyphicon-screenshot";
	$arrayIcon[] = "glyphicon glyphicon-remove-circle";
	$arrayIcon[] = "glyphicon glyphicon-ok-circle";
	$arrayIcon[] = "glyphicon glyphicon-ban-circle";
	$arrayIcon[] = "glyphicon glyphicon-arrow-left";
	$arrayIcon[] = "glyphicon glyphicon-arrow-right";
	$arrayIcon[] = "glyphicon glyphicon-arrow-up";
	$arrayIcon[] = "glyphicon glyphicon-arrow-down";
	$arrayIcon[] = "glyphicon glyphicon-share-alt";
	$arrayIcon[] = "glyphicon glyphicon-resize-full";
	$arrayIcon[] = "glyphicon glyphicon-resize-small";
	$arrayIcon[] = "glyphicon glyphicon-exclamation-sign";
	$arrayIcon[] = "glyphicon glyphicon-gift";
	$arrayIcon[] = "glyphicon glyphicon-leaf";
	$arrayIcon[] = "glyphicon glyphicon-fire";
	$arrayIcon[] = "glyphicon glyphicon-eye-open";
	$arrayIcon[] = "glyphicon glyphicon-eye-close";
	$arrayIcon[] = "glyphicon glyphicon-warning-sign";
	$arrayIcon[] = "glyphicon glyphicon-plane";
	$arrayIcon[] = "glyphicon glyphicon-calendar";
	$arrayIcon[] = "glyphicon glyphicon-random";
	$arrayIcon[] = "glyphicon glyphicon-comment";
	$arrayIcon[] = "glyphicon glyphicon-magnet";
	$arrayIcon[] = "glyphicon glyphicon-chevron-up";
	$arrayIcon[] = "glyphicon glyphicon-chevron-down";
	$arrayIcon[] = "glyphicon glyphicon-retweet";
	$arrayIcon[] = "glyphicon glyphicon-shopping-cart";
	$arrayIcon[] = "glyphicon glyphicon-folder-close";
	$arrayIcon[] = "glyphicon glyphicon-folder-open";
	$arrayIcon[] = "glyphicon glyphicon-resize-vertical";
	$arrayIcon[] = "glyphicon glyphicon-resize-horizontal";
	$arrayIcon[] = "glyphicon glyphicon-hdd";
	$arrayIcon[] = "glyphicon glyphicon-bullhorn";
	$arrayIcon[] = "glyphicon glyphicon-bell";
	$arrayIcon[] = "glyphicon glyphicon-certificate";
	$arrayIcon[] = "glyphicon glyphicon-thumbs-up";
	$arrayIcon[] = "glyphicon glyphicon-thumbs-down";
	$arrayIcon[] = "glyphicon glyphicon-hand-right";
	$arrayIcon[] = "glyphicon glyphicon-hand-left";
	$arrayIcon[] = "glyphicon glyphicon-hand-up";
	$arrayIcon[] = "glyphicon glyphicon-hand-down";
	$arrayIcon[] = "glyphicon glyphicon-circle-arrow-right";
	$arrayIcon[] = "glyphicon glyphicon-circle-arrow-left";
	$arrayIcon[] = "glyphicon glyphicon-circle-arrow-up";
	$arrayIcon[] = "glyphicon glyphicon-circle-arrow-down";
	$arrayIcon[] = "glyphicon glyphicon-globe";
	$arrayIcon[] = "glyphicon glyphicon-wrench";
	$arrayIcon[] = "glyphicon glyphicon-tasks";
	$arrayIcon[] = "glyphicon glyphicon-filter";
	$arrayIcon[] = "glyphicon glyphicon-briefcase";
	$arrayIcon[] = "glyphicon glyphicon-fullscreen";
	$arrayIcon[] = "glyphicon glyphicon-dashboard";
	$arrayIcon[] = "glyphicon glyphicon-paperclip";
	$arrayIcon[] = "glyphicon glyphicon-heart-empty";
	$arrayIcon[] = "glyphicon glyphicon-link";
	$arrayIcon[] = "glyphicon glyphicon-phone";
	$arrayIcon[] = "glyphicon glyphicon-pushpin";
	$arrayIcon[] = "glyphicon glyphicon-usd";
	$arrayIcon[] = "glyphicon glyphicon-gbp";
	$arrayIcon[] = "glyphicon glyphicon-sort";
	$arrayIcon[] = "glyphicon glyphicon-sort-by-alphabet";
	$arrayIcon[] = "glyphicon glyphicon-sort-by-alphabet-alt";
	$arrayIcon[] = "glyphicon glyphicon-sort-by-order";
	$arrayIcon[] = "glyphicon glyphicon-sort-by-order-alt";
	$arrayIcon[] = "glyphicon glyphicon-sort-by-attributes";
	$arrayIcon[] = "glyphicon glyphicon-sort-by-attributes-alt";
	$arrayIcon[] = "glyphicon glyphicon-unchecked";
	$arrayIcon[] = "glyphicon glyphicon-expand";
	$arrayIcon[] = "glyphicon glyphicon-collapse-down";
	$arrayIcon[] = "glyphicon glyphicon-collapse-up";
	$arrayIcon[] = "glyphicon glyphicon-log-in";
	$arrayIcon[] = "glyphicon glyphicon-flash";
	$arrayIcon[] = "glyphicon glyphicon-log-out";
	$arrayIcon[] = "glyphicon glyphicon-new-window";
	$arrayIcon[] = "glyphicon glyphicon-record";
	$arrayIcon[] = "glyphicon glyphicon-save";
	$arrayIcon[] = "glyphicon glyphicon-open";
	$arrayIcon[] = "glyphicon glyphicon-saved";
	$arrayIcon[] = "glyphicon glyphicon-import";
	$arrayIcon[] = "glyphicon glyphicon-export";
	$arrayIcon[] = "glyphicon glyphicon-send";
	$arrayIcon[] = "glyphicon glyphicon-floppy-disk";
	$arrayIcon[] = "glyphicon glyphicon-floppy-saved";
	$arrayIcon[] = "glyphicon glyphicon-floppy-remove";
	$arrayIcon[] = "glyphicon glyphicon-floppy-save";
	$arrayIcon[] = "glyphicon glyphicon-floppy-open";
	$arrayIcon[] = "glyphicon glyphicon-credit-card";
	$arrayIcon[] = "glyphicon glyphicon-transfer";
	$arrayIcon[] = "glyphicon glyphicon-cutlery";
	$arrayIcon[] = "glyphicon glyphicon-header";
	$arrayIcon[] = "glyphicon glyphicon-compressed";
	$arrayIcon[] = "glyphicon glyphicon-earphone";
	$arrayIcon[] = "glyphicon glyphicon-phone-alt";
	$arrayIcon[] = "glyphicon glyphicon-tower";
	$arrayIcon[] = "glyphicon glyphicon-stats";
	$arrayIcon[] = "glyphicon glyphicon-copyright-mark";
	$arrayIcon[] = "glyphicon glyphicon-registration-mark";
	$arrayIcon[] = "glyphicon glyphicon-cloud-download";
	$arrayIcon[] = "glyphicon glyphicon-cloud-upload";
	$arrayIcon[] = "glyphicon glyphicon-tree-conifer";
	$arrayIcon[] = "glyphicon glyphicon-tree-deciduous";
	return $arrayIcon;
}


//module
function moduleList(){
	$dh  = opendir("../modules");
	$allow = array(".", "..", "Thumbs.db", "home", "config", "user");
	$modules[] = "home";
	$modules[] = "user";
	$modules[] = "config";

	while (false !== ($name_module = readdir($dh))) {
		if(in_array($name_module, $allow)){

		}elseif(preg_match("/\./", $name_module)){

		} else {
			$modules[] = $name_module;
		}
	}
	return $modules;
}

function moduleInsert($name){
	global $db;
	$cek = $db->row("id", "module", "WHERE name='$name' ");
	if($cek=="" || $cek==0){
		$insert  = "name='".$name."', ";
		$insert  .= "date_create='".date("Y-m-d H:i:s")."'";
		$db->insert("module", "", $insert);
	}
}

function themeList(){
	$theme = array();
	$dh  = opendir("../themes");
	while (false !== ($name_theme = readdir($dh))) {
		if($name_theme=="." || $name_theme==".." || $name_theme=="Thumbs.db"){
		}elseif(preg_match("/\./", $name_theme)){
		} else {
			$themes[] = $name_theme;
		}
	}
	return $themes;
}

function themeChange($selected_theme){
	global $db;
	$db->update("config", "value='".$selected_theme."'", "WHERE inisial='theme' ");
}

function sendEmailOld($penerima, $subject, $content){

	$site_name = config("site_name");
	$site_email = config("site_email");

	$header = "From: $site_email \n ";
	$header .= $site_name . "\r\n";
	$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	var_dump(mail($penerima, $subject, $content, $header));
	echo $header."---".$penerima."---".$subject."---".$content;
}

function sendEmail($penerima, $subject, $content){
	require_once base_root.'/include/PHPMailer/src/PHPMailer.php';
	//require_once base_root.'/include/PHPMailer/src/SMTP.php';

	$mail = new PHPMailer;
	// $mail->isSMTP();
	// $mail->SMTPDebug = 0;
	// $mail->SMTPSecure = 'ssl';
	// $mail->SMTPAuth = true;
	// $mail->Host = 'smtp.gmail.com';
	// $mail->Port = 465;
	// $mail->Username = "noreply@jejualan.com";
	// $mail->Password = "6kUAKxRoD89A5CoE";

	//Recipients
	$mail->setFrom(config("site_email"), 'System');
	$mail->addAddress($penerima, 'Admin');     //Add a recipient

	//Content
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body    = $content;

	if( $mail -> Send() ){
		return true;
	} else {
		return false;
	}

	$mail -> ClearAddresses();
}
?>
