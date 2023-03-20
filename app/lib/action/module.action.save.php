<?php
$query_set = setQuery($_POST, defaultUnsetQuery($unset_query_add=""), 0);
$query_custom = ", date_create = '".date("Y-m-d H:i:s")."' ";

$query_add = "INSERT INTO $table SET ".$query_set." $query_custom ";

$db->execute($query_add);
?>