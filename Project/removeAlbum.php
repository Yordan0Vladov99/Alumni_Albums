<?php
require 'db.php';
$db = new DB();
$db->removeAlbum($_GET['id']);
?>