<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();   

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sub_cat_save']) && $_POST['sub_cat_save'] == 33) {

       if (method_exists($admin, 'addSubCategory')) {

         $catid        = $_POST['catid'];
         $sub_cat_name = $_POST['sub_cat_name'];

         $admin->addSubCategory($sub_cat_name,$catid);
     }
    } 

 }
}