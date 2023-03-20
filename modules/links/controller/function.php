<?php 
function link_tag($text) {
    if(preg_match("/, /", $text)){
        return "#".str_replace(", ", " #", $text);
    } else {
        return $text;
    }
}
?>