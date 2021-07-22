<?php
require 'db.php';
$db = new DB();
$db->sendToCart($_GET["owner"],$_GET["image"],$_GET["type"],$_GET["price"]);
?>