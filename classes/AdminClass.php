<?php
 /**
  * AdminClass 
  */
class AdminClass extends Mainclass{

// Admin login query ... Start .....
public function adminLogin($admin_user,$admin_pass){
  try {
	date_default_timezone_set("Asia/Dhaka");
	$create_datetime = date("Y-m-d h:i:sa");

	$admin_user = $this->fm->validation($admin_user);
	$admin_pass = $this->fm->validation($admin_pass);        
	$admin_user = mysqli_real_escape_string($this->db->link, $admin_user);
	$admin_pass = mysqli_real_escape_string($this->db->link, $admin_pass);

	if (empty($admin_user) || empty($admin_pass)) {
	$msg = '<div class="alert alert-warning" role="alert">
	      Field Must not be Empty!
	     </div>';
	return $msg;

	} else if((strlen($admin_user) > 100) || (strlen($admin_user) < 4)){
	$msg = '<div class="alert alert-warning" role="alert">
	      Username must be between 4 and 100 Letter!
	     </div>';
	return $msg;
	} else if((strlen($admin_pass) > 32) || (strlen($admin_pass) < 6)){
	$msg = '<div class="alert alert-warning" role="alert">
	      Password must be between 6 and 32 Letter!
	     </div>';
	return $msg;
	} else{
	$admin_pass = md5($admin_pass);
	$sql = "SELECT * FROM admin WHERE admin_user = '$admin_user' AND admin_pass = '$admin_pass'";
	$check = $this->db->select($sql);
	if ($check) {
	$query = "SELECT * FROM admin WHERE admin_user = '$admin_user' AND admin_pass = '$admin_pass' AND admin_status = 1";
	$result = $this->db->select($query);
	if ($result != false) {
	  $value = $result->fetch_assoc();
	  Session::set("admin_login", true);
	  Session::set("admin_id", $value['admin_id']);
	  Session::set("admin_user", $value['admin_user']);

	  $admin_id = $value['admin_id'];
	  $dt = date("d-m-Y-h:i:sa");
	  $access_token_insert = md5($admin_user.$admin_id.$dt);
	  Session::set("access_token", $access_token_insert);
	 $sqlAccessToken = "INSERT INTO access_token (admin_id,TOKEN) VALUES('$admin_id','$access_token_insert')";
	 $this->db->insert($sqlAccessToken);   
	 $token_id = mysqli_insert_id($this->db->link);
	 Session::set("token_id", $token_id);
	 //header("Location:../admin");
	 $msg = "adminlogin";
	 return $msg;

	} else{
	 $msg = '<div class="alert alert-danger" role="alert">
	      Deactive Admin Account!
	     </div>';
	 return $msg;
	}


	} else{
	$msg = '<div class="alert alert-danger" role="alert">
	      Wrong Information Included!
	     </div>';
	 return $msg;
	}           
	}
  } catch (Exception $e) {
	$msg = '<div class="alert alert-danger" role="alert">
	      Something went Wrong!
	     </div>';
	 return $msg; 
  }
}

// Check Admin Login ....
public function checkAdminLogin($acs_token,$admin_id,$token_id){
 try {
    
    $acs_token = $this->fm->validation($acs_token);
    $admin_id   = $this->fm->validation($admin_id);
    $token_id  = $this->fm->validation($token_id);
    $acs_token = mysqli_real_escape_string($this->db->link, $acs_token);
    $admin_id   = mysqli_real_escape_string($this->db->link, $admin_id);
    $token_id  = mysqli_real_escape_string($this->db->link, $token_id);
    $sql = "SELECT * FROM access_token WHERE TOKEN = '$acs_token' AND admin_id = '$admin_id' AND id = $token_id";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
}	

// Get All Users ...
public function getAllUsers(){
	try {
		$sql = "SELECT * FROM users WHERE users_status = 2 ORDER BY users_id DESC";
		$result = $this->db->select($sql);
		if ($result) {
			return $result;
		}
	} catch (Exception $e) {
		
	}
}
// Get User By User id ...
public function viewUserByUserId($usersid){
	try {
      $usersid = $this->fm->validation($usersid);
      $usersid = mysqli_real_escape_string($this->db->link, $usersid);
      if ((!empty($usersid)) && (ctype_digit($usersid) === true)) {
        $sql = "SELECT * FROM users WHERE users_id = '$usersid'";
        $result = $this->db->select($sql);
        if ($result) {

          while ($row = $result->fetch_assoc()) {
            $username            = $row['username'];
            $users_mobile        = $row['users_mobile'];
            $users_email         = $row['users_email'];
            $users_fullname      = $row['users_fullname'];
            $users_institute     = $row['users_institute'];
            $user_fb             = $row['user_fb'];
            $user_ing            = $row['user_ing'];
            $user_wp             = $row['user_wp'];
            $user_tw             = $row['user_tw'];
            $users_create_at     = $row['users_create_at'];
            $users_renew_date    = $row['users_renew_date'];
            $users_expaired_date = $row['users_expaired_date'];
            $users_image         = $row['profile_image'];
            $users_id            = $row['users_id'];

            $profile_path = "../img/".$users_id;
			if ($files = glob($profile_path."/*")){
			   $profile_image =$files[0];
			 }else{
			   $profile_image = "../img/user.svg";
			  }  

           $output = '<table class="table table-bordered"><tbody><tr><th colspan="2"><center><img src="'.$profile_image.'" style="border-radius:50%;width:120px;height:auto;" /></center></th></tr><tr><th>UserName</th><td>'.$username.'</td></tr><tr><th>Phone</th><td>'.$users_mobile.'</td></tr><tr><th>Email</th><td>'.$users_email.'</td></tr><tr><th>Name</th><td>'.$users_fullname.'</td></tr><tr><th>Institute</th><td>'.$users_institute.'</td></tr><tr><th>Facebook</th><td>'.$user_fb.'</td></tr><tr><th>Instagram</th><td>'.$user_ing.'</td></tr><tr><th>Whatsapp</th><td>'.$user_wp.'</td></tr><tr><th>Twitter</th><td>'.$user_tw.'</td></tr><tr><th>Create Date</th><td>'.$users_create_at.'</td></tr><tr><th>Renew Date</th><td>'.$users_renew_date.'</td></tr><tr><th>Expaired Date</th><td>'.$users_expaired_date.'</td></tr></tbody></table>';
           echo $output;
          }
        }
      }
    } catch (Exception $e) {
      
    }
}

// User by user id Deactive ... 
public function deactiveUserByUserId($userdid){

  try {
	 $userdid = $this->fm->validation($userdid);
	 $userdid = mysqli_real_escape_string($this->db->link, $userdid);

	 if ((!empty($userdid)) && (ctype_digit($userdid) === true)) {	 
	 $sql = "UPDATE users SET users_status = 0 WHERE users_id = $userdid";
	 $result = $this->db->update($sql);
	 if ($result) {
	 	echo '66 <div class="alert alert-success">This user Deactive Successfully!</div>';
	 }else{
	 	echo '<div class="alert alert-danger">Something went Wrong!</div>';
	 }
	 }else{
	 	echo '<div class="alert alert-danger">User id must not be Empty!</div>';
	 }
  } catch (Exception $e) {
	 echo '<div class="alert alert-danger">Something went Wrong!</div>';
  }
}

// Get Deactive Users ...
public function getDeactiveUsers(){
	try {
		$sql = "SELECT * FROM users WHERE users_status = 0 ORDER BY users_id DESC";
		$result = $this->db->select($sql);
		if ($result) {
			return $result;
		}
	} catch (Exception $e) {
		
	}
}

// User by user id active ... 
public function activeUserByUserId($user_id){

  try {
	 $user_id = $this->fm->validation($user_id);
	 $user_id = mysqli_real_escape_string($this->db->link, $user_id);

	 if ((!empty($user_id)) && (ctype_digit($user_id) === true)) {	 
	 $sql = "UPDATE users SET users_status = 2 WHERE users_id = $user_id";
	 $result = $this->db->update($sql);
	 if ($result) {
	 	echo '68 <div class="alert alert-success">This user active Successfully!</div>';
	 }else{
	 	echo '<div class="alert alert-danger">Something went Wrong!</div>';
	 }
	 }else{
	 	echo '<div class="alert alert-danger">User id must not be Empty!</div>';
	 }
  } catch (Exception $e) {
	 echo '<div class="alert alert-danger">Something went Wrong!</div>';
  }
}

// Video Delete by Video id
public function deleteVideoByUserId($videodid=NULL){
 try {
	 $videodid = $this->fm->validation($videodid);
	 $videodid = mysqli_real_escape_string($this->db->link, $videodid);

	 if ((!empty($videodid)) && (ctype_digit($videodid) === true)) {	 
	 $sql = "SELECT * FROM videos WHERE video_id = $videodid";
	 $result = $this->db->select($sql);
	 if ($result) {
	 	$delsql = "DELETE FROM videos WHERE video_id = $videodid";
	 	$deldata = $this->db->delete($delsql);
	 	if ($deldata) {
	 		echo '98 <div class="alert alert-success">This Video Delete Successfully!</div>';
	 	}
	 	
	 }else{
	 	echo '<div class="alert alert-danger">Something went Wrong!</div>';
	 }
	 }else{
	 	echo '<div class="alert alert-danger">Video id must not be Empty!</div>';
	 }
  } catch (Exception $e) {
	 echo '<div class="alert alert-danger">Something went Wrong!</div>';
  }
}

// Video add ....
public function addVideo($video_title,$video_file){
 try {
  $video_title = $this->fm->validation($video_title);
  $video_title = mysqli_real_escape_string($this->db->link, $video_title);

      if (empty($video_title) || empty($video_file['name'])) {
      	echo "<div class='alert alert-danger'> Field is Required! </div>";
      } elseif ((!empty($video_title)) && (!empty($video_file['name']))) {

          $exection   = array('mp4');
          $video_tmp  = $video_file['tmp_name'];
          $video_name = $video_file['name'];
          $video_size = $video_file['size'];
          $video_div  = explode('.', $video_name);
          $video_ext  = strtolower(end($video_div));

          $data = getimagesize($video_tmp);
          $width  = $data[0];
          $height = $data[1];
        
        if (in_array($video_ext, $exection) === false) {
        echo "<div class='alert alert-danger'> You can uploads only:-".implode(', ', $exection)."</div>";
        
       } else if ($video_size > 52428800){ //1mb = 1048576 bytes
        echo "<div class='alert alert-danger'> Video Size Should be less then 50 MB !</div>";
       } else{

      	 $file_name = strtolower(preg_replace('/\s+/', '_', $video_name));

         $sql = "INSERT INTO videos(video_title,video_name) VALUES('$video_title','$file_name')";
           $result = $this->db->update($sql);
           if($result) {

            $video_id = mysqli_insert_id($this->db->link);

            $targetDir = "../media/video/".$video_id."/";                

            if(!is_dir($targetDir)){
               mkdir($targetDir, 0777, true);
            }
            
            if (file_exists($targetDir)) {
             array_map('unlink', glob($targetDir."*"));
            }

          $targetPath = $targetDir.$file_name;
          if (move_uploaded_file($video_tmp,$targetPath)) {
            echo '77 <div class="alert alert-success">Video Added Successfully! </div>';
            }else{
            	 echo "<div class='alert alert-danger'> Video not Uploaded! </div>";
            }      
           } else{
            echo "<div class='alert alert-danger'> Something went wrong! </div>";
           }
           
         }
      }
    } catch (Exception $e) {
      echo '<div class="alert alert-danger">Something went Wrong!</div>';
    }
}

public function addCategory($cat_name){
	try {
		$cat_name = $this->fm->validation($cat_name);
		$cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
		if (empty($cat_name)) {
		echo '<div class="alert alert-danger">Category Name is Required!</div>';
		}elseif((strlen($cat_name) < 3) || (strlen($cat_name) > 60)){
        echo '<div class="alert alert-warning">
	      Category name must be between 3 to 60 Characters!
	     </div>';
		}else{
          $csql = "SELECT * FROM category WHERE cat_name = '$cat_name' AND sub_id = 0 AND cat_status = 1";
          $cresult = $this->db->select($csql);
          if ($cresult != false) {
          	echo '<div class="alert alert-danger">This: <strong>'.$cat_name.'</strong> Category Already Exists.!</div>';
          }else{
          $sql = "INSERT INTO category (cat_name) VALUES('$cat_name')";
          $result = $this->db->insert($sql);
          if ($result) {
          	echo '77 <div class="alert alert-success">
		      Category Added Successfully!
		     </div>';
          }else{
          	echo '<div class="alert alert-danger">Category not Added!</div>';
          }
         }
		}
	} catch (Exception $e) {
		echo '<div class="alert alert-danger">Something went Wrong!</div>';
	}
}

// Add Sub Category 
 
 public function addSubCategory($cat_name,$cat_id){
	try {
		$cat_id = $this->fm->validation($cat_id);
		$cat_name = $this->fm->validation($cat_name);
		$cat_id = mysqli_real_escape_string($this->db->link, $cat_id);
		$cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
		if (empty($cat_name) || empty($cat_id)) {
		echo '<div class="alert alert-danger">Sub Category Name is Required!</div>';
		}elseif((strlen($cat_name) < 3) || (strlen($cat_name) > 60)){
        echo '<div class="alert alert-warning">
	      Category name must be between 3 to 60 Characters!
	     </div>';
		}else{
          $csql = "SELECT * FROM category WHERE cat_name = '$cat_name' AND sub_id = $cat_id AND cat_status = 1";
          $cresult = $this->db->select($csql);
          if ($cresult != false) {
          	echo '<div class="alert alert-danger">This: <strong>'.$cat_name.'</strong> Sub Category Already Exists.!</div>';
          }else{
          $sql = "INSERT INTO category (cat_name,sub_id) VALUES('$cat_name',$cat_id)";
          $result = $this->db->insert($sql);
          if ($result) {
          	echo '33 <div class="alert alert-success">
		      Sub Category Added Successfully!
		     </div>';
          }else{
          	echo '<div class="alert alert-danger">Sub Category not Added!</div>';
          }
         }
		}
	} catch (Exception $e) {
		echo '<div class="alert alert-danger">Something went Wrong!</div>';
	}
}

// Category Delete by Cat id ..
public function deleteCategoryByCatId($cat_id=NULL){
  try {
	 $cat_id = $this->fm->validation($cat_id);
	 $cat_id = mysqli_real_escape_string($this->db->link, $cat_id);

	 if ((!empty($cat_id)) && (ctype_digit($cat_id) === true)) {	 
	 $sql = "SELECT * FROM category WHERE cat_id = $cat_id";
	 $result = $this->db->select($sql);
	 if ($result) {
	 	$delsql = "DELETE FROM category WHERE cat_id = $cat_id";
	 	$deldata = $this->db->delete($delsql);
	 	if ($deldata) {
	 	 $delsub = "DELETE FROM category WHERE sub_id = $cat_id";
	 	 $this->db->delete($delsub);
	 	echo '98 <div class="alert alert-success">This Category Delete Successfully!</div>';
	 	}
	 	
	 }else{
	 	echo '<div class="alert alert-danger">Something went Wrong!</div>';
	 }
	 }else{
	 	echo '<div class="alert alert-danger">Category id must not be Empty!</div>';
	 }
  } catch (Exception $e) {
	 echo '<div class="alert alert-danger">Something went Wrong!</div>';
  }
}

public function updateSubCategoryByCatId($cat_name,$cat_id){
  try {
		$cat_id = $this->fm->validation($cat_id);
		$cat_name = $this->fm->validation($cat_name);
		$cat_id = mysqli_real_escape_string($this->db->link, $cat_id);
		$cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
		if (empty($cat_name) || empty($cat_id)) {
		echo '<div class="alert alert-danger">Category Name is Required!</div>';
		}elseif((strlen($cat_name) < 3) || (strlen($cat_name) > 60)){
        echo '<div class="alert alert-warning">
	      Category name must be between 3 to 60 Characters!
	     </div>';
		}else{
          $sql = "UPDATE category SET cat_name = '$cat_name' WHERE cat_id = $cat_id AND sub_id = 0 AND cat_status = 1";
          $result = $this->db->update($sql);
          if ($result) {
          	echo '43 <div class="alert alert-success">
		      Category Update Successfully!
		     </div>';
          }else{
          	echo '<div class="alert alert-danger">Category not Updated!</div>';
          }
		}
	} catch (Exception $e) {
		echo '<div class="alert alert-danger">Something went Wrong!</div>';
	}	
}

// Delete Sub Category By Category Id ....
public function deleteSubCategoryByCatId($cat_id=NULL){
  try {
	 $cat_id = $this->fm->validation($cat_id);
	 $cat_id = mysqli_real_escape_string($this->db->link, $cat_id);

	 if ((!empty($cat_id)) && (ctype_digit($cat_id) === true)) { 
	 $sql = "SELECT * FROM category WHERE cat_id = $cat_id";
	 $result = $this->db->select($sql);
	 if ($result) {
	 	$delsql = "DELETE FROM category WHERE cat_id = $cat_id";
	 	$deldata = $this->db->delete($delsql);
	 	if ($deldata) {
	 	echo '53 <div class="alert alert-success">This Sub Category Delete Successfully!</div>';
	 	}
	 	
	 }else{
	 	echo '<div class="alert alert-danger">Something went Wrong!</div>';
	 }
	 }else{
	 	echo '<div class="alert alert-danger">Category id must not be Empty!</div>';
	 }
  } catch (Exception $e) {
	 echo '<div class="alert alert-danger">Something went Wrong!</div>';
  }
}


 }
?>