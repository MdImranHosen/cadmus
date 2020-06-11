<?php 
 if (realpath('inc/header.php')) {
   include_once 'inc/header.php';
 }
 if (realpath('inc/login_check.php')) {
   include_once 'inc/login_check.php';  
 }
?>
  <div class="container sign_backstyle">
    <div style="border: 1px solid #fff;padding: 8px 5px;">
    <div class="row justify-content-md-center istyle_topsapce">      
      <div class="col-lg-6 istyle_h1_h3 text-center">
      <h1>Hello</h1>
      <h3>Please Sign-in to Continue</h3>
      <div id="output_message"></div>
      <form id="signinform" action="" method="post">
        <div class="form-group istyle_inputform">
          <label style="color: #000;font-weight: bold;display: block;">Username</label>          
          <input type="text" id="username" class="form-control form-control-lg" name="username" placeholder="user">          
          <div class="invalid-feedback" id="err_username"> <strong>Username is Required!</strong> </div>
        </div>
        <div class="form-group istyle_inputform">
          <label>Password</label>
          <input type="text" id="password" class="form-control form-control-lg" name="password" placeholder="*************">
          <div class="invalid-feedback" id="err_password"> <strong>Password is Required!</strong> </div>
        </div>
        <div class="istyle_signbuttom"><button type="submit" id="sign-in-button" class="istyle_btn">Sign-In</button> <span class="istyle_stext"> or </span> <a href="sign-up.php" class="istyle_btn">Sign-Up</a></div>
      </form>
      </div>
    </div>
    </div>
  </div>
<?php 
 if (realpath('inc/footer.php')) {
   include 'inc/footer.php';
 }
?>
<script src="vendor/js/sign_in.js"></script>