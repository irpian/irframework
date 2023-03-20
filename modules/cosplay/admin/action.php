<?php
include "include/action.php";

$form->formTitle($title_page);

$form->formOpen("", "form_action");

$form->formHidden("id", $id);

$form->groupOptionTable("Account", "account", $account, "id, name", $table2, "WHERE status=1 ORDER BY name ASC", "id", "name", "-Select Account-");

$form->groupText("Name", "name", $name);

$form->groupText("Cosplayer", "cosplayer", $cosplayer);

$form->groupText("Url", "url", $url);

$form->groupOptionStatus("Status", "status", $status); //Status

$form->groupSubmit("", "submit", "Save", $url_back);

$form->formClose();
?>
