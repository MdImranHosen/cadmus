<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('Cadmus_Api')) {
     $cad_api = new Cadmus_Api(); 

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save']) && $_POST['save'] == 1) {

       if (method_exists($cad_api, 'userSignUpApi')) {

          $username = $_POST['username'];
          $phone    = $_POST['phone'];
          $password = $_POST['password'];

         $cad_api->userSignUpApi($phone,$username,$password);
     }
    }

 }
}
?>