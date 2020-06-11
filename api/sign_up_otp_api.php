<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('Cadmus_Api')) {
     $cad_api = new Cadmus_Api(); 

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp']) && $_POST['otp'] == 1) {

        if (method_exists($cad_api, 'user_signup_otp_api')) {
          
          $users_id    = $_POST['users_id'];
          $dynamic_otp = $_POST['dynamic_otp'];

         $cad_api->user_signup_otp_api($users_id,$dynamic_otp);
     }
    }

 }
}


?>