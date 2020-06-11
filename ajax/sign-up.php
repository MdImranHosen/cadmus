<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('UsersClass')) {
     $users = new UsersClass();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username_check']) && $_POST['username_check'] == 1) {

    	if (method_exists($users, 'usernameExists')) {

    		$username = $_POST['username'];

    		$users->usernameExists($username);
    	}    	
    } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save']) && $_POST['save'] == 1) {

       if (method_exists($users, 'user_signup')) {

          $username = $_POST['username'];
          $phone    = $_POST['phone'];
          $password = $_POST['password'];

         $users->user_signup($phone,$username,$password);
     }
    } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp']) && $_POST['otp'] == 1) {

       if (method_exists($users, 'user_signup_otp')) {
          
          $user_id     = $_POST['user_id'];
          $dynamic_otp = $_POST['dynamic_otp'];

         $users->user_signup_otp($user_id,$dynamic_otp);
     }
    } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pro_up']) && $_POST['pro_up'] == 2) {

       if (method_exists($users, 'userinfoup')) {

          $user_id         = $_POST['user_id'];
          $full_name       = $_POST['full_name'];
          $user_phone      = $_POST['user_phone'];
          $users_email     = $_POST['users_email'];
          $users_institute = $_POST['users_institute'];
          $user_fb         = $_POST['user_fb'];
          $user_ing        = $_POST['user_ing'];
          $user_wp         = $_POST['user_wp'];
          $user_tw         = $_POST['user_tw'];

         $users->userinfoup($user_id,$user_phone,$full_name,$users_email,$users_institute,$user_fb,$user_ing,$user_wp,$user_tw);
     }
    } 

 }
}