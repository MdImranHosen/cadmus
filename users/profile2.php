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
		<div class="col-lg-6 cstyle_cbottom">
			<div class="card bg-default">
			  <div class="card-header">
			  	<div class="float-left"><i class="fa fa-user"></i> Personal Information</div>
			  	<button type="button" class="btn btn-primary text-white float-right" data-toggle="modal" data-target="#profile_edit_modal"><i class="fa fa-edit"></i> Profile Edit </button>
			  </div>
			  <div class="card-body">
			    <!--<h5 class="card-title"></h5>-->
			    <table class="table table-bordered table-hover">
			    	<tbody>
			    		<div id="message"></div>
			    		<tr>
			    			<th colspan="2"><center><img id="image_on" src="<?php echo $profile_img; ?>" style="cursor: pointer;border-radius: 50%;" width="30%" height="auto">
			    			<input type="file" accept="image/*" style="display: none;" name="profile_image" id="profile_image">
			    			<p><small style="color: red;">On click change profile Picter.</small></p></center></th>
			    		</tr>
			    		<tr>
			    			<th style="width: 35%;"><i class="fa fa-user"></i> Username: </th>
			    			<th><?php echo $urow['username']; ?></th>
			    		</tr>
			    		<tr>
			    			<th style="width: 35%;"><i class="fa fa-phone"></i> Phone: </th>
			    			<td><?php echo $urow['users_mobile']; ?></td>
			    		</tr>
			    		<tr>
			    			<th style="width: 35%;"><i class="fa fa-envelope"></i> Mail: </th>
			    			<td><?php echo $urow['users_email']; ?></td>
			    		</tr>
			    		<tr>
			    			<th style="width: 35%;"><i class="fa fa-user"></i> Name: </th>
			    			<td><?php echo $urow['users_fullname']; ?></td>
			    		</tr>
			    		<tr>
			    			<th style="width: 35%;"><i class="fa fa-university"></i> Institute: </th>
			    			<td><?php echo $urow['users_institute']; ?></td>
			    		</tr>
			    		<tr>
			    			<th style="width: 35%;"><i class="fa fa-clock-o"></i>
                             Create Date:
			    			</th>
			    			<td><?php echo $urow['users_create_at']; ?></td>
			    		</tr>
			    		<tr>
			    			<th style="width: 35%;"><i class="fa fa-clock-o"></i>
			    				Expaired Date:
			    			</th>
			    			<td><?php echo $urow['users_expaired_date']; ?></td>
			    		</tr>
			    	</tbody>
			    </table>
			  </div>
			  <div class="card-footer text-center">
			    <p>Profile Info</p>
			  </div>
			</div>
		</div>
		<div class="col-lg-6 cstyle_cbottom">
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
?>
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