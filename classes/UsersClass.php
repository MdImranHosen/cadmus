<?php
/**
 * User for UsersClass controller
 */
class UsersClass extends Mainclass
{

// Users Login Script......
   public function user_login($username,$password){

     try {
        date_default_timezone_set("Asia/Dhaka");
        $create_datetime = date("Y-m-d h:i:sa");

        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);        
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($username) || empty($password)) {
          $msg = '<div class="alert alert-warning" role="alert">
                  Field Must not be Empty!
                 </div>';
          return $msg;

        } else if((strlen($username) > 100) || (strlen($username) < 4)){
          $msg = '<div class="alert alert-warning" role="alert">
                  Username must be between 4 and 100 Letter!
                 </div>';
          return $msg;
        } else if((strlen($password) > 32) || (strlen($password) < 6)){
          $msg = '<div class="alert alert-warning" role="alert">
                  Password must be between 6 and 32 Letter!
                 </div>';
          return $msg;
        } else{
           $password = md5($password);
           $sql = "SELECT * FROM users WHERE username = '$username' AND user_password = '$password'";
           $check = $this->db->select($sql);
           if ($check) {
            $query = "SELECT * FROM users WHERE username = '$username' AND user_password = '$password' AND users_status = 2";
           $sresult = $this->db->select($query);
           if ($sresult != false) {
            $dtsql = "SELECT * FROM users WHERE users_expaired_date > '$create_datetime' AND username = '$username' AND user_password = '$password' AND users_status = 2";
           $result = $this->db->select($dtsql);
           if ($result != false) {
              $value = $result->fetch_assoc();
              Session::set("login", true);
              Session::set("user_id", $value['users_id']);
              Session::set("username", $value['username']);

              $users_id = $value['users_id'];
              $dt = date("d-m-Y-h:i:sa");
              $access_token_insert = md5($username.$users_id.$dt);
              Session::set("access_token", $access_token_insert);
             $sqlAccessToken = "INSERT INTO access_token (user_id,TOKEN) VALUES('$users_id','$access_token_insert')";
             $this->db->insert($sqlAccessToken);   
             $token_id = mysqli_insert_id($this->db->link);
             Session::set("token_id", $token_id);
             //header("Location:../users");
             $msg = "login";
             return $msg;
           } else{
             $msg = '<div class="alert alert-danger" role="alert">
                  This Account Expaired Date Time!
                 </div>';
             return $msg;
            }
           } else{
             $msg = '<div class="alert alert-danger" role="alert">
                  Unverified user Account!
                 </div>';
             return $msg;
           }

           
           } else{
            $msg = '<div class="alert alert-danger" role="alert">
                  Wrong Information Included ghgf!
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
 
    // Access Token Check Login ...
    public function checkUserLogin($acs_token,$user_id,$token_id){

      try {
        
        $acs_token = $this->fm->validation($acs_token);
        $user_id   = $this->fm->validation($user_id);
        $token_id  = $this->fm->validation($token_id);
        $acs_token = mysqli_real_escape_string($this->db->link, $acs_token);
        $user_id   = mysqli_real_escape_string($this->db->link, $user_id);
        $token_id  = mysqli_real_escape_string($this->db->link, $token_id);
        $sql = "SELECT * FROM access_token WHERE TOKEN = '$acs_token' AND user_id = '$user_id' AND id = $token_id";
        $result = $this->db->select($sql);
        return $result;
      } catch (Exception $e) {
        
      }
        
    }
   
    // User Sign up Operation...Start...
    public function user_signup($phone,$username,$password) {
         
      try {
         $phone    = $this->fm->validation($phone);
         $username = $this->fm->validation($username);
         $password = $this->fm->validation($password);
         $phone    = mysqli_real_escape_string($this->db->link, $phone);
         $username = mysqli_real_escape_string($this->db->link, $username);
         $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($phone) || empty($username) || empty($password)) {
           echo '<div class="alert alert-warning" role="alert">
                  Username,Phone,Password is Required!
                 </div>';
        } elseif (is_numeric($phone) === false) {
         echo "<div class='alert alert-danger'>Phone number only allow Digits. </div>";
        } elseif ((strlen($username) < 4) || (strlen($username) > 100)) {
           echo '<div class="alert alert-danger" role="alert">
                  Username must be between 4 to 100 Characters! 
                 </div>';
        } elseif ((strlen($phone) < 9) || (strlen($phone) > 15)) {
           echo '<div class="alert alert-danger" role="alert">
                  Phone must be between 9 to 15 Characters!
                 </div>';
        } elseif ((strlen($password) < 6) || (strlen($password) > 32)) {
           echo '<div class="alert alert-danger" role="alert">
                  You should choose a strong password, between 6 to 32 characters 
                 </div>';
        } else{
            
            $checksql = "SELECT * FROM users WHERE username = '$username' AND users_status = 2";
            $userCheck = $this->db->select($checksql);
            if ($userCheck != false) {
               echo '<div class="alert alert-danger" role="alert">
                  Username: <strong>'.$username.'</strong> Already Exists.
                 </div>';
            } else{

            date_default_timezone_set("Asia/Dhaka");
            
            //$otp = random_int(1000, 9999);
            $otp = rand(1000, 9999);
            $password = md5($password);
            $create_datetime = date("Y-m-d h:i:sa");
            $d = strtotime("+1 Months");
            $expaired_date = date("Y-m-d h:i:sa", $d);

            $phone = "88".$phone;

            $msg = "OTP%20is:%20".$otp;

            $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://bulksms.teletalk.com.bd/link_sms_send.php?op=SMS&user=CoE-DU&pass=123456&mobile=".$phone."&charset=ASCII&sms=".$msg,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

          if ($err) {
            echo "cURL Error #:" . $err;
          } else {

            $sql = "INSERT INTO users (username,user_password,otp,users_mobile,users_create_at,users_expaired_date) VALUES ('$username','$password','$otp','$phone','$create_datetime','$expaired_date')";
            $result = $this->db->insert($sql);
            if($result){
              $user_id = mysqli_insert_id($this->db->link);
              $output = '11<div id="otp_msg"><div class="alert alert-success" role="alert"> OTP sent your phone!
                 </div></div><form id="otp_form" action="" method="post"><input type="hidden" id="user_id" name="user_id" value="'.$user_id.'" /><div class="form-group istyle_inputform">
          <label>Dynamic OTP Sent to you</label>
          <input type="text" class="form-control form-control-lg" id="dynamic_otp" name="dynamic_otp" placeholder="*************">
          <div class="invalid-feedback" id="err_dynamic_otp"> <strong> OTP is Required!</strong> </div>
        </div>
        <div class="istyle_signbuttom"><button type="submit" class="istyle_btn">OK</button></div></form>';
           echo $output;
               
            } else{
               echo '<div class="alert alert-danger" role="alert">
                  Something Went Wrong!
                 </div>';
            }
          }
          }
        }
         } catch (Exception $e) {
           
         }
    }
  // User Sign up Operation...END...
  // Duplicate Username Chack Operations...Start...
    public function usernameExists($username){
      try {
        $username = $this->fm->validation($username);
        $username = mysqli_real_escape_string($this->db->link, $username);
        if (empty($username)) {
          echo "Username is Required!";
        } elseif ((strlen($username) < 4) || (strlen($username) > 100)) {
           echo 'Username must be between 4 to 100 Characters!';
        } else{
         $sql = "SELECT * FROM users WHERE username = '$username' AND users_status = 2";
         $result = $this->db->select($sql);
         if ($result) {
           echo "Sorry! Has already taken. Please try another.";
         }else{
          echo "ready";
         }
        }
      } catch (Exception $e) {
        
      }
    }
  // Duplicate Username Chack Operations...End...

  // User Sign up OTP Operations...Start...
   public function user_signup_otp($user_id,$dynamic_otp){

    try {
      $dynamic_otp = $this->fm->validation($dynamic_otp);
      $dynamic_otp = mysqli_real_escape_string($this->db->link,$dynamic_otp);
      if (empty($dynamic_otp)) {
        echo '<div class="alert alert-warning" role="alert">
            OTP is Required!
           </div>';
      } elseif ((strlen($dynamic_otp) < 3) || (strlen($dynamic_otp) > 6)) {
        echo '<div class="alert alert-danger" role="alert">
                  OTP must be between 3 and 6 Number!
                 </div>';
      } elseif (is_numeric($dynamic_otp) === false) {
         echo "<div class='alert alert-danger'>OTP only allow Digit. </div>";
      } else{
         $csql = "SELECT * FROM users WHERE otp = '$dynamic_otp' AND users_id = '$user_id'";
         $cresult = $this->db->select($csql);
         if ($cresult != false) {
             $sql = "UPDATE users SET users_status = 2 WHERE otp = '$dynamic_otp' AND users_id = '$user_id'";
           $result = $this->db->update($sql);
           if ($result) {
            echo '44<div class="alert alert-success" role="alert">
                    Registration Successfully! <a href="/cadmus"><u>Login</u></a>
                   </div>';
           } else{
             echo '<div class="alert alert-danger" role="alert">
                   Something went Wrong!
                   </div>';
           }
         } else{
             echo '<div class="alert alert-danger" role="alert">
                   Wrong Information Included!
                   </div>';
        } 
      }

    } catch (Exception $e) {
      
    }
   }
 // User Sign up OTP Operations...End...
   
// User by id data get ...start..
   public function getUserDatabyId($user_id,$username){
    
    try {
      $user_id  = $this->fm->validation($user_id);
      $username = $this->fm->validation($username);
      $user_id  = mysqli_real_escape_string($this->db->link, $user_id);
      $username = mysqli_real_escape_string($this->db->link, $username);
      if (!empty($user_id)) {
        $sql = "SELECT * FROM users WHERE users_id = '$user_id' AND users_status = 2 AND username = '$username'";
        $result = $this->db->select($sql);
        if ($result) {
          return $result;
        }
      }
    } catch (Exception $e) {
      
    }
   }

 //Users information update...Strat....
   public function userinfoup($user_id,$user_phone,$full_name,$users_email,$users_institute,$user_fb,$user_ing,$user_wp,$user_tw){
    try {
     $user_id        = $this->fm->validation($user_id);
     $user_phone     = $this->fm->validation($user_phone);
     $full_name      = $this->fm->validation($full_name);
     $users_email    = $this->fm->validation($users_email);
     $users_institute= $this->fm->validation($users_institute);
     $user_fb        = $this->fm->validation($user_fb);
     $user_ing       = $this->fm->validation($user_ing);
     $user_wp        = $this->fm->validation($user_wp);
     $user_tw        = $this->fm->validation($user_tw);
     $user_id   = mysqli_real_escape_string($this->db->link, $user_id);
     $user_phone= mysqli_real_escape_string($this->db->link, $user_phone);
     $full_name = mysqli_real_escape_string($this->db->link, $full_name);
     $users_email= mysqli_real_escape_string($this->db->link, $users_email);
     $users_institute = mysqli_real_escape_string($this->db->link, $users_institute);
     $user_fb  = mysqli_real_escape_string($this->db->link, $user_fb);
     $user_ing = mysqli_real_escape_string($this->db->link, $user_ing);
     $user_wp  = mysqli_real_escape_string($this->db->link, $user_wp);
     $user_tw  = mysqli_real_escape_string($this->db->link, $user_tw);

        if (empty($user_phone)) {
           echo '<div class="alert alert-warning" role="alert">
                  Phone is Required!
                 </div>';
        } elseif (is_numeric($user_phone) === false) {
         echo "<div class='alert alert-danger'>Phone number only allow Digits. </div>";
        } elseif ((strlen($user_phone) < 9) || (strlen($user_phone) > 15)) {
           echo '<div class="alert alert-danger" role="alert">
                  Phone must be between 9 to 15 Characters!
                 </div>';
        } else{

          if (!empty($users_email)) {
            $users_email = filter_var($users_email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($users_email, FILTER_VALIDATE_EMAIL)) {
           echo '<div class="alert alert-danger" role="alert">
                  Invalid Email.
                 </div>';
           }
          }
         $sql = "UPDATE users SET users_mobile = '$user_phone', users_email = '$users_email', users_fullname = '$full_name', users_institute = '$users_institute', user_fb = '$user_fb', user_ing = '$user_ing', user_wp = '$user_wp', user_tw = '$user_tw'  WHERE users_id = '$user_id'";
         $result = $this->db->update($sql);
         if ($result) {
          echo '65<div class="alert alert-success" role="alert">
                  Profile info Updated!
                 </div>'; 
         } else{
          echo '<div class="alert alert-danger" role="alert">
                  Something went Wrong!
                 </div>'; 
         }
        }
    } catch (Exception $e) {
      echo '<div class="alert alert-danger" role="alert">
                  Something went Wrong!
                 </div>'; 
    }
   }

// Get All Category ....Query..
   public function getCategorys(){
    try {
      $sql = "SELECT * FROM category WHERE sub_id = 0 AND cat_status = 1 ORDER BY cat_id DESC";
      $result = $this->db->select($sql);
      return $result;
    } catch (Exception $e) {
      
    }
   }

// Get Category By Sub Category ...
   public function getCatIdBySubCat($cat_id=NULL){
    try {
      $cat_id = $this->fm->validation($cat_id);
      $cat_id = mysqli_real_escape_string($this->db->link, $cat_id);
      if ((!empty($cat_id)) && (ctype_digit($cat_id) === true)) {
        $sql = "SELECT * FROM category WHERE sub_id = $cat_id AND cat_status = 1";
        $result = $this->db->select($sql);
        return $result;
      }
    } catch (Exception $e) {
      
    }
   }

// Add Asq Question...Start...
   public function addAsqQuestion($user_id,$cat_id,$sub_cat,$asq_title,$description){
    try {
      $user_id     = $this->fm->validation($user_id);
      $cat_id      = $this->fm->validation($cat_id);
      $sub_cat     = $this->fm->validation($sub_cat);
      $asq_title   = $this->fm->validation($asq_title);
      $description = $this->fm->validation($description);
      $user_id   = mysqli_real_escape_string($this->db->link, $user_id);
      $cat_id    = mysqli_real_escape_string($this->db->link, $cat_id);
      $sub_cat   = mysqli_real_escape_string($this->db->link, $sub_cat);
      $asq_title = mysqli_real_escape_string($this->db->link, $asq_title);
      $description = mysqli_real_escape_string($this->db->link, $description);
      if (empty($user_id) || empty($cat_id) || empty($sub_cat) || empty($asq_title) || empty($description)) {
        echo '<div class="alert alert-danger">Field must not be Empty! </div>';
      } elseif((strlen($asq_title) < 4) || (strlen($asq_title) > 250)){
        echo '<div class="alert alert-danger"> Question Title between 4 & 250 Characters. </div>';
      } elseif((strlen($asq_title) < 2) || (strlen($asq_title) > 350)){
        echo '<div class="alert alert-danger"> Question Title between 4 & 250 Characters.</div>';
      } else{
        $csql = "SELECT * FROM asq_questions WHERE asq_title = '$asq_title'";
        $cresult = $this->db->select($csql);
        if ($cresult != false) {
          echo '<div class="alert alert-danger">This Question Title Already Exists!</div>';
        } else{
        $sql = "INSERT INTO asq_questions (users_id,cat_id,sub_cat_id,asq_title,description) VALUES($user_id,$cat_id,$sub_cat,'$asq_title','$description')";
        $insert = $this->db->insert($sql);
        if ($insert) {
          echo '77<div class="alert alert-success">Question Add Successfully!</div>';
        }else{
           echo '<div class="alert alert-danger">Something went Wrong. </div>';
        }
       }
      }

    } catch (Exception $e) {
      echo '<div class="alert alert-danger">Something went Wrong. </div>';
    }
   }

 // get all Asq Question...
   public function getAllQuestion(){
    try {
      $sql = "SELECT asq_questions.*, category.cat_name, (SELECT category.cat_name FROM category WHERE category.cat_id = asq_questions.sub_cat_id) as subcat_name FROM asq_questions JOIN category ON category.cat_id = asq_questions.cat_id WHERE asq_questions.asq_status = 1 ORDER BY asq_questions.asq_id DESC";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }
    } catch (Exception $e) {
      
    }
   }
// Get all Videos .....
   public function getAllVideo(){
    try {
      $sql = "SELECT * FROM videos WHERE video_status = 1 ORDER BY video_id DESC";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }  
    } catch (Exception $e) {
      
    }
   }
