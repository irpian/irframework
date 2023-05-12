<?php
//$field_file
//$table
//$primary
//$id ( get or post )
//$directory_file
//$directory_file2
//$inisial_upload
//$image_height_1
//$image_width_1
//$image_height_2
//$image_width_2
//$switch

//type upload : default : tumbnail : resize

if(isset($_FILES['image'])){
    $_FILES['file'] = $_FILES['image'];
}

if(isset($_POST['image_hidden'])){
    $_POST['file_hidden'] = $_POST['image_hidden'];
}

if($switch=="add"){

} else { 
    $file_name = $db->value("$field_file", $table, "WHERE {$primary}='".$id."'"); 
}

if($_FILES['file']['name']<>"" and $_POST['file_hidden']<>""){ 
    unlink($directory_file.$file_name); 
    if($type_upload=="thumbnail"){ 
        unlink($directory_file2.$file_name); 
    }
}

if($inisial_upload="default"){
    $upload_file = $_FILES['file']['name']; 
}elseif($inisial_upload<>""){ 
    $upload_file = $inisial_upload." ".$id." ".$_FILES['file']['name']; 
} else { 
    $upload_file = $id."-".$_FILES['file']['name']; 
}

//note
if($_FILES['file']['name']){ 
    if($type_upload=="default"){ 
        upload_default($upload_file, $directory_file); 
    }elseif($type_upload=="thumbnail"){ 
        upload_resize_double($upload_file, $directory_file, $directory_file2, $image_height_1, $image_width_1, $image_height_2, $image_width_2);
    }elseif($type_upload=="resize"){ 
        upload_resize($upload_file, $directory_file, $image_height_1, $image_width_1);
    }else{ 
        upload_default($upload_file, $directory_file);
    }
}

if($switch=="add"){ 
    if($_FILES['file']['name']){
        if($inisial_upload="default"){
            $file_name = $_FILES['file']['name']; 
        }elseif($inisial_upload<>""){
            $file_name = $inisial_upload." ".$id." ".$_FILES['file']['name']; 
        } else { 
            $file_name = $id."-".$_FILES['file']['name']; 
        }
    } else {
        $file_name = "";
    }
}else{
    if (!$_FILES['file']['name']=="") {
        if($inisial_upload="default"){
            $file_name = $_FILES['file']['name']; 
        }elseif($inisial_upload<>""){ 
            $file_name = $inisial_upload." ".$id." ".$_FILES['file']['name']; 
        } else { 
            $file_name = $id."-".$_FILES['file']['name']; 
        }
    }else {
        $file_name = $_POST['file_hidden'];
    }
}
?>