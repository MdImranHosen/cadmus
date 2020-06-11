<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('Cadmus_Api')) {
     $cad_api = new Cadmus_Api();

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profile_up']) && $_POST['profile_up'] == 1) {

         if (method_exists($cad_api, 'userInfoupApi')) {

          $users_id        = $_POST['users_id'];
          $users_fullname  = $_POST['users_fullname'];
          $users_mobile    = $_POST['users_mobile'];
          $users_email     = $_POST['users_email'];
          $users_institute = $_POST['users_institute'];
          $user_fb         = $_POST['user_fb'];
          $user_ing        = $_POST['user_ing'];
          $user_wp         = $_POST['user_wp'];
          $user_tw         = $_POST['user_tw'];
          
         $cad_api->userInfoupApi($users_id,$users_mobile,$users_fullname,$users_email,$users_institute,$user_fb,$user_ing,$user_wp,$user_tw);
     }
     }
    

 }
}


?>