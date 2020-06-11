<?php 
 if (realpath('inc/header.php')) {
   include_once 'inc/header.php';
 }
?> 
<!-- Modal Asq Question with user -->
<div class="modal fade" id="asq_question_modal" tabindex="-1" role="dialog" aria-labelledby="profileModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModal"><i class="fa fa-user"></i> Asq Question </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="was-validated" id="asq_question_form" action="" method="post">
      <div class="modal-body">
      	<div id="output_message"></div>
      	<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">       
        <div class="form-group">
        <label for="cat_id" class="col-form-label">Category</label>
        <select class="form-control" onChange="getCatBysubcat();" id="cat_id" name="cat_id" required="">
          <option value="" style="display: none;cursor: pointer;">Select Category</option>
          <?php 
           if (method_exists($users, 'getCategorys')) {
              $catdata = $users->getCategorys();
              if ($catdata) {
                while ($catrow = $catdata->fetch_assoc()) {
               $cat_id = $catrow['cat_id'];
               $cat_name = $catrow['cat_name'];
         echo '<option value="'.$cat_id.'">'.$cat_name.'</option>';
          } } } ?>
        </select>
        <div class="invalid-feedback" id="err_cat_id"> <strong> Category is Required!</strong></div>
      </div>
      <div class="form-group">
        <label for="sub_cat" class="col-form-label">Sub Category:</label>
        <select class="form-control" id="sub_cat" name="sub_cat" required="">
          <option value="" style="display: none;">Select Sub Category</option>
        </select>
        <div class="invalid-feedback" id="err_sub_cat"><strong> Sub Category is Required!</strong></div>
      </div>
      <div class="form-group">
        <label for="asq_title" class="col-form-label"> Question Title:</label>
        <input type="text" class="form-control form-control-lg" name="asq_title" id="asq_title" placeholder="Enter Question Title" required="">
        <div class="invalid-feedback" id="err_asq_title"><strong> Title is Required!</strong></div>
      </div>
      <div class="form-group">
        <label for="description" class="col-form-label">Description:</label>
        <textarea class="form-control" rows="8" name="description" id="description" required=""></textarea>
        <div class="invalid-feedback" id="err_description"><strong> Description is Required!</strong></div>
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
			  	<div class="float-left">
			  		ASQ
			  	</div>
			  	<button class="btn btn-info float-right" data-toggle="modal" data-target="#asq_question_modal"><i class="fa fa-plus"></i> Ask Question </button>
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
             if (method_exists($users, 'getAllQuestion')) {
               $qdata = $users->getAllQuestion();
               if ($qdata) {
                 $i=0;
                  while ($qrow = $qdata->fetch_assoc()) {
                    $i++;
            ?>
              <tr><td width="5%"><?php echo $i; ?></td><td><h5 class="card-title"><?php echo $qrow['asq_title']; ?></h5>
                <p class="card-text"><?php echo $qrow['description']; ?></p>
              </td></tr>
            <?php } } } ?>
            </tbody>
          </table>	 
			  </div>
			  <div class="card-footer text-center">
			  	<p>Footer</p>
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
<script src="../vendor/js/add_asq.js"></script>
