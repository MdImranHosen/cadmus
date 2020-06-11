<?php
 /**
  * Cadmus_Api 
  */
class Cadmus_Api extends Mainclass{

   // User Sign up Operation...Start...
    public function userSignUpApi($phone,$username,$password) {
         
      try {
         $phone    = $this->fm->validation($phone);
         $username = $this->fm->validation($username);
         $password = $this->fm->validation($password);
         $phone    = mysqli_real_escape_string($this->db->link, $phone);
         $username = mysqli_real_escape_string($this->db->link, $username);
         $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($phone) || empty($username) || empty($password)) {

        $insertError = "Username,Phone,Password is Required!";
        $post_data = array(
        'status'=>'200',
              'data' => array(
                'error' => $insertError
              )
            );
        print json_encode($post_data);

        } elseif (is_numeric($phone) === false) {

        $insertError = "Phone number only allow Digits.";
        $post_data = array(
        'status'=>'200',
              'data' => array(
                'error' => $insertError
              )
            );
        print json_encode($post_data);
        } elseif ((strlen($username) < 4) || (strlen($username) > 100)) {

        $insertError = "Username must be between 4 to 100 Characters!";
        $post_data = array(
        'status'=>'200',
              'data' => array(
                'error' => $insertError
              )
            );
        print json_encode($post_data);
        } elseif ((strlen($phone) < 9) || (strlen($phone) > 15)) {

        $insertError = "Phone must be between 9 to 15 Characters!";
        $post_data = array(
        'status'=>'200',
              'data' => array(
                'error' => $insertError
              )
            );
        print json_encode($post_data);
        } elseif ((strlen($password) < 6) || (strlen($password) > 32)) {
          
        $insertError = "You should choose a strong password, between 6 to 32 characters.";
        $post_data = array(
        'status'=>'200',
              'data' => array(
                'error' => $insertError
              )
            );
        print json_encode($post_data);
        } else{
            
            $checksql = "SELECT * FROM users WHERE username = '$username' AND users_status = 2";
            $userCheck = $this->db->select($checksql);
            if ($userCheck != false) {

              $insertError = 'Username: <strong>'.$username.'</strong> Already Exists.';
              $post_data = array(
              'status'=>'200',
                    'data' => array(
                      'error' => $insertError
                    )
                  );
              print json_encode($post_data);
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
            $post_data = array(
              'status'=>'200',
                    'data' => array(
                      'error' => $err
                    )
                  );
              print json_encode($post_data);
          } else {

            $sql = "INSERT INTO users (username,user_password,otp,users_mobile,users_create_at,users_expaired_date) VALUES ('$username','$password','$otp','$phone','$create_datetime','$expaired_date')";
            $result = $this->db->insert($sql);
            if($result){
             $user_id = mysqli_insert_id($this->db->link);

              $insertSuccess = "OTP sent your phone!";
              $post_data = array(
                'status'=>'202',
                'users_id' => $user_id,
                'message' => 'Success',
                'data' => $insertSuccess
               
                    );
      
            print json_encode($post_data);
               
            } else{
              $insertError = 'Something Went Wrong!';
              $post_data = array(
              'status'=>'200',
                    'data' => array(
                      'error' => $insertError
                    )
                  );
              print json_encode($post_data);
            }
          }
          }
        }
         } catch (Exception $e) {
           $insertError = 'Something Went Wrong!';
              $post_data = array(
              'status'=>'200',
                    'data' => array(
                      'error' => $insertError
                    )
                  );
              print json_encode($post_data);
         }
    }
  // User Sign up Operation...END...

  // User Sign up OTP Operations...Start...
