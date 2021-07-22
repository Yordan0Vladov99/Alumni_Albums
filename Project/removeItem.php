<?php
require 'db.php';
$db = new DB();
$db->removeItem($_GET['id']);
?>