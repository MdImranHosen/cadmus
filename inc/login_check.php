<?php 
if (class_exists('UsersClass')) {
    $users = new UsersClass();  
   if (method_exists($users, 'url')) {
    if (!empty($_SESSION['access_token']) && !empty($_SESSION['user_id'])) {
      header("Location:/cadmus/users");
     }
   }
  }
?>