public function user_signup_otp_api($users_id,$dynamic_otp){

 try {
 $users_id    = $this->fm->validation($users_id);
 $dynamic_otp = $this->fm->validation($dynamic_otp);
 $users_id    = mysqli_real_escape_string($this->db->link,$users_id);
 $dynamic_otp = mysqli_real_escape_string($this->db->link,$dynamic_otp);

  if (empty($dynamic_otp) || empty($users_id)) {

        $insertError = 'OTP is Required!';
        $post_data = array(
        'status'=>'200',
              'data' => array(
                'error' => $insertError
              )
            );
        header('Content-type: application/json');
        print json_encode($post_data);
      } elseif ((strlen($dynamic_otp) < 3) || (strlen($dynamic_otp) > 6)) {
        $insertError = 'OTP must be between 3 and 6 Number!';
        $post_data = array(
        'status'=>'200',
              'data' => array(
                'error' => $insertError
              )
            );
        print json_encode($post_data);
      } elseif (is_numeric($dynamic_otp) === false) {
        $insertError = 'OTP only allow Digit.';
        $post_data = array(
        'status'=>'200',
              'data' => array(
                'error' => $insertError
              )
            );
        print json_encode($post_data);
      } else{
         $csql = "SELECT * FROM users WHERE otp = '$dynamic_otp' AND users_id = '$users_id'";
         $cresult = $this->db->select($csql);
         if ($cresult != false) {

             $sql = "UPDATE users SET users_status = 2 WHERE otp = '$dynamic_otp' AND users_id = '$users_id'";
           $result = $this->db->update($sql);
           if ($result) {
           $dbdata = array();

          while($row1 = $cresult->fetch_assoc()) {
             $dbdata[]=$row1;
           }

           $post_data = array(
           'status'=>'202',
           'message' => 'Success',
                'data' => $dbdata
              );
            print json_encode($post_data);

           } else{
              $insertError = 'Something went Wrong!';
              $post_data = array(
              'status'=>'200',
                    'data' => array(
                      'error' => $insertError
                    )
                  );
              print json_encode($post_data);
           }


         } else{
              $insertError = 'Wrong Information Included!';
              $post_data = array(
              'status'=>'200',
                    'data' => array(
                      'error' => $insertError
                    )
                  );
              print json_encode($post_data);
        } 
      }

    } catch (Exception $e) {
      $insertError = 'Something went Wrong!';
      $post_data = array(
      'status'=>'200',
            'data' => array(
              'error' => $insertError
            )
          );
      print json_encode($post_data);
    }
   }
 // User Sign up OTP Operations...End...

   // Users Login Script......
   public function users_sign_in_api($username,$password){

     try {
        date_default_timezone_set("Asia/Dhaka");
        $create_datetime = date("Y-m-d h:i:sa");

        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);        
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($username) || empty($password)) {

          $insertError = 'Field Must not be Empty!';
          $post_data = array(
          'status'=>'200',
                'data' => array(
                  'error' => $insertError
                )
              );
          print json_encode($post_data);

        } else if((strlen($username) > 100) || (strlen($username) < 4)){
          $insertError = 'Username must be between 4 and 100 Letter!';
          $post_data = array(
          'status'=>'200',
                'data' => array(
                  'error' => $insertError
                )
              );
          print json_encode($post_data);
        } else if((strlen($password) > 32) || (strlen($password) < 6)){
          
          $insertError = ' Password must be between 6 and 32 Letter!';
          $post_data = array(
          'status'=>'200',
                'data' => array(
                  'error' => $insertError
                )
              );
          print json_encode($post_data);
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

              $users_id = $value['users_id'];
              $users_name = $value['username'];

              $dt = date("d-m-Y-h:i:sa");
              $access_token_insert = md5($username.$users_id.$dt);
              $sqlAccessToken = "INSERT INTO access_token (user_id,TOKEN) VALUES('$users_id','$access_token_insert')";
             $this->db->insert($sqlAccessToken);

             $loginData[] = $value;

             $post_data = array(
             'status'=>'202',
             'message' => 'Success',
             'TOKEN' => $access_token_insert,
             'data' => $loginData
              );
            print json_encode($post_data);

           } else{
            $insertError = 'This Account Expaired Date Time!';
            $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
            print json_encode($post_data);
            }
           } else{
            $insertError = 'Unverified user Account!';
            $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
            print json_encode($post_data);
           }

           
           } else{
            $insertError = 'Wrong Information Included!';
            $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
            print json_encode($post_data);
          }           
         }
        } catch (Exception $e) { 
            $insertError = 'Something went Wrong!';
            $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
            print json_encode($post_data);
        }
  }

  // Duplicate Username Chack Operations...Start...
    public function usernameExists_Api($username){
      try {
        $username = $this->fm->validation($username);
        $username = mysqli_real_escape_string($this->db->link, $username);
        if (empty($username)) {
          $insertError = "Username is Required!";
            $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
            print json_encode($post_data);
        } elseif ((strlen($username) < 4) || (strlen($username) > 100)) {

           $insertError = 'Username must be between 4 to 100 Characters!';
            $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
            print json_encode($post_data);
        } else{
         $sql = "SELECT * FROM users WHERE username = '$username' AND users_status = 2";
         $result = $this->db->select($sql);
         if ($result) {
           $insertError = "Sorry! Has already taken. Please try another.";
            $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
            print json_encode($post_data);
         }else{
            $post_data = array(
             'status'=>'202',
             'message' => 'Ready'
              );
            print json_encode($post_data);
         }
        }
      } catch (Exception $e) {
         $insertError = "Something went Wrong.";
         $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
            print json_encode($post_data);
      }
    }
  // Duplicate Username Chack Operations...End...

   //Users information update...Strat....
   public function userInfoupApi($users_id,$users_mobile,$users_fullname,$users_email,$users_institute,$user_fb,$user_ing,$user_wp,$user_tw){
    try {
     $users_id       = $this->fm->validation($users_id);
     $users_mobile   = $this->fm->validation($users_mobile);
     $users_fullname = $this->fm->validation($users_fullname);
     $users_email    = $this->fm->validation($users_email);
     $users_institute= $this->fm->validation($users_institute);
     $user_fb        = $this->fm->validation($user_fb);
     $user_ing       = $this->fm->validation($user_ing);
     $user_wp        = $this->fm->validation($user_wp);
     $user_tw        = $this->fm->validation($user_tw);
     $users_id   = mysqli_real_escape_string($this->db->link, 
      $users_id);
     $users_mobile= mysqli_real_escape_string($this->db->link, 
      $users_mobile);
     $users_fullname = mysqli_real_escape_string($this->db->link, 
      $users_fullname);
     $users_email= mysqli_real_escape_string($this->db->link, 
      $users_email);
     $users_institute = mysqli_real_escape_string($this->db->link, 
      $users_institute);
     $user_fb  = mysqli_real_escape_string($this->db->link, $user_fb);
     $user_ing = mysqli_real_escape_string($this->db->link, $user_ing);
     $user_wp  = mysqli_real_escape_string($this->db->link, $user_wp);
     $user_tw  = mysqli_real_escape_string($this->db->link, $user_tw);

     $expr = '/^[1-9][0-9]*$/';

       if (empty($users_id)) {

          $errMsg = "User id is Required!";
           $post_data = array(
                  'status' => '200',
                  'data' => array(
                    'error' => $errMsg
                  )
           );
           print json_encode($post_data);
        }elseif(preg_match($expr, $users_id) == false || filter_var($users_id, FILTER_VALIDATE_INT) == false){

          $errMsg = "Invalid User id";
           $post_data = array(
                  'status' => '200',
                  'data' => array(
                    'error' => $errMsg
                  )
           );
           print json_encode($post_data);
        } elseif (empty($users_mobile)) {

         $insertError = "Phone Number is Required!";
         $post_data = array(
            'status'=>'200',
                  'data' => array(
                    'error' => $insertError
                  )
                );
          print json_encode($post_data);
        } elseif (is_numeric($users_mobile) === false) {
         $errMag = "Phone number only allow Digits.";
         $post_data = array(
              'status'=>'200',
              'data'=> array(
                 'error' => $errMag
              )
         );
         print json_encode($post_data);

        } elseif ((strlen($users_mobile) < 9) || (strlen($users_mobile) > 15)) {

           $errMsg = "Phone must be between 9 to 15 Characters!";
           $post_data = array(
                  'status' => '200',
                  'data' => array(
                    'error' => $errMsg
                  )
           );
           print json_encode($post_data);
        } else{

          if (!empty($users_email)) {
            $users_email = filter_var($users_email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($users_email, FILTER_VALIDATE_EMAIL)) {

            $errMsg = $users_email." Invalid Email Address.";
            $post_data = array(
                   'status'=>'200',
                   'data'=> array(
                       'error' => $errMsg
                   )
            );
            print json_encode($post_data);
           } else{
             $sql = "UPDATE users SET users_mobile = '$users_mobile', users_email = '$users_email', users_fullname = '$users_fullname', users_institute = '$users_institute', user_fb = '$user_fb', user_ing = '$user_ing', user_wp = '$user_wp', user_tw = '$user_tw' WHERE users_status = 2 AND users_id = $users_id";
             $result = $this->db->update($sql);
             if ($result != false) {

            $successMsg = "Profile info Updated!";
            $post_data = array(
                'status'=>'202',
                'message' => 'Success',
                'data' => $successMsg               
              );
            print json_encode($post_data);
         } else{

          $errMsg = "Something went Wrong!";
            $post_data = array(
                   'status'=>'200',
                   'data'=> array(
                       'error' => $errMsg
                   )
            );
            print json_encode($post_data);
         }
           }
          } else{
             $sql = "UPDATE users SET users_mobile = '$users_mobile', users_email = '$users_email', users_fullname = '$users_fullname', users_institute = '$users_institute', user_fb = '$user_fb', user_ing = '$user_ing', user_wp = '$user_wp', user_tw = '$user_tw' WHERE users_status = 2 AND users_id = $users_id";
             $result = $this->db->update($sql);
             if ($result != false) {

            $successMsg = "Profile info Updated!";
            $post_data = array(
                'status'=>'202',
                'message' => 'Success',
                'data' => $successMsg               
              );
            print json_encode($post_data);
         } else{

          $errMsg = "Something went Wrong!";
            $post_data = array(
                   'status'=>'200',
                   'data'=> array(
                       'error' => $errMsg
                   )
            );
            print json_encode($post_data);
         }
          }        
         
        }
    } catch (Exception $e) {
      $errMsg = "Something went Wrong!";
      $post_data = array(
             'status'=>'200',
             'data'=> array(
                 'error' => $errMsg
             )
      );
      print json_encode($post_data);
    }
   }

