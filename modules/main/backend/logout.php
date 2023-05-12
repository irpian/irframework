<?php
$db->update("admin", "logout='".date("Y-m-d H:i:s")."'", "WHERE name='".$_SESSION[$session_admin]."'");
logout($session_admin);
echo "<meta http-equiv='refresh' content='0; url=".base_admin."'>";
?>