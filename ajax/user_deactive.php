<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();

     if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['userdid']) && $_GET['userdeactive'] == 47) {

    	if (method_exists($admin, 'deactiveUserByUserId')) {

    		$userdid = $_GET['userdid'];

    		$admin->deactiveUserByUserId($userdid);
    	}    	
    }
 }
}