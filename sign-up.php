<?php 
 if (realpath('inc/header.php')) {
   include 'inc/header.php';
 }
 if (realpath('inc/login_check.php')) {
   include_once 'inc/login_check.php';  
 }
?>
  <div class="container signup_backstyle">
    <div style="border: 1px solid #fff;padding: 8px 5px;">
    <div class="row justify-content-md-center istyle_topsapce">      
      <div class="col-lg-6 istyle_sign_h1_h3 text-center">
      <h1>Sign<span style="color: #fff;">Up</span></h1>
      <h3>It’s Completely Free!</h3>
      <div id="output_message"></div>
      <div id="output_otpfrom">
      <form id="signupform" action="" method="post">
        <div class="form-group istyle_inputform">
          <label>Username</label>
          <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="username">
          <div class="invalid-feedback" id="err_username"> <strong> Username is Required!</strong> </div>
        </div>
        <div class="form-group istyle_inputform">
          <label>Phone Number</label>
          <input type="text" class="form-control form-control-lg" id="phone" name="phone" placeholder="017********">
          <div class="invalid-feedback" id="err_phone"> <strong> Phone is Required!</strong> </div>
        </div>
        <div class="form-group istyle_inputform">
          <label>Password</label>
          <input type="text" class="form-control form-control-lg" id="password" name="password" placeholder="*************">
          <div class="invalid-feedback" id="err_password"> <strong> Password is Required!</strong> </div>
        </div>
        <div class="istyle_signbuttom"><button type="submit" class="istyle_btn">Join our Community</button></div>
      </form>
    </div>
      </div>
    </div>
    </div>
  </div>

<?php 
 if (realpath('inc/footer.php')) {
   include 'inc/footer.php';
 }
?>
<script src="vendor/js/sign_up.js"></script>