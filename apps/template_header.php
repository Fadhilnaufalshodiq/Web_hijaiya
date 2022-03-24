<?php 
$level=$_SESSION['ses_level'];
$id_user=$_SESSION['ses_uid'];
if($level=="admin"){
$ses_nama="Administrator";
}
else if($level=="dapur"){
  $ses_nama="Dapur";

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Area</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
       <link rel="shortcut icon" href="../assets/dist/img/favicon.ico">
  <link rel="icon" href="../assets/dist/img/afavicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
      <link href="../assets/fonts/font-awesome4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
     <!-- Select2 -->
  <link rel="stylesheet" href="../assets/plugins/select2/select2.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
     <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. --
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
-->

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- custome -->
      <script src="../assets/plugins/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert-master/dist/sweetalert.css"/>

<link rel="stylesheet" href="../assets/dist/css/custome.css" />
<!-- jQuery 2.2.3 -->
<script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../assets/plugins/select2/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
<!-- CK Editor -->

</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels SID-->
      <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices SI Desmigratif-->
      <span class="logo-lg"><b></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
      <div class="navbar-custom-menu"> 
        <ul class="nav navbar-nav">
        
       
                <li class="dropdown <?php if($_GET["page"]=="v_gantipass"){?>active<?php }?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i> <?php echo $ses_nama;?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
               
                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </li>
          <!-- Control Sidebar Toggle Button -->
       
        </ul>
      </div>
    </nav>
  </header>