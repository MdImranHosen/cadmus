<?php 
 if (realpath('inc/header.php')) {
   include_once 'inc/header.php';
 }
?> 
<?php 
 if (class_exists('UsersClass')) {
 	$users = new UsersClass();
 	if (method_exists($users, 'getUserDatabyId')) {
 		$udata = $users->getUserDatabyId($user_id,$username);
 		if ($udata) {
 			while ($urow = $udata->fetch_assoc()) {      
      $profile_path = "../img/".$urow['users_id'];
 			if ($files = glob($profile_path."/*")){
			   $profile_img=$files[0];
		    }else{
			   $profile_img= "../img/user.svg";
		      }		
 ?>

<!-- Modal -->
<div class="modal fade" id="profile_edit_modal" tabindex="-1" role="dialog" aria-labelledby="profileModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModal"><i class="fa fa-user"></i> Personal Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="personal_info_update" action="" method="post">
      <div class="modal-body">
      	<div id="output_message"></div>
      	<input type="hidden" name="user_id" id="user_id" value="<?php echo $urow['users_id']; ?>">
        <div class="form-group">
        <label for="full_name" class="col-form-label">Full Name:</label>
        <input type="text" class="form-control" value="<?php echo $urow['users_fullname']; ?>" name="full_name" id="full_name">
      </div>
      <div class="form-group">
        <label for="user_phone" class="col-form-label">Phone Number:</label>
        <input type="text" class="form-control" value="<?php echo $urow['users_mobile']; ?>" name="user_phone" id="user_phone">
        <div class="invalid-feedback" id="err_phone"> <strong> Phone is Required!</strong> </div>
      </div>
      <div class="form-group">
        <label for="users_email" class="col-form-label">Email Address:</label>
        <input type="text" class="form-control" value="<?php echo $urow['users_email']; ?>" name="users_email" id="users_email">
        <div class="invalid-feedback" id="err_email"> <strong> Invalid Email!</strong> </div>
      </div>
      <div class="form-group">
        <label for="users_institute" class="col-form-label">Institute:</label>
        <input type="text" class="form-control" value="<?php echo $urow['users_institute']; ?>" name="users_institute" id="users_institute">
      </div>
      <div class="form-group">
        <label for="user_fb" class="col-form-label">Facebook:</label>
        <input type="text" class="form-control" value="<?php echo $urow['user_fb']; ?>" name="user_fb" id="user_fb">
      </div>
      <div class="form-group">
        <label for="user_ing" class="col-form-label">Instagram:</label>
        <input type="text" class="form-control" value="<?php echo $urow['user_ing']; ?>" name="user_ing" id="user_ing">
      </div>
      <div class="form-group">
        <label for="user_wp" class="col-form-label">Whatsapp:</label>
        <input type="text" class="form-control" value="<?php echo $urow['user_wp']; ?>" name="user_wp" id="user_wp">
      </div>
      <div class="form-group">
        <label for="user_tw" class="col-form-label">Twitter:</label>
        <input type="text" class="form-control" value="<?php echo $urow['user_tw']; ?>" name="user_tw" id="user_tw">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="sutmit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
 <section class="cstyle_ctop">
	<div class="row">
		<div class="col-lg-12 cstyle_cbottom">
			<div class="card bg-default">
			  <div class="card-header">
			  	<div class="float-left"><i class="fa fa-user"></i> Personal Information</div>
			  	<button type="button" class="btn btn-primary text-white float-right" data-toggle="modal" data-target="#profile_edit_modal"><i class="fa fa-edit"></i> Profile Edit </button>
			  </div>
			  <div class="card-body">
			  	<div id="message"></div>

                 <div class="cstyle_profile float-right col-lg-6 text-center">
	             	<div><img id="image_on" src="<?php echo $profile_img; ?>">
			    			<input type="file" accept="image/*" style="display: none;" name="profile_image" id="profile_image">
			    			<p><small style="color: red;">On click change profile Image. (size: 150px * 150px )</small></p></div>
                 </div>
                 <div class="cstyle_profile float-left col-lg-6">

                 	<h3 class="cstyle_profile_text"><?php echo $urow['users_fullname']; ?></h3>
                 	<p class="cstyle_profile_text">
                 	<i class="fa fa-user"></i> Username: <?php echo $urow['username']; ?><br>

                 	<i class="fa fa-phone"></i> Phone: <?php echo $urow['users_mobile']; ?><br>

                 	<i class="fa fa-envelope"></i> Email: <?php echo $urow['users_email']; ?><br>

                 	<i class="fa fa-university"></i> Institute: <?php echo $urow['users_institute']; ?><br>

                 	<i class="fa fa-clock-o"></i>
                             Create Date: <?php echo $urow['users_create_at']; ?><br>

                     <i class="fa fa-clock-o"></i>
			    				Expaired Date: <?php echo $urow['users_expaired_date']; ?>
			    	</p>

                 </div>            
				<div class="icon-bar">
				  <a target="_blank" href="<?php echo $urow['user_fb']; ?>" ><img src="../media/image6.png" width="40" height="40" alt=""></a>
				  <a target="_blank" href="<?php echo $urow['user_ing']; ?>" ><img src="../media/image7.png" width="40" height="40" alt=""></a>
				  <a target="_blank" href="<?php echo $urow['user_wp']; ?>" ><img src="../media/image8.png" width="40" height="40" alt=""></a>
				  <a target="_blank" href="<?php echo $urow['user_tw']; ?>" ><img src="../media/image9.png" width="40" height="40" alt=""></a>
				</div>
			  </div>
			</div>
		</div>
		<div class="col-lg-12 cstyle_cbottom">
			<div class="card bg-light">
			  <div class="card-header">Performance</div>
			  <div class="card-body">
			    <h5 class="card-title">Primary card title</h5>
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			  </div>
			</div>
		</div>
	</div>
</section> 
<?php } } } } ?>
<?php 
 if (realpath('inc/footer.php')) {
   include_once 'inc/footer.php';
 }
?> profile_image_change.js
<script src="../vendor/js/uinfo_up.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

     $('#image_on').on('click',function(e){
        $('#profile_image').click();
     });


 $("#profile_image").on('change',function(e) {

      var user_id       = "<?php echo $user_id; ?>";
      var profile_image = $('#profile_image').prop('files')[0];

	  var form_data = new FormData();
	  form_data.append('user_id', user_id);
	  form_data.append('profile_image', profile_image);
	  form_data.append('save_pic', 33);
	  e.preventDefault();
	  $.ajax({
           url: "../ajax/profile_image_change.php", 
           type: "post",
           data: form_data,
           processData: false,
           cache: false,
           contentType: false,
            success: function(imagedta){
               var imagenameft = imagedta.substring(0,2);
                if (imagenameft == 55) {               	
                  var successimg = imagedta.substring(2);
                  $('#message').html(successimg);                 
                  setTimeout(function(){
                   location.reload();
                  },1000);
                }else{
                  $('#message').html(imagedta);
                }
            },
            error: function (error) {
            alert(error);
           },
         });
	   return false;
    });
 });
</script>