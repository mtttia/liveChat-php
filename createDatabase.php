<?php

   include ('databaseData.php');

   $db = new mysqli($data['host'], $data['user'], $data['password']);

   if($db->connect_error)
   {
      die('Connection failed: '. $db->connect_error);
   }

   $sql = "CREATE DATABASE " . $data['database'];
   $result = $db->query($sql);
   if($result === TRUE )
   {
      echo "Database created successfully";
   }
   else
   {
      echo "Error creating database: " . $result->error;
   }

   $db->close();

   $newdb = new mysqli($data['host'], $data['user'], $data['password'], $data['database']);
   if($newdb->connect_error)
   {
      die('Connection failed: '. $newdb->connect_error);
   }
   
   $sql = "CREATE TABLE chat (id INT(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY, message VARCHAR(255), sender VARCHAR(50))";
   if(!$newdb->query($sql))
   {
      die("error with CREATE TABLE");
   }
   echo 'table create successfully';


?>