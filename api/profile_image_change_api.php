<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('Cadmus_Api')) {
     $cad_api = new Cadmus_Api();

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_pic']) && $_POST['save_pic'] == 1) {

       if (method_exists($cad_api, 'changeProfileImageApi')) {

          $users_id       = $_POST['users_id'];
          $profile_image = $_FILES['profile_image'];

         $cad_api->changeProfileImageApi($users_id,$profile_image);
     }
    }
    

 }
}


?>