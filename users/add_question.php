<?php 
 if (realpath('inc/header.php')) {
   include_once 'inc/header.php';
 }
?>
<section class="cstyle_ctop">
  <div class="row">
    <div class="col-lg-12 cstyle_cbottom">
      <div class="card bg-default">
        <div class="card-header">
          <div class="float-left">
           <i class="fa fa-plus"></i> Add Question
          </div>
          <a href="asq2.php" class="btn btn-info float-right"><i class="fa fa-list"></i> Question List </a>
        </div>
        <form class="was-validated" id="asq_question_form" action="" method="post">
        <div class="card-body">
         <div id="output_message"></div>
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">       
      <div class="form-group">
        <label for="asq_title" class="col-form-label"> Question Title:</label>
        <input type="text" class="form-control form-control-lg" name="asq_title" id="asq_title" placeholder="Enter Question Title" required="">
        <div class="invalid-feedback" id="err_asq_title"><strong> Title is Required!</strong></div>
      </div>
      <div class="form-group">
        <label for="description" class="col-form-label">Description: <small style="color: red;"> ( <b>This is Required!</b> ) </small></label>
        <textarea class="form-control" name="description" rows="12" id="description"></textarea>
        <div class="invalid-feedback" id="err_description"><strong> This is Required!</strong></div>
      </div>
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
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary pull-right"> Save changes </button>
        </div>
       </form>
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
