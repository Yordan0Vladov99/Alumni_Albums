<?php
require 'db.php';

$db = new DB();
$id=$_GET["id"];
$db->denySession($id);
?>