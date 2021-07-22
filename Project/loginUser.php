<?php
require 'db.php';

$db = new DB();
$username=$_GET["username"];
$password=$_GET["password"];

$db->loginUser($username,$password);

?>