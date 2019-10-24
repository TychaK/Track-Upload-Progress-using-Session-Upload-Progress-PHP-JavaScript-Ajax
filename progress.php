<?php
$key = ini_get("session.upload_progress.prefix") . "upload_progress";
echo json_encode($_SESSION[$key]);
?>