// User by id data get ...start..
   public function profileDataGetApi($users_id,$username){
    
    try {
      $users_id = $this->fm->validation($users_id);
      $username = $this->fm->validation($username);
      $users_id = mysqli_real_escape_string($this->db->link, $users_id);
      $username = mysqli_real_escape_string($this->db->link, $username);
      
      $exp = '/^[1-9][0-9]*$/';

      if (empty($users_id) || empty($username)){
         $errMsg = "User id & username is Required!";
         $post_data = array(
                'status' => '200',
                'data' => array(
                  'error' => $errMsg
                )
         );
         print json_encode($post_data);
      } elseif(preg_match($exp, $users_id) == false || filter_var($users_id, FILTER_VALIDATE_INT) == false){
         $errMsg = "Invalid User id";
         $post_data = array(
                'status' => '200',
                'data' => array(
                  'error' => $errMsg
                )
         );
         print json_encode($post_data);
      } else {
        $sql = "SELECT * FROM users WHERE users_id = '$users_id' AND users_status = 2 AND username = '$username'";
        $result = $this->db->select($sql);
        if ($result) {
          $data = array();
          while ($row = $result->fetch_assoc()) {
            $data[] = $row;
          }
          $post_data = array(
               'status' => '202',
               'data' => $data 
          );
          print json_encode($post_data);
        }
      }
    } catch (Exception $e) {
      $errMsg = "Something went Wrong!";
      $post_data = array(
             'status'=>'200',
             'data'=> array(
                 'error' => $errMsg
             )
      );
      print json_encode($post_data);
    }
   }

