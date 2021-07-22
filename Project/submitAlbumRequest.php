<?php
require 'db.php';
$db = new DB();
$db->submitAlbumRequest($_GET['link'],$_GET['username'],$_GET['description']);
?>