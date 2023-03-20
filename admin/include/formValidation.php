<?php
foreach ($validation as $key => $value) {
    if ($value['type']=="required"){

        if (trim($_POST[$value['form']])=="") { 
            $error[] = $form->formAlert($value['alert'], $value['title']); 
        }

    } elseif($value['type']=="ready"){

        if($value['form']){
            if($switch==$switch_add) {
                $cek = $db->row($value['form'], $table, "WHERE ".$value['form']."='".strtolower($_POST[$value['form']])."'");
                if ($cek>=1){   
                    $error[] = $form->formAlert($value['alert'], $value['title']);
                }
            }
        }

    } elseif($value['type']=="email"){
        
        if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST[$value['form']])){
            $error[] = $form->formAlert($value['alert'], $value['title']);
        }

    } elseif($value['type']=="integer"){

        if(!is_numeric($_POST[$value['form']])){
            $error[] = $form->formAlert($value['alert'], $value['title']);
        }

    } elseif($value['type']=="min"){

        if(strlen($_POST[$value['form']]) < $value['min']){
            $error[] = $form->formAlert($value['alert'], $value['title']);
        }

    } elseif($value['type']=="max"){

        if(strlen($_POST[$value['form']]) > $value['max']){
            $error[] = $form->formAlert($value['alert'], $value['title']);
        }

    } else {

    }
}
?>