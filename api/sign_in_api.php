<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('Cadmus_Api')) {
     $cad_api = new Cadmus_Api(); 

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sign_in']) && $_POST['sign_in'] == 1) {

       if (method_exists($cad_api, 'users_sign_in_api')) {

          $username = $_POST['username'];
          $password = $_POST['password'];

         $cad_api->users_sign_in_api($username,$password);
     }
    }
    

 }
}


?>