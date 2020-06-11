<?php 
 if (realpath('inc/header.php')) {
   include_once 'inc/header.php';
 }
?>
<!-- Modal User By user ID -->
<div class="modal fade" id="users_modal" tabindex="-1" role="dialog" aria-labelledby="usersModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usersModal"><i class="fa fa-user"></i> User </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div id="output_user"></div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal end-->

 <section class="cstyle_ctop">
	<div class="row">
		<div class="col-lg-12 cstyle_cbottom">
			<div class="card bg-default">
			  <div class="card-header">
			  		<div class="float-left"><i class="fa fa-users"></i> Users</div>
            <div class="float-right">
              <a href="deactive_users.php" class="btn btn-info btn-lg">Deactive Users</a>
            </div>
			  </div>
			  <div class="card-body">
          <div id="output_message"></div>
          <div class="table-responsive">
          <table id="userstable" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>UserName</th>
                <th>Phone</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
             if (method_exists($admin, 'getAllUsers')) {
               $udata = $admin->getAllUsers();
               if ($udata) {
                 $i=0;
                  while ($urow = $udata->fetch_assoc()) {
                    $i++;
                    $users_id = $urow['users_id'];                    
                    $profile_path = "../img/".$users_id;
                    if ($files = glob($profile_path."/*")){
                       $profile_img=$files[0];
                      }else{
                       $profile_img= "../img/user.svg";
                        } 
            ?>
              <tr>
                <td width="5%"><?php echo $i; ?></td>
                <td class="onclickusers" data-usersid="<?php echo $users_id; ?>" data-toggle="modal" data-target="#users_modal"><h5 style="cursor: pointer;" class="card-title"><?php echo $urow['username']; ?></h5>
              </td>
              <td><?php echo $urow['users_mobile']; ?></td>
              <td>
                <center><img src="<?php echo $profile_img; ?>" style="border-radius: 50%" height="80px" width="auto"></center>
              </td>
              <td class="text-center"><button type="button" class="btn btn-info btn-lg onclickusers" data-usersid="<?php echo $users_id; ?>" data-toggle="modal" data-target="#users_modal"><i class="fa fa-eye"></i> View </button>
                <button type="button" class="btn btn-primary btn-lg onclickdeactive" data-userdid="<?php echo $users_id; ?>">Deactive</button>
              </td>
            </tr>
            <?php } } } ?>
            </tbody>
          </table>
         </div> 
			  </div>
			</div>
		</div>
	</div>
</section>    
<?php 
 if (realpath('inc/footer.php')) {
   include_once 'inc/footer.php';
 }
?>
<script type="text/javascript">
  $(document).ready(function(){

    $('.onclickusers').on('click', function(){
      var usersid = $(this).data('usersid');
       $.ajax({url:"../ajax/user_view.php?usersid="+usersid+"&userview=45",success:function(userdata){ $('#output_user').html(userdata); }});
    });

    $('.onclickdeactive').on('click', function(){
      var userdid = $(this).data('userdid');
       $.ajax({url:"../ajax/user_deactive.php?userdid="+userdid+"&userdeactive=47",success:function(userdedata){
        var strFirstTwo = userdedata.substring(0,2);
          if (strFirstTwo == 66) {
            var successdata = userdedata.substring(2);
            $('#output_message').html(successdata);                 
            setTimeout(function(){
             location.reload();
            },2000);
          }else{
            $('#output_message').html(userdedata);
          }
         }});
    });

  });
</script>