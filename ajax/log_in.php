<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();   

   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_admin']) && $_POST['login_admin'] == 88) {

       if (method_exists($admin, 'adminLogin')) {

          $admin_user = $_POST['admin_user'];
          $admin_pass = $_POST['admin_pass'];

         echo $admin->adminLogin($admin_user,$admin_pass);
     }
    } 
 }
}