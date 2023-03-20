<?php
if (isset($_FILES['image'])){
    $_POST['image'] = $file_name;
}


//note
if (isset($_POST['meta_keyword'])!=""){
    $_POST['meta_keyword']  = autoKeyword($website, $title_module, $title, $_POST['meta_keyword']);
}

if (isset($_POST['meta_description'])!=""){
    $_POST['meta_description']  = autoDescription($website, $title_module, $title, $_POST['meta_description']);
}

if (isset($_POST['seo'])){
    $_POST['seo'] = str_replace(" ", "-", strtolower($_POST['seo']));
}
//------------

if($switch==$switch_add) {
    $query_set = setQuery($_POST,defaultUnsetQuery($unset_query_add));
    $query_add = "INSERT INTO $table SET
            ".$query_set.",
            date_create = '".date("Y-m-d H:i:s")."' ";
    $db->execute($query_add);
    success("Sucess Add ".$title_module);
    extract(unsetPost($_POST));

}elseif($switch==$switch_edit) {
    $query_set = setQuery($_POST,defaultUnsetQuery($unset_query_update));
    $query_update = "UPDATE $table SET
            ".$query_set."
            WHERE {$primary} = '".$id."'";
    $db->execute($query_update);
    success("Sucess Edit ".$title_module);
    extract($_POST);

}else{
    failed("No Action");
}
?>