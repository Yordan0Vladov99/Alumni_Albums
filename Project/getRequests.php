<?php
require 'db.php';
$db = new DB();
$db->getRequests($_GET['username']);
?>