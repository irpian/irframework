<?php
include "include/action.php";

$form->textEditor();
$form->formTitle($title_page);

$form->formOpen("", "form_action");
$form->formHidden("id", $id);

$form->groupText("Url Redirect From", "url_from", $url_from);

$form->groupText("Url Redirect To", "url_to", $url_to);

$form->groupOptionStatus("Status", "status", $status); //Status

$form->groupSubmit("", "submit", "Save", $url_back);

$form->formClose();
?>