<?php
if($_GET['delete']){
    $_GET['id'] = $_GET['delete'];
}

if(empty($delete)){
    $delete[] = array("switch"=>"delete", "type"=>"data", "back"=>$page);
}

foreach ($delete as $key => $value) {
    if($value['switch']==$switch){
        if($value['type']=="data"){
            delete("data", $module, $table, $primary, $_GET['id'], "", "", $value['back']);
        }

        if($value['type']=="data-file"){
            delete("data-file", $module, $table, $primary, $_GET['id'], $field_file, $directory_file, $value['back']);
        }

        if($value['type']=="data-files"){
            delete("data-files", $module, $table, $primary, $_GET['id'], $field_file, $directory_file, $value['back']);
        }

        if($value['type']=="child"){
            delete("child", $module, $table, $primary, $_GET['id'], $child_table, $child_parent, $value['back']);
            delete("data", $module, $table, $primary, $_GET['id'], "", "", $page);
        }

        if($value['type']=="file"){
            delete("file", $module, $table, $primary, $_GET['id'], $field_file, $directory_file, $value['back']);
        }

        if($value['type']=="files"){
            delete("files", $module, $table, $primary, $_GET['id'], $field_file, $directory_file, $value['back']);
        }
    }
}
?>