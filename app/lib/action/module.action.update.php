<?php
$query_set = setQuery($_POST, defaultUnsetQuery($unset_query_update=""), 0);

$query_update = "UPDATE $table SET ".$query_set." WHERE {$primary} = '".$id."'";

$db->execute($query_update);
?>