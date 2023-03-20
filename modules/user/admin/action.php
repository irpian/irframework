<?php
$url_back   = defaultBackUrl($url_back, $module, $switch_list, $page);

if($_GET['switch']=="add"){
    $title_page = $title_add;
    include "include/formPost.php";

}elseif($_GET['switch']=="edit"){
    $title_page = $title_edit;
    $data = getDetail($select, $table, $primary, $_GET['id']);
    $data_login = getDetail($select, $table, "name", $_SESSION[$session_admin]);
    extract($data);
    
    if($_GET['id']=="1" && $data_login['id']<>"1"){
        redirect(base_admin);
    }elseif(($data['id']<>$data_login['id']) && $data_login['id']<>"1"){
        redirect(base_admin);
    }else{
        
    }

    if(isset($_POST)){
        include "include/formPost.php";
    }
    
}elseif($_GET['switch']=="change-password"){
    $data_login = getDetail($select, $table, "name", $_SESSION[$session_admin]);
    include "include/formPost.php";
}else{
    echo "Url Not Registerd";
}

if ($_POST['submit']) { 
    
    if($switch!="change-password"){
        if (trim($_POST['name'])=="") { 
            $error[] = $form->formAlert("user_required", "");
        }
        
        if (trim($_POST['email'])=="") { 
            $error[] = $form->formAlert("email_required", $title_module); 
        }

        if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])){
            $error[] = $form->formAlert("email_validate", $title_module);
        }
    }

    if($switch=="add") {
        if (trim($_POST['password'])=="") { 
            $error[] = $form->formAlert("password_required", $title_module);
        }
    }elseif(
        ($switch=="change-password" && $data_login['id']==$_SESSION["admin_id"]) 
        || 
        ($switch=="edit" && isUserRoot($_SESSION["admin_id"]) && $_POST['password_new']!="")) {

        if(!isUserRoot($_SESSION["admin_id"])){
            if (trim($_POST['password'])=="") { 
                $error[] = $form->formAlert("password_old_required", $title_module);
            }
            
            //cek password lama
            if (trim($_POST['password'])!="") {  
                $cek_password = $db->row($field_ready_cek3, $table, "WHERE $field_ready_cek3='".encript($password)."' AND {$primary} = '".$_SESSION['admin_id']."' ");

                if ($cek_password==0){  
                    $error[] = $form->formAlert("password_old_false", $title_module);
                }
                //error password lama belum sama
            }
        } else {

        }


        if (trim($_POST['password_new'])=="") { 
                $error[] = $form->formAlert("password_new_required", $title_module); 
        }

        if (trim($_POST['password_repeat'])=="") { 
                $error[] = $form->formAlert("password_repeat_required", $title_module); 
        }

        if (trim($_POST['password_new'])!=trim($_POST['password_repeat'])) { 
            $error[] = $form->formAlert("password_not_same", $title_module);
        }

    } else {
        
    }
    
    if($field_ready_cek){
        if($switch=="add") {
            $cek = $db->row($field_ready_cek, $table, "WHERE $field_ready_cek='".strtolower($name)."'");
            if ($cek==1){   
                $error[] = $form->formAlert("user_ready", "User");
            }
            
            $cek2 = $db->row($field_ready_cek2, $table, "WHERE $field_ready_cek2='".strtolower($email)."'");
            if ($cek2==1){  
                $error[] = $form->formAlert("email_ready", "Email");
            }
        }
    }


    if($switch=="add") {
        $_POST['password'] = encript($password);
    }elseif($switch=="edit") {
        if($password_new==$password_repeat){
            $_POST['password'] = encript($password_new);
        }
    }elseif($switch=="change-password") {
        if($password_new==$password_repeat){
            $_POST['password'] = encript($password_new);
        }
    } else {

    }
    
    if (!count($error)==0 ) {
        errorList($error);
    }else {

        if($switch=="add") {
            $query_set = setQuery($_POST,defaultUnsetQuery($unset_query_add));
            $query_add = "INSERT INTO $table SET
                    ".$query_set.",
                    date_create = '".date("Y-m-d H:i:s")."' ";
            if($db->execute($query_add)){
                success($alert_succes_create);
            }else{
                error($alert_failed_create);
            }
            extract(unsetPost($_POST));
            
        }elseif($switch=="edit") {
            $query_set = setQuery($_POST,defaultUnsetQuery($unset_query_update));
            $query_update = "UPDATE $table SET
                    ".$query_set."
                    WHERE {$primary} = '".$_POST['id']."'";
            $db->execute($query_update);
            success($alert_succes_update);
            extract($_POST);
            
        }elseif($switch=="change-password") {
            $query_set = setQuery($_POST,defaultUnsetQuery($unset_query_update));
            $query_update = "UPDATE $table SET
                    ".$query_set."
                    WHERE {$primary} = '".$_SESSION['admin_id']."' ";
            $db->execute($query_update);
            success($alert_change_password);
            extract($_POST);

        }else{
            failed("No Action");
        }
    }
}
?>
<?php
$form->formTitle($title_page);

$form->textEditor();
$form->formOpen("", "form1");
if($switch=="edit"){
    $form->formHidden("id", $id);
}else{
    //$form->formHidden("id", $last_id);
}

if($_GET['switch']!="change-password"){
    $form->formName("User Admin",2);
    $form->formText("name", $name); //name
    $form->formGrupClose();
    
    $form->formName("Email",6);
    $form->formText("email", $email);
    $form->formGrupClose();
}

if(isUserRoot($_SESSION["admin_id"]) && $_GET['switch']=="add"){ 
    $form->formName("Password",2);
    $form->formPassword("password", "");
    $form->formGrupClose();

    $form->formName("Repeat Password",2);
    $form->formPassword("password_repeat", "");
    $form->formGrupClose();
}

if(
    ($data_login['id']==$_SESSION["admin_id"] && $_GET['switch']=="change-password")
    ||
    (isUserRoot($_SESSION["admin_id"]) && $_GET['switch']=="edit")
){ 
    $form->formName("Old Password",2);
    $form->formPassword("password", "");
    $form->formGrupClose();

    $form->formName("New Password",2);
    $form->formPassword("password_new", "");
    $form->formGrupClose();

    $form->formName("Repeat Password",2);
    $form->formPassword("password_repeat", "");
    $form->formGrupClose();
}

if(isUserRoot($_SESSION["admin_id"]) && $_GET['switch']!="change-password"){
    $form->formName("Status",2);
    $array_option_status = array(1=>"Aktif", 0=>"Non Aktif");
    $form->formOption("status", $status, $array_option_status, $extra);
    $form->formGrupClose();
}

$form->formName("");
$form->formSubmit("submit", "Save");
$form->formBack($url_back);
$form->formGrupClose();

$form->formClose();
?>
<div class="clear"></div>