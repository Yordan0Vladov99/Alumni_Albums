<?php
require 'db.php';

$db = new DB();
$name=$_GET["name"];
$owner=$_GET["owner"];
$images=$_GET["images"];
$price=$_GET["price"];
$db->logAlbum($name,$owner,$images,$price);

?>