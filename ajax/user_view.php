<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();

     if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['usersid']) && $_GET['userview'] == 45) {

    	if (method_exists($admin, 'viewUserByUserId')) {

    		$usersid = $_GET['usersid'];

    		$admin->viewUserByUserId($usersid);
    	}    	
    }
 }
}