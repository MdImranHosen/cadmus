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

 <section class="cstyle_ctop">
	<div class="row">
		<div class="col-lg-12 cstyle_cbottom">
			<div class="card bg-default">
			  <div class="card-header">
			  		<i class="fa fa-file-video-o"></i> Video
			  </div>
			  <div class="card-body">
          <table id="asqtable" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Title</th>
              </tr>
            </thead>
            <tbody>
            <?php 
             if (method_exists($users, 'getAllVideo')) {
               $vdata = $users->getAllVideo();
               if ($vdata) {
                 $i=0;
                  while ($vrow = $vdata->fetch_assoc()) {
                    $i++;
            ?>
              <tr><td width="5%"><?php echo $i; ?></td><td class="onclickvideo" data-videoid="<?php echo $vrow['video_id']; ?>" data-toggle="modal" data-target="#video_modal"><h5 style="cursor: pointer;" class="card-title"><?php echo $vrow['video_title']; ?></h5>
                <p class="card-text"><button type="button" class="btn btn-info btn-lg"><i class="fa fa-file-video-o"></i> View Video </button></p>
              </td></tr>
            <?php } } } ?>
            </tbody>
          </table>	 
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

    $('.onclickvideo').on('click', function(){
      var video_id = $(this).data('videoid');
       $.ajax({url:"../ajax/video_view.php?video_id="+video_id+"&videoview=44",success:function(vdata){ $('#output_video').html(vdata); }});
    });

  });
</script>