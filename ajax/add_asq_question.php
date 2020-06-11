<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('UsersClass')) {
     $users = new UsersClass();   

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['asq_save']) && $_POST['asq_save'] == 77) {

       if (method_exists($users, 'addAsqQuestion')) {

          $user_id     = $_POST['user_id'];
          $cat_id      = $_POST['cat_id'];
          $sub_cat     = $_POST['sub_cat'];
          $asq_title   = $_POST['asq_title'];
          $description = $_POST['description'];

         $users->addAsqQuestion($user_id,$cat_id,$sub_cat,$asq_title,$description);
     }
    } 

 }
}