<?php
function installMenu($get_name){
	global $db;
	$dh  = opendir("../modules/".$get_name."/controller");
	while (false !== ($view_directory = readdir($dh))) {
		if(preg_match("/config.php/", $view_directory)){
			include "../modules/".$get_name."/controller/config.php";
			//menu public
			if(!empty($install['menu'])){
				foreach($install['menu'] as $data){
					$cek_menu = $db->row("id", "menu", "WHERE position=0 AND name='".$data['name']."' AND url='".$data['url']."' ");
					if(($cek_menu=="" || $cek_menu==0) && $data['name']<>""){ 
						$insert  = "name='".$data['name']."', ";
						$insert  .= "module='".$get_name."', ";
						$insert  .= "url='".$data['url']."', ";
						$insert  .= "position='0'";
						$db->insert("menu", "", $insert);
						$insert = "";
					}
					$cek_menu = "";
				}
			}
			
			//sub menu public
			if(!empty($install['menu']['sub'])){
				foreach($install['menu'] as $key_parent=>$data_parent){
					foreach($install['menu']['sub'] as $key=>$data){
						$parent_menu = $install['menu'][$key_parent];
						$get_menu = $db->value("id", "menu",
						"WHERE position=0 
						AND name='".$parent_menu['name']."' 
						AND module='".$get_name."' 
						AND url='".$parent_menu['url']."' 
						AND icon='".$parent_menu['icon']."'");
						
						$cek_menu = $db->row("id", "menu",
						"WHERE position=0 
						AND name='".$data['name']."' 
						AND module='".$get_name."' 
						AND url='".$data['url']."' 
						AND icon='".$data['icon']."'");
						
						if(($cek_menu=="" || $cek_menu==0) && $data['name']<>"" && $get_menu>0){ 
							$insert  = "name='".$data['name']."', ";
							$insert  .= "module='".$get_name."', ";
							$insert  .= "url='".$data['url']."', ";
							$insert  .= "icon='".$data['icon']."', ";
							$insert  .= "orderby='".$data['order']."', ";
							$insert  .= "parent='".$get_menu."', ";
							$insert  .= "position='0'";
							$db->insert("menu", "", $insert);
							$insert = "";
						}
						$get_menu = "";
						$cek_menu = "";
					}
				}
			}
			
			//menu admin
			if(!empty($install['menu_admin'])){
				foreach($install['menu_admin'] as $data){
					$cek_menu = $db->row("id", "menu", "WHERE position=1 AND name='".$data['name']."' AND url='".$data['url']."' AND icon='".$data['icon']."'");
					if(($cek_menu=="" || $cek_menu==0) && $data['name']<>""){ 
						$insert  = "name='".$data['name']."', ";
						$insert  .= "module='".$get_name."', ";
						$insert  .= "url='".$data['url']."', ";
						$insert  .= "icon='".$data['icon']."', ";
						$insert  .= "position='1'";
						$db->insert("menu", "", $insert);
						$insert = "";
					}
					$cek_menu = "";
				}
			}
			
			//sub menu admin
			if(!empty($install['menu_admin']['sub'])){
				foreach($install['menu_admin'] as $key_parent=>$data_parent){
					foreach($install['menu_admin']['sub'] as $key=>$data){
						$parent_menu = $install['menu_admin'][$key_parent];
						$get_menu = $db->value("id", "menu",
						"WHERE position=1 
						AND name='".$parent_menu['name']."' 
						AND module='".$get_name."' 
						AND url='".$parent_menu['url']."' 
						AND icon='".$parent_menu['icon']."'");
						
						$cek_menu = $db->row("id", "menu",
						"WHERE position=1 
						AND name='".$data['name']."' 
						AND module='".$get_name."' 
						AND url='".$data['url']."' 
						AND icon='".$data['icon']."'");
						
						if(($cek_menu=="" || $cek_menu==0) && $data['name']<>"" && $get_menu>0){ 
							$insert  = "name='".$data['name']."', ";
							$insert  .= "module='".$get_name."', ";
							$insert  .= "url='".$data['url']."', ";
							$insert  .= "icon='".$data['icon']."', ";
							$insert  .= "orderby='".$data['order']."', ";
							$insert  .= "parent='".$get_menu."', ";
							$insert  .= "position='1'";
							$db->insert("menu", "", $insert);
							$insert = "";
						}
						$get_menu = "";
						$cek_menu = "";
					}
				}
			}

		}
	}
}

function installDirectory($get_name){
	global $db;
	$dh  = opendir("../modules/".$get_name."/controller");
	while (false !== ($view_directory = readdir($dh))) {
		if(preg_match("/config.php/", $view_directory)){
			include "../modules/".$get_name."/controller/config.php";
			foreach($install['directory'] as $directory){
				if(!empty($directory)){ 
					if( is_dir($directory) === false ){
						mkdir($directory, 0777);
					}
				}
			}
		}
	}
}

function installVariable($get_name){
	global $db;
	$dh  = opendir("../modules/".$get_name."/controller");
	while (false !== ($view_directory = readdir($dh))) {
		if(preg_match("/config.php/", $view_directory)){
			include "../modules/".$get_name."/controller/config.php";
			//variable public
			if(!empty($install['variable'])){
				foreach($install['variable'] as $data){
					$cek_variable = $db->row("id", "config", "WHERE inisial='".$data['inisial']."' ");
					
					if(($cek_variable=="" || $cek_variable==0) && $data['inisial']<>""){ 
						$insert  = "inisial='".$data['inisial']."', ";
						$insert  .= "value='".$data['value']."', ";
						$insert  .= "name='".$data['name']."', ";
						$insert  .= "web_config='".$data['web_config']."', ";
						$insert  .= "type='".$data['type']."' "; //1:text 2:textarea //3:select
						//echo "INSERT INTO config SET $value";
						$db->insert("config", "", $insert);
						$insert = "";
					}
					$cek_variable = "";
				}
			}
		}
	}
}


function installMeta($get_name){
	global $db;
	include "../config.php";
	$dh  = opendir("../modules/".$get_name."/controller");
	while (false !== ($view_directory = readdir($dh))) {
		if(preg_match("/config.php/", $view_directory)){
			include "../modules/".$get_name."/controller/config.php";
			//meta public
			if(!empty($install['meta'])){
				foreach($install['meta'] as $data){
					$cek_meta = $db->row("id", "meta", "WHERE module='".$data['alias']."' AND meta_switch='".$data['switch']."' ");
					
					if(($cek_meta=="" || $cek_meta==0) && $data['alias']<>""){ 
						$insert  = "title='".$data['title']."', ";
						$insert  .= "module='".$data['alias']."', ";
						$insert  .= "meta_switch='".$data['switch']."', ";
						$insert  .= "meta_keyword='".$data['keyword']."', ";
						$insert  .= "meta_description='".$data['description']."' ";
						$db->insert("meta", "", $insert);
						$insert = "";
					}
					$cek_meta = "";
				}
			}
		}
	}
}

function installRolePage(){

}
?>