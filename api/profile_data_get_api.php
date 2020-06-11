<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('Cadmus_Api')) {
     $cad_api = new Cadmus_Api();

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profile_data']) && $_POST['profile_data'] == 1) {

         if (method_exists($cad_api, 'profileDataGetApi')) {

          $users_id = $_POST['users_id'];
          $username = $_POST['username'];
          
         $cad_api->profileDataGetApi($users_id,$username);
     }
     }
    

 }
}


?>