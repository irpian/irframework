<?php
include "include/action.php";

$form->formTitle($title_page);

$form->formOpen("", "form_action");
$form->formHidden("id", $id);

$form->groupText("Name", "name", $name);

$form->groupText("Url", "url", $url);

$form->groupOptionStatus("Status", "status", $status); //Status

$form->groupSubmit("", "submit", "Save", $url_back);

$form->formClose();
?>