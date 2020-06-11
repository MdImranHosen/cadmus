<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();

     if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['videodid']) && $_GET['videodel'] == 97) {

    	if (method_exists($admin, 'deleteVideoByUserId')) {

    		$videodid = $_GET['videodid'];

    		$admin->deleteVideoByUserId($videodid);
    	}    	
    }
 }
}