<?php 
 if (realpath('inc/header.php')) {
   include_once 'inc/header.php';
 }
?>
<!-- Modal Video with video id -->
<div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videoModal"><i class="fa fa-file-video-o"></i> Video </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="output_video"></div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal end-->
<!-- Modal Add Video -->
<div class="modal fade" id="add_video_modal" tabindex="-1" role="dialog" aria-labelledby="addVideoModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addVideoModal"><i class="fa fa-file-video-o"></i> Video </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="was-validated" id="video_form" action="" method="post">
      <div class="modal-body">
        <div id="output_video_msg"></div>
        <div class="form-group">
          <label for="video_title" class="col-form-label"> Video Title:</label>
          <input type="text" class="form-control form-control-lg" name="video_title" id="video_title" placeholder="Enter Video Title" required="">
          <div class="invalid-feedback" id="err_asq_title"><strong> Title is Required!</strong></div>
      </div>
      <div class="custom-file">
          <input type="file" accept="video/*" class="custom-file-input" name="video_name" id="video_name" lang="en" required="">
          <label class="custom-file-label" for="video_name">Video File</label>
          <div class="invalid-feedback" id="err_video_name"><strong> Video file is Required!</strong></div>
       </div> 
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Save changes </button>
      </div>
     </form>
    </div>
  </div>
</div>
<!-- Modal end-->

 <section class="cstyle_ctop">
	<div class="row">
		<div class="col-lg-12 cstyle_cbottom">
			<div class="card bg-default">
			  <div class="card-header">
			  		<div class="float-left"><i class="fa fa-file-video-o"></i> Videos</div>
            <div class="float-right">
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_video_modal">
                <i class="fa fa-plus"></i> Videos</button>
            </div>
			  </div>
			  <div class="card-body">
          <div id="output_message"></div>
          <div class="table-responsive">
          <table id="videostable" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
             if (class_exists('UsersClass')) {
               $users = new UsersClass();             
             if (method_exists($users, 'getAllVideo')) {
               $vdata = $users->getAllVideo();
               if ($vdata) {
                 $i=0;
                  while ($vrow = $vdata->fetch_assoc()) {
                    $i++;
                    $video_id = $vrow['video_id'];
            ?>
              <tr>
                <td width="5%"><?php echo $i; ?></td>
                <td class="onclickvideo" data-videoid="<?php echo $video_id; ?>" data-toggle="modal" data-target="#video_modal"><h5 style="cursor: pointer;" class="card-title"><?php echo $vrow['video_title']; ?></h5>
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-info btn-lg onclickvideo" data-videoid="<?php echo $video_id; ?>" data-toggle="modal" data-target="#video_modal"><i class="fa fa-eye"></i> View </button>
                <button type="button" class="btn btn-primary btn-lg onclickvdelete" data-videodid="<?php echo $video_id; ?>">Delete</button>
              </td>
            </tr>
            <?php } } } } ?>
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

    $('.onclickvdelete').on('click', function(){
      var videodid = $(this).data('videodid');
       $.ajax({url:"../ajax/video_delete.php?videodid="+videodid+"&videodel=97",success:function(videodedata){
        var strFirstTwo = videodedata.substring(0,2);
          if (strFirstTwo == 98) {
            var successdata = videodedata.substring(2);
            $('#output_message').html(successdata);                 
            setTimeout(function(){
             location.reload();
            },2000);
          }else{
            $('#output_message').html(videodedata);
          }
         }});
    });

    $('.onclickvideo').on('click', function(){
      var video_id = $(this).data('videoid');
       $.ajax({url:"../ajax/video_view.php?video_id="+video_id+"&videoview=44",success:function(vdata){ $('#output_video').html(vdata); }});
    });

  });
</script>
<script type="text/javascript">
     $(document).ready(function(){
    $('#video_form').on('submit',function(e){
       var video_title = $('#video_title').val();
       var video_name = $('#video_name').prop('files')[0];

       if (video_title == "" || (video_name.length == 0 || video_name.length == "")) {
        $('#output_video_msg').html('<div class="alert alert-danger">Field is Required!</div>');
        return false;
       } else{
         var form_data = new FormData();
         form_data.append("video_title", video_title);
         form_data.append('video_name', video_name);
         form_data.append("video_save", 77);
           
         e.preventDefault();
         $.ajax({
               type: "post",
               url: "../ajax/add_video.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(avdata){
                var advideodft = avdata.substring(0,2);
                if (advideodft == 77) {
                  var adsdata = avdata.substring(2);
                  $('#output_video_msg').html(adsdata);                 
                  setTimeout(function(){
                   location.reload();
                  },3000);
                }else{
                  $('#output_video_msg').html(avdata);
                }
                
               }
         });
         return false;
       }
    });
  });
</script>