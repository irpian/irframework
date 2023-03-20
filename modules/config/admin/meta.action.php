<?php
include "include/action.php";

$form->textEditor();
$form->formTitle($title_page);

$form->formOpen("", "form_action");
$form->formHidden("id", $id);

$form->groupText("Meta Title", "title", $title);

$form->groupText("Module / Alias", "module", $module);

$form->groupText("Switch", "meta_switch", $meta_switch);

$form->groupTextArea("Keyword", "meta_keyword", $meta_keyword);

$form->groupTextArea("Description", "meta_description", $meta_description);

$form->groupOptionStatus("Status", "status", $status); //Status

$form->groupSubmit("", "submit", "Save", $url_back);

$form->formClose();
?>