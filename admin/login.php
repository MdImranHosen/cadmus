<?php 
 date_default_timezone_set("Asia/Dhaka");
 
 if (realpath('../classes/Mainclass.php')) {
   include_once "../classes/Mainclass.php";
   Session::checkLogin();
 } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CADMUS</title>
  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../vendor/css/simple-sidebar.css" rel="stylesheet">
  <link href="../icon/css/font-awesome.min.css" rel="stylesheet">
  <link href="../vendor/css/istyle.css" rel="stylesheet" type="text/css">
  </head>
  <body style="background-color: #525659;">  

  <div class="container sign_backstyle">
    <div style="border: 1px solid #fff;padding: 8px 5px;">
    <div class="row justify-content-md-center istyle_topsapce">      
      <div class="col-lg-6 istyle_2h1_h3 text-center">
      <h1>Admin <small>Panel</small> </h1>
      <h3>Please Login to Continue</h3>
      <div id="output_message"></div>
      <form id="loginform" action="" method="post">
        <div class="form-group istyle_inputform">
          <label style="color: #000;font-weight: bold;display: block;">Username</label>          
          <input type="text" id="admin_user" class="form-control form-control-lg" name="admin_user" placeholder="Admin">          
          <div class="invalid-feedback" id="err_admin_user"> <strong>Username is Required!</strong> </div>
        </div>
        <div class="form-group istyle_inputform">
          <label>Password</label>
          <input type="text" id="admin_pass" class="form-control form-control-lg" name="admin_pass" placeholder="*************">
          <div class="invalid-feedback" id="err_admin_pass"> <strong>Password is Required!</strong> </div>
        </div>
        <div class="istyle_signbuttom"><button type="submit" id="sign-in-button" class="istyle_btn istyle_btn_admin">LogIn</button></div>
      </form>
      </div>
    </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script src="../vendor/js/login_in.js"></script>