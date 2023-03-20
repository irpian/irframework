<?php
if(($switch_delete!="" && $switch==$switch_delete) || $switch=="delete"){
    include "include/actionDelete.php";

}elseif(($switch_status!="" && $switch==$switch_status) || $switch=="status"){
    include "include/actionStatus.php";

} elseif( $switch==$switch_add || $switch==$switch_edit
    || $switch=="add" || $switch=="edit") {

    include "include/formSet.php";

    if ($_POST['submit']) {

        include "include/formValidation.php";
        
        if (!count($error)==0 ) {
            echo errorList($error);
        }else {
            include "include/formUpload.php";
            include "include/formSave.php";
        }
    }

} else {

}

if(isset($_POST['search'])){
    unset($_SESSION['filter'][$module]['search']);
    $_SESSION['filter'][$module]['search'] = $_POST['search'];
}

if(isset($_POST['publish'])!=""){
    $_SESSION['filter'][$module]['publish'] = $_POST['publish'];
} else {
    unset($_SESSION['filter'][$module]['publish']);
}

if($_POST['sort']!=""){
    unset($_SESSION['filter'][$module]['sort']);
    $_SESSION['filter'][$module]['sort'] = $_POST['sort'];
}

if($_POST['category']!=""){
    unset($_SESSION['filter'][$module]['category']);
    $_SESSION['filter'][$module]['category'] = $_POST['category'];
}

if(isset($_POST['reset_filter'])){
    unset($_SESSION['filter'][$module]);
}
?>