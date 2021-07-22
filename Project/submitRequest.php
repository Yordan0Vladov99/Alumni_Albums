<?php
require 'db.php';
$db = new DB();
$db->submitRequest($_GET['id'],$_GET['username'],$_GET['image'],$_GET['description']);
?>