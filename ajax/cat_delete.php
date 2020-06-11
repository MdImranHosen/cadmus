<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();

     if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['catdid']) && $_GET['catdel'] == 97) {

    	if (method_exists($admin, 'deleteCategoryByCatId')) {

    		$catdid = $_GET['catdid'];

    		$admin->deleteCategoryByCatId($catdid);
    	}    	
    }
 }
}