// View Video By Video Id ...
   public function viewVideoByvideoId($video_id=NULL){
    try {
      $video_id = $this->fm->validation($video_id);
      $video_id = mysqli_real_escape_string($this->db->link, $video_id);
      if ((!empty($video_id)) && (ctype_digit($video_id) === true)) {
        $sql = "SELECT * FROM videos WHERE video_status = 1 AND video_id = '$video_id'";
        $result = $this->db->select($sql);
        if ($result) {
          while ($row = $result->fetch_assoc()) {
            $video_id   = $row['video_id'];
            $video_name = $row['video_name'];
            $video_div  = explode('.', $video_name);
            $video_ext  = strtolower(end($video_div));

            echo '<video class="cstyle_video" controls>
            <source src="../media/video/'.$video_id.'/'.$video_name.'" type="video/'.$video_ext.'">
            </video>';
          }
        }
      }
    } catch (Exception $e) {
      
    }
   }
// User Profile Image Change ....
   public function changeProfileImage($user_id,$profile_image){
    try {
      $user_id = $this->fm->validation($user_id);
      $user_id = mysqli_real_escape_string($this->db->link, $user_id);

      if ((!empty($user_id)) && (ctype_digit($user_id) === true) && (!empty($profile_image))) {

          $permitted  = array('png', 'jpg', 'jpeg', 'gif');
          $image_tmp  = $profile_image['tmp_name'];
          $name_img   = $profile_image['name'];
          $size_img   = $profile_image['size'];
          $image_div  = explode('.', $name_img);
          $image_ext  = strtolower(end($image_div));

          $data = getimagesize($image_tmp);
          $width  = $data[0];
          $height = $data[1];
        
        if (in_array($image_ext, $permitted) === false) {
        echo "<div class='alert alert-danger'> You can uploads only:-".implode(', ', $permitted)."</div>";
        
       } else if ($size_img > 1048576){
        echo "<div class='alert alert-danger'> Image Size Should be less then 1 MB !</div>";
       } else if(($width<145 || $width>155) || ($height<145 || $height>155 )){          
        echo "<div class='alert alert-danger'> Image Size Should 150*150PX !</div>";
      } else{
               
           $targetDir = "../img/".$user_id."/";                  

            if(!is_dir($targetDir)){
               mkdir($targetDir, 0777, true);
            }
            
            if (file_exists($targetDir)) {
             array_map('unlink', glob($targetDir."*"));
            }

          $targetPath = $targetDir.$name_img;
          if (move_uploaded_file($image_tmp,$targetPath)) {

            $sql = "UPDATE users SET
                    profile_image = '$name_img'
                    WHERE users_id = '$user_id'";
           $result = $this->db->update($sql);
           if($result) {
            echo '55 <div class="alert alert-success">Profile Image Change Successfully! </div>';            
           } else{
            echo "<div class='alert alert-danger'> Something went wrong! </div>";
           }
           }
         }
      }
    } catch (Exception $e) {
      echo '<div class="alert alert-danger">Something went Wrong!</div>';
    }
   }








 
     //User By Id Edit code here....
     public function getUserEditById($data,$file,$id){
         $name     = $data['USER_FULL_NAME'];
         $email    = $data['USER_EMAIL'];
         $phone    = $data['USER_MOBILE'];
         $h_add    = $data['USER_HOME_ADDRESS'];
         $o_add    = $data['USER_OFFICE_ADDRESS'];
         $point    = $data['USER_POINT'];
         $password = $data['USER_PASSWORD'];
         
         $name     = $this->fm->validation($name);
         $email    = $this->fm->validation($email);
         $phone    = $this->fm->validation($phone);
         $h_add    = $this->fm->validation($h_add);
         $o_add    = $this->fm->validation($o_add);
         $point    = $this->fm->validation($point);
         $password = $this->fm->validation($password);

         $name     = mysqli_real_escape_string($this->db->link, $name);
         $email    = mysqli_real_escape_string($this->db->link, $email);
         $phone    = mysqli_real_escape_string($this->db->link, $phone);
         $h_add    = mysqli_real_escape_string($this->db->link, $h_add);
         $o_add    = mysqli_real_escape_string($this->db->link, $o_add);
         $point    = mysqli_real_escape_string($this->db->link, $point);
         $password = mysqli_real_escape_string($this->db->link, $password);
         $email = filter_var($email, FILTER_SANITIZE_EMAIL);
         
         
         $permitted    = array('png', 'jpg', 'jpeg', 'gif');
         $file_name    = $file['USER_PROFILE_IMAGE']['name'];
         $file_size    = $file['USER_PROFILE_IMAGE']['size'];
         $file_temp    = $file['USER_PROFILE_IMAGE']['tmp_name'];
         $div          = explode('.', $file_name);
         $image_ext    = strtolower(end($div));

        if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        	$msg = '<div class="alert alert-warning" role="alert">
                  Name,Email,Phone,password Field Must not be Empty!
                 </div>';
        	return $msg;

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        	$msg = '<div class="alert alert-danger" role="alert">
                  Invalid Email.
                 </div>';
                 return $msg;
        } else{
            /*$imagecheck = "images/".$id."/".$file_name;
            
            $checksql = "SELECT * FROM USER WHERE USER_FULL_NAME = '$name' AND USER_EMAIL = '$email' AND USER_MOBILE = '$phone' AND USER_PASSWORD = '$password' AND USER_HOME_ADDRESS = '$h_add' AND USER_OFFICE_ADDRESS = '$o_add' AND USER_POINT = '$point' AND USER_PROFILE_IMAGE = '$imagecheck' AND USER_ID = '$id'";
            $emailCheck = $this->db->select($checksql);
            if ($emailCheck == true){
               $msg = '<div class="alert alert-danger" role="alert">
                  User Data Does Not Change!
                 </div>';
                 return $msg; 
            } else{*/
                
                
            if(!empty($file_name)){
            
             if ($file_size > 500000) {
             
	      $msg = '<div class="alert alert-danger" role="alert"> 
	             Sorry, your file is too large.
	      </div>';
	      return $msg;
            
	      
         }elseif (in_array($image_ext, $permitted) === false) {
             
	      $msg = '<div class="alert alert-danger" role="alert">
	      You can uploads only:-'.implode(', ', $permitted).'</div>';
	      return $msg;
            
	      
         } else{
             
                /////////////
        $unique_image = $div[0].'.'.$image_ext;
        
        $upload_path = "../user_app/images/".$id."/";
        
        if (!is_dir($upload_path)) {    // Direcatory checking 
        mkdir($upload_path, 0777, true);
        }
        
         if (glob($upload_path."*")) {
             
             array_map('unlink', glob($upload_path."*"));
             
          }
          
          $image_path = $upload_path.$unique_image;
          
             /////////
            
            move_uploaded_file($file_temp, $image_path);
            
            $sqlup = "UPDATE USER SET 
                        USER_FULL_NAME      = '$name',
                        USER_EMAIL          = '$email',
                        USER_MOBILE         = '$phone',
                        USER_PASSWORD       = '$password',
                        USER_HOME_ADDRESS   = '$h_add',
                        USER_OFFICE_ADDRESS = '$o_add',
                        USER_POINT          = '$point',
                        USER_PROFILE_IMAGE = '$image_path'
                        WHERE USER_ID       = '$id'";
            $result = $this->db->update($sqlup);
            if($result){
                $msg = '<div class="alert alert-success" role="alert">
                  User Edit Successfully!
                 </div>';
                 return $msg;
            } else{
               $msg = '<div class="alert alert-danger" role="alert">
                  Something Went Wrong!
                 </div>';
                 return $msg; 
            }
            
            } 
                
            } else{
                
                $sqlup = "UPDATE USER SET 
                        USER_FULL_NAME      = '$name',
                        USER_EMAIL          = '$email',
                        USER_MOBILE         = '$phone',
                        USER_PASSWORD       = '$password',
                        USER_HOME_ADDRESS   = '$h_add',
                        USER_OFFICE_ADDRESS = '$o_add',
                        USER_POINT          = '$point'
                        WHERE USER_ID       = '$id'";
            $result = $this->db->update($sqlup);
            if($result){
                $msg = '<div class="alert alert-success" role="alert">
                  User Edit Successfully!
                 </div>';
                 return $msg;
            } else{
               $msg = '<div class="alert alert-danger" role="alert">
                  Something Went Wrong!
                 </div>';
                 return $msg; 
            }
            }
            
          /*}*/
        } 
     }
     

  
  // Get Contact us User Message List
   public function getContactUserMessageList(){
    $sql = "SELECT CONTACTS.*, USER.USER_FULL_NAME, USER.USER_EMAIL, USER.USER_MOBILE  FROM CONTACTS JOIN USER ON USER.USER_ID = CONTACTS.USER_ID WHERE USER.USER_ID = CONTACTS.USER_ID  ORDER BY CONTACTS.C_ID DESC";
    $result = $this->db->select($sql);
    return $result;
  }
  
  public function getUserMessageViewId($id){
    $sql = "SELECT CONTACTS.*, USER.USER_FULL_NAME, USER.USER_EMAIL, USER.USER_MOBILE  FROM CONTACTS JOIN USER ON USER.USER_ID = CONTACTS.USER_ID WHERE USER.USER_ID = CONTACTS.USER_ID  AND CONTACTS.C_ID = '$id'";
    $result = $this->db->select($sql);
    return $result;
  }
  
  
}
