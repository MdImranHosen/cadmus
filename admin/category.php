<?php 
 if (realpath('inc/header.php')) {
   include_once 'inc/header.php';
 }
?>
<!-- Modal Add Category -->
<div class="modal fade" id="add_cat_modal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModal"><i class="fa fa-plus"></i> Category </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="was-validated" id="category_form" action="" method="post">
      <div class="modal-body">
        <div id="output_msg"></div>
        <div class="form-group">
          <label for="cat_name" class="col-form-label"> Category Title:</label>
          <input type="text" class="form-control form-control-lg" name="cat_name" id="cat_name" placeholder="Enter Category Title" required="">
          <div class="invalid-feedback" id="err_cat_name"><strong> Title is Required!</strong></div>
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

<!-- Modal Add Sub Category -->
<div class="modal fade" id="addSubCategory" tabindex="-1" role="dialog" aria-labelledby="addSubCategoryModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSubCategoryModal"><i class="fa fa-plus"></i> Sub Category </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="was-validated" id="sub_category_form" action="" method="post">
      <div class="modal-body">
        <div id="output_submsg"></div>
        <input type="hidden" name="catid" id="catid">
        <div class="form-group">
          <label for="sub_cat_name" class="col-form-label"> Sub Category Title:</label>
          <input type="text" class="form-control form-control-lg" name="sub_cat_name" id="sub_cat_name" placeholder="Enter Sub Category Title" required="">
          <div class="invalid-feedback" id="err_sub_cat_name"><strong> Title is Required!</strong></div>
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
			  		<div class="float-left"><i class="fa fa-list"></i> Category </div>
            <div class="float-right">
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_cat_modal">
                <i class="fa fa-plus"></i> Category </button>
            </div>
			  </div>
			  <div class="card-body">
          <div id="output_message"></div>
          <div class="table-responsive">
          <table id="cattable" class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
             if (class_exists('UsersClass')) {
               $users = new UsersClass();             
             if (method_exists($users, 'getCategorys')) {
               $catdata = $users->getCategorys();
               if ($catdata) {
                 $i=0;
                  while ($catrow = $catdata->fetch_assoc()) {
                    $i++;
                    $cat_id = $catrow['cat_id'];
            ?>
              <tr>
                <td width="5%"><?php echo $i; ?></td>
                <td style="vertical-align: middle;">
                  <div id="edit_cat_output<?php echo $cat_id; ?>">
                  <button type="button" class="btn btn-default float-right onclickcatedit" data-catname="<?php echo $catrow['cat_name']; ?>" data-cateid="<?php echo $cat_id; ?>"><i class="fa fa-edit"></i></button>
                  <?php echo $catrow['cat_name']; ?>
                  </div>                
                </td>
                <td>
                  <button type="button" title="Add Sub Category" style="margin-bottom: 2px;" data-toggle="modal" data-target="#addSubCategory" class="btn btn-info btn-sm float-right onclickcatid" data-catid="<?php echo $cat_id; ?>">
                    <i class="fa fa-plus"></i>
                  </button>

                    <?php
                     if (method_exists($users, 'getCatIdBySubCat')) {
                       $subcat = $users->getCatIdBySubCat($cat_id);
                       if ($subcat) {
                        $output = '<table class="table table-bordered">';
                         while ($subrow = $subcat->fetch_assoc()) {
                           $output .= "<tr><td>".$subrow['cat_name']."</td><td width='5%'><button type='button' class='btn btn-default btn-sm onclicksubcatdel' data-subcatid='".$subrow['cat_id']."'><i class='fa fa-trash'></i></button></td></tr>";
                         }
                         $output .= '</table>';
                         echo $output;
                       }
                     }
                    ?>            
                </td>
                <td style="vertical-align: middle;" class="text-center">
                  <button type="button" class="btn btn-primary btn-sm onclickcatdelete" data-catdid="<?php echo $cat_id; ?>"><i class="fa fa-trash"></i> Delete </button>
                  
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

    $('.onclickcatdelete').on('click', function(){
      var catdid = $(this).data('catdid');
       $.ajax({url:"../ajax/cat_delete.php?catdid="+catdid+"&catdel=97",success:function(catdedata){
        var strFirstTwo = catdedata.substring(0,2);
          if (strFirstTwo == 98) {
            var successdata = catdedata.substring(2);
            $('#output_message').html(successdata);                 
            setTimeout(function(){
             location.reload();
            },2000);
          }else{
            $('#output_message').html(catdedata);
          }
         }});
    });

    $('.onclicksubcatdel').on('click', function(){
      var subcatid = $(this).data('subcatid');
       $.ajax({url:"../ajax/sub_cat_delete.php?subcatid="+subcatid+"&subcatdel=53",success:function(sub_catdedata){
        var subcatfirsttw = sub_catdedata.substring(0,2);
          if (subcatfirsttw == 53) {
            var subcatdelsuccs = sub_catdedata.substring(2);
            $('#output_message').html(subcatdelsuccs);                 
            setTimeout(function(){
             location.reload();
            },2000);
          }else{
            $('#output_message').html(sub_catdedata);
          }
         }});
    });
  
   $('.onclickcatid').on('click', function(){
     var catid = $(this).data('catid');
     $('#catid').val(catid);
   });

   $('.onclickcatedit').on('click', function(){
     var cateid = $(this).data('cateid');
     var catname= $(this).data('catname');

     var edithtml = '<div id="output_edit_msg'+cateid+'"></div><form id="cat_edit_form'+cateid+'" action="" method="post"><input type="hidden" id="catedid'+cateid+'" value="'+cateid+'" /><input type="text" id="catname'+cateid+'" value="'+catname+'"/><input type="submit" value="Save" /></form>';
     $('#edit_cat_output'+cateid).html(edithtml);
    
    $('#cat_edit_form'+cateid).on('submit',function(e){

       var catedid  = $('#catedid'+cateid).val();
       var ecatname = $('#catname'+cateid).val();

       if (ecatname == "") {
        $('#output_edit_msg'+cateid).html('<div class="alert alert-danger">Field is Required!</div>');
        return false;
       } else if ((ecatname.length < 3) || (ecatname.length > 60)) {
        $('#output_edit_msg'+cateid).html('<div class="alert alert-danger">Category name must be between 3 to 60 Characters!</div>');
        return false;
       } else{
         var form_data = new FormData();
         form_data.append("catedid", catedid);
         form_data.append("ecatname", ecatname);
         form_data.append("ecat_save", 43);
           
         e.preventDefault();
         $.ajax({
               type: "post",
               url: "../ajax/edit_category.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(editcatdata){
                var editcatft = editcatdata.substring(0,2);
                if (editcatft == 43) {
                  var editsdata = editcatdata.substring(2);
                  $('#output_edit_msg'+cateid).html(editsdata);                 
                  setTimeout(function(){
                   location.reload();
                  },3000);
                }else{
                  $('#output_edit_msg'+cateid).html(editcatdata);
                }
                
               }
         });
         return false;
       }
    });
     


   });

  });
</script>
<script type="text/javascript">
 $(document).ready(function(){

    $('#category_form').on('submit',function(e){
       var cat_name = $('#cat_name').val();

       if (cat_name == "") {
        $('#output_msg').html('<div class="alert alert-danger">Field is Required!</div>');
        return false;
       } else if ((cat_name.length < 3) || (cat_name.length > 60)) {
        $('#output_msg').html('<div class="alert alert-danger">Category name must be between 3 to 60 Characters!</div>');
        return false;
       } else{
         var form_data = new FormData();
         form_data.append("cat_name", cat_name);
         form_data.append("cat_save", 77);
           
         e.preventDefault();
         $.ajax({
               type: "post",
               url: "../ajax/add_category.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(addcatdata){
                var addcatft = addcatdata.substring(0,2);
                if (addcatft == 77) {
                  var adsdata = addcatdata.substring(2);
                  $('#output_msg').html(adsdata);                 
                  setTimeout(function(){
                   location.reload();
                  },3000);
                }else{
                  $('#output_msg').html(addcatdata);
                }
                
               }
         });
         return false;
       }
    });

    // add sub category with category id use jquery ajax php

    $('#sub_category_form').on('submit',function(e){
       var catid        = $('#catid').val();
       var sub_cat_name = $('#sub_cat_name').val();

       if (sub_cat_name == "" || catid == "") {
        $('#output_submsg').html('<div class="alert alert-danger">Field is Required!</div>');
        return false;
       } else if ((sub_cat_name.length < 2) || (sub_cat_name.length > 60)) {
        $('#output_msg').html('<div class="alert alert-danger"> Sub Category name must be between 2 to 60 Characters!</div>');
        return false;
       } else{
         var form_data = new FormData();
         form_data.append("catid", catid);
         form_data.append("sub_cat_name", sub_cat_name);
         form_data.append("sub_cat_save", 33);
           
         e.preventDefault();
         $.ajax({
               type: "post",
               url: "../ajax/add_sub_category.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(addsubcatdata){
                var addsubcatft = addsubcatdata.substring(0,2);
                if (addsubcatft == 33) {
                  var adsubdata = addsubcatdata.substring(2);
                  $('#output_submsg').html(adsubdata);                 
                  setTimeout(function(){
                   location.reload();
                  },3000);
                }else{
                  $('#output_submsg').html(addsubcatdata);
                }
                
               }
         });
         return false;
       }
    });

 });
</script>