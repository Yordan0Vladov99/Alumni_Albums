<?php
require 'db.php';
$db = new DB();
$db->getUserAlbums($_GET['username']);
?>