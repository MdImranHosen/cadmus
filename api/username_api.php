<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('Cadmus_Api')) {
     $cad_api = new Cadmus_Api();

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['check_usern']) && $_POST['check_usern'] == 1) {

       if (method_exists($cad_api, 'usernameExists_Api')) {

    		$username = $_POST['username'];

    		$cad_api->usernameExists_Api($username);
    	}
     }
    

 }
}


?>