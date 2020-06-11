<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();

     if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['useraid']) && $_GET['useractive'] == 48) {

    	if (method_exists($admin, 'activeUserByUserId')) {

    		$useraid = $_GET['useraid'];

    		$admin->activeUserByUserId($useraid);
    	}    	
    }
 }
}