// User Profile Image Change ....
   public function changeProfileImage($user_id,$profile_image){
    try {
      $user_id = $this->fm->validation($user_id);
      $user_id = mysqli_real_escape_string($this->db->link, $user_id);

      $exp = '/^[1-9][0-9]*$/';

      if (empty($user_id) || empty($username)){
         $errMsg = "User id & username is Required!";
         $post_data = array(
                'status' => '200',
                'data' => array(
                  'error' => $errMsg
                )
         );
         print json_encode($post_data);
      } elseif(preg_match($exp, $user_id) == false || filter_var($user_id, FILTER_VALIDATE_INT) == false){
         $errMsg = "Invalid User id";
         $post_data = array(
                'status' => '200',
                'data' => array(
                  'error' => $errMsg
                )
         );
         print json_encode($post_data);
      } else if ((!empty($user_id)) && (ctype_digit($user_id) === true) && (!empty($profile_image))) {

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

        $errMsg = "You can uploads only:-".implode(', ', $permitted);
         $post_data = array(
                'status' => '200',
                'data' => array(
                  'error' => $errMsg
                )
         );
         print json_encode($post_data);
        
       } else if ($size_img > 1048576){
        $errMsg ="Image Size Should be less then 1 MB !";
        $post_data = array(
                'status' => '200',
                'data' => array(
                  'error' => $errMsg
                )
         );
         print json_encode($post_data);
       } else if(($width<145 || $width>155) || ($height<145 || $height>155 )){          
        $errMsg ="Image Size Should 150*150PX!";
        $post_data = array(
                'status' => '200',
                'data' => array(
                  'error' => $errMsg
                )
         );
         print json_encode($post_data);
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
            $successMsg = "Profile Image Change Successfully!";
            $post_data = array(
               'status'=>'202',
               'message'=>'Success',
               'data'=> $successMsg
            );
            print json_encode($post_data);         
           } else{
            $errMsg ="Something went wrong!";
            $post_data = array(
                    'status' => '200',
                    'data' => array(
                      'error' => $errMsg
                    )
             );
             print json_encode($post_data);
           }
           }
         }
      }
    } catch (Exception $e) {
      $errMsg ="Something went wrong!";
      $post_data = array(
              'status' => '200',
              'data' => array(
                'error' => $errMsg
              )
       );
       print json_encode($post_data);
    }
   }






 }
?>