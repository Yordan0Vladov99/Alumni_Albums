<?php
require 'db.php';
$db = new DB();
$db->requestSession($_GET['username'],$_GET['date'],$_GET['time'],$_GET['location'],$_GET['quantity'],$_GET['description']);
?>