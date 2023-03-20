<?php
    //redirect
    function redirect($url){
    	echo "<meta http-equiv='refresh' content='0; url=".$url."'>";
    	exit();
    }

    function redirect301($url){
    	header('Location: '.$url, true, 301);
    	exit();
    }

    function redirect404(){
    	$url = base_url."/404";
    	header('Location: '.$url, true, 301);
    	exit();
    }

    function redirectLastSlash($url){
    	if(substr($url, -1)=="/"){
    		$url = substr($url, 0, -1);
    		if($url!=base_url){
    			redirect($url);
    		}
    	}
    }

    function removeLastSlash($url){
        if(substr($url, -1)=="/"){
            $url = substr($url, 0, -1);
        }
        return $url;
    }
 ?>
