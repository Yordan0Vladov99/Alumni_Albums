<?php
require 'db.php';

if(isset($_FILES['file']['name'])){
   
   $filename = $_FILES['file']['name'];

   $location = 'images/'.$filename;

   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);

   $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");

   $response = 0;
   if(in_array($file_extension,$valid_ext)){
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         $response = 1;
      } 
   }

    $db = new DB();
    $db->addFile($filename);
   
   echo $response;
   exit;
}