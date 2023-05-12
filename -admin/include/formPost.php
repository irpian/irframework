<?php
//--
extract($_POST);
//--

//note
 if(isset($seo)){ 
    if($seo==""){
        if(isset($title)!=""){
            $seo = $title;
            $_POST['seo'] = $title;
        }

        if(isset($name)!=""){
            $seo = $name;
            $_POST['seo'] = $name;
        }
    }
}
?>