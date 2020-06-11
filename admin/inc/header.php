<?php 
 if (realpath('../classes/Mainclass.php')) {
    include_once '../classes/Mainclass.php';

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
      Session::admin_destroy();
   }

 Session::checkSession();

if (empty(Session::get('access_token')) || empty(Session::get('admin_id')) || empty(Session::get('admin_user')) || empty(Session::get('token_id'))) {
    header("Location:login.php");
  }else{
    $acs_token  = Session::get('access_token');
    $admin_id   = Session::get('admin_id');
    $admin_user = Session::get('admin_user');
    $token_id   = Session::get('token_id');
  }

  if (class_exists('AdminClass')) {
    $admin = new AdminClass();
    if (method_exists($admin, 'checkAdminLogin')) {
    $adminLogin = $admin->checkAdminLogin($acs_token,$admin_id,$token_id);
    if($adminLogin != true) {
      Session::admin_destroy();
    }
   }
  }

  $profile_path_side = "../img/auser/".$admin_id;
  if ($files = glob($profile_path_side."/*")){
     $profile_image_side=$files[0];
    }else{
     $profile_image_side= "../img/user.svg";
      }   

 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CADMUS</title>  
  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../vendor/css/simple-sidebar.css" rel="stylesheet">
  <link href="../icon/css/font-awesome.min.css" rel="stylesheet">  
  <link href="../vendor/css/custom.css" rel="stylesheet">
</head>
<body>
  <div class="d-flex" id="wrapper" style="margin-bottom: 30px;">
  <!-- Bottom Nav -->  
  <div class="navbar_bottom bg-dark text-center border-top"> 
<table style="table-layout: fixed; width: 100%;" >
  <tr>
    <td style="width:25%;">          
  <button class="trns_button"><a class="cstyle_admin_nev" href="#"><i class="fa fa-comments-o fa-2x" aria-hidden="true"></i></a>
  </button></td>
    <td style="width:25%;"><button class="trns_button"><a class="cstyle_admin_nev" href="users.php"><i class="fa fa-users fa-2x" aria-hidden="true"></i></a>
  </button></td>
    <td style="width:25%;">
  <button class="trns_button"><a class="cstyle_admin_nev" href="videos.php"><i class="fa fa-file-video-o fa-2x" aria-hidden="true"></i></a>
  </button></td>
    <td style="width:25%;"><button class="trns_button"><a class="cstyle_admin_nev" href="#"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
  </button>
     </td>
  </tr>
</table>
</div>
    <!-- Sidebar -->	
    <div class="bg-dark text-white border-right cstyle_top" id="sidebar-wrapper">
	  <a href="index.php"><center><img src="<?php echo $profile_image_side; ?>" style="border-radius: 50%" height="80px" width="auto"></center></a>
	  <center><h6><?php if (!empty($admin_user)) { echo $admin_user; } ?></h6>
    </center>	   
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-rss" aria-hidden="true"></i>
CADMUS Blog</a>
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-question-circle" aria-hidden="true"></i>
About Us</a>
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-cogs" aria-hidden="true"></i>
 Settings</a>
        <a href="category.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-list" aria-hidden="true"></i>
 Question Category </a>
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-star" aria-hidden="true"></i>
 Rate us! 
</a>
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-commenting-o" aria-hidden="true"></i>
Send us Feedback
</a>
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-trophy" aria-hidden="true"></i>
 Scholarship</a> 

 <a href="#" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-share-alt-square" aria-hidden="true"></i>

 Invite Others...</a>

 <a href="?action=logout" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-sign-out" aria-hidden="true"></i>

 Sign Out</a>
      </div>
	 
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white border-bottom fixed-top">		
		<button type="button" class="trns_button" id="menu-toggle">
          <span class="navbar-toggler-icon"></span>
        </button>
	<div class="navbar-brand-centered" style="font-size: 1.7rem;">	<b> <font color="#3498DB">Admin </font>Panel</b></div>	
      </nav>      
      <div class="container-fluid"> 