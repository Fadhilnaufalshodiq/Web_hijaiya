
<style>
.kotak-foto{
	border: 1px solid #F0F0F0;
	margin: 13px;
	max-width: 100px;
	min-width: 28%;
	padding: 4px;
}
</style>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="kotak-foto">
          <img src="../assets/dist/img/lgo.png"  class="img-responsive">
        </div>
        
      </div>
    
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
    
        <li class="header">MENU ADMINISTRATOR</li>
       
         <li>
          <a href="./">
            <i class="fa fa-home"></i> <span>Home</span>
          
          </a>
        </li>
         <?php if($level=="admin"){include"menu_admin.php";}?>
         <?php if($level=="owner"){include"menu_admin.php";}?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
