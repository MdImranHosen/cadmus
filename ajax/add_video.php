<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('AdminClass')) {
     $admin = new AdminClass();   

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['video_save']) && $_POST['video_save'] == 77) {

       if (method_exists($admin, 'addVideo')) {

          $video_title = $_POST['video_title'];
          $video_name  = $_FILES['video_name'];

         $admin->addVideo($video_title,$video_name);
     }
    } 

 }
}