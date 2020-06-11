<?php 
 if (realpath('inc/header.php')) {
   include_once 'inc/header.php';
 }
?>
 <section class="cstyle_ctop">
	<div class="row">
	<div class="col-lg-12" style="margin-bottom:5px;">
		<a href="add_question.php" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Ask Question </a>
	</div>
		<div class="col-lg-12" style="margin-bottom:5px;">
			<div class="card" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;margin-bottom:5px;">
	</div>	
	</div>	
<div class="col-lg-12 cstyle_cbottom" id="all_post">
	 <?php 
         if (method_exists($users, 'getAllQuestion')) {
           $qdata = $users->getAllQuestion();
           if ($qdata) {
             $i=0;
              while ($qrow = $qdata->fetch_assoc()) {
                $i++;
        ?>
<div class="card" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;margin-bottom:5px;">
<div class="small"> 0 votes 0 answers 0 views</div>
<div style="color:#81c4f8;">
<a href=""><?php echo $qrow['asq_title']; ?></a>
</div>
<div>
<span class="badge badge-info small"><?php echo $qrow['cat_name']; ?></span>
<span class="badge badge-info small"><?php echo $qrow['subcat_name']; ?></span>
<span class="pull-right small">asked 23 mins ago <a href="#">Aziz</a></span>
</div>
</div>
<?php } } } ?>
</div>
</div>
</section>
<?php
 if (realpath('inc/footer.php')) {
   include_once 'inc/footer.php';
 }
?>