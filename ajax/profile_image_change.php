<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('UsersClass')) {
     $users = new UsersClass();   

   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_pic']) && $_POST['save_pic'] == 33) {

       if (method_exists($users, 'changeProfileImage')) {

          $user_id       = $_POST['user_id'];
          $profile_image = $_FILES['profile_image'];

         $users->changeProfileImage($user_id,$profile_image);
     }
    } 
 }
}