
<?php
if($level==2){
$satu=$mysqli->query("SELECT id FROM tb_soal")->num_rows;
$dua=$mysqli->query("SELECT id_hasil FROM tb_hasil")->num_rows;
$tiga=$mysqli->query("SELECT id_admin  FROM tb_admin")->num_rows;
}else {
$satu=$mysqli->query("SELECT id FROM tb_soal")->num_rows;
$dua=$mysqli->query("SELECT id_hasil FROM tb_hasil")->num_rows;
$tiga=$mysqli->query("SELECT id_admin  FROM tb_admin")->num_rows;
}

?>    
 <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $satu+0;?></h3>

              <p>Total Data Soal</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $dua+0;?></h3>

              <p>Total Hasil</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $tiga+0;?></h3>

              <p>Total Admin</p>
            </div>
            <div class="icon">
              <i class="fa fa-dropbox"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
      </div>
     
 
   <div class="logo"><img src="../assets/dist/img/empat.jpg" width="1080" height="476"/> </div>
   

