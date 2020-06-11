<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();

     if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['subcatid']) && $_GET['subcatdel'] == 53) {

      if (method_exists($admin, 'deleteSubCategoryByCatId')) {

        $subcatid = $_GET['subcatid'];

        $admin->deleteSubCategoryByCatId($subcatid);
      }     
    }
 }
}