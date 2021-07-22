<?php
require 'db.php';
$db = new DB();
$db->getCartItems($_GET['username']);
?>