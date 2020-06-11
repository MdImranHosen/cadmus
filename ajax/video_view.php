<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('UsersClass')) {
     $users = new UsersClass();

     if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['video_id']) && $_GET['videoview'] == 44) {

    	if (method_exists($users, 'viewVideoByvideoId')) {

    		$video_id = $_GET['video_id'];

    		$users->viewVideoByvideoId($video_id);
    	}    	
    }
 }
}