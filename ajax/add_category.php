<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();   

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_save']) && $_POST['cat_save'] == 77) {

       if (method_exists($admin, 'addCategory')) {

         $cat_name = $_POST['cat_name'];

         $admin->addCategory($cat_name);
     }
    } 

 }
}