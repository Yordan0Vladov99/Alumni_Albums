<?php
require 'db.php';
$db = new DB();
$db->registerUser($_GET['username'],$_GET['password']);

?>