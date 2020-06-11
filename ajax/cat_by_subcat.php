<?php
if (realpath("../classes/Mainclass.php")) {

  include_once '../classes/Mainclass.php';
  
  if (class_exists('UsersClass')) {
     $users = new UsersClass();

     if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cat_id']) && $_GET['sub'] == 1) {

    	if (method_exists($users, 'getCatIdBySubCat')) {

    		$cat_id = $_GET['cat_id'];

    	  $result = $users->getCatIdBySubCat($cat_id);
    	  if ($result) {
         $output = '<option value="" style="display:none;cursor:pointer;">Select Sub Category</option>';
         while ($row = $result->fetch_assoc()) {
          $cat_id = $row['cat_id'];
          $cat_name = $row['cat_name'];
          $output .= '<option value="'.$cat_id.'">'.$cat_name.'</option>';
         }
         echo $output;
        } else{
          echo '<option value="" style="display:none;cursor:pointer;">Select Sub Category</option>';          
         }
    	}    	
    }





 }
}