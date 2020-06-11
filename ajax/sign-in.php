<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('UsersClass')) {
     $users = new UsersClass();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sign_in']) && $_POST['sign_in'] == 99) {

     if (method_exists($users, 'user_login')) {

          $username = $_POST['username'];
          $password = $_POST['password'];

         echo $users->user_login($username,$password);
   }
  }
 }
}