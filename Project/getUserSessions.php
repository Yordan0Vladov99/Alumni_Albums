<?php
require 'db.php';
$db = new DB();
$db->getUserSessions($_GET['username']);
?>