<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass(); 

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ecat_save']) && $_POST['ecat_save'] == 43) {

       if (method_exists($admin, 'updateSubCategoryByCatId')) {

         $catedid  = $_POST['catedid'];
         $ecatname = $_POST['ecatname'];

         $admin->updateSubCategoryByCatId($ecatname,$catedid);
     }
    } 

 }
}