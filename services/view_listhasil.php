<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Detail">
    <meta name="author" content="">
   
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Detail</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="css/widgets.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/xcharts.min.css" rel=" stylesheet"> 
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
     
            <div class="row">
                 
                        
                        <div class="panel-body">
<?php
	include "koneksi.php";
	include "notice.php";
	?>

		
			
			 <?php
        $email = $_GET['email'];
			 $result = $conn->query("SELECT * FROM tb_hasil a join tb_pelamar c on a.email= c.email WHERE a.email='$email'  ORDER BY id_hasil ASC LIMIT 1");   

                                      
											while($data=$result->fetch_assoc()){
                         				 	$start = 0;

                        
                        ?>
  						<div class="col-xs-12">
							<div class="product-image-wrapper">
								<div class="single-products">
									
									<div class="product-overlay">
                                    
									  <div class="overlay-content">
                                   
                                    <div align="left"><b>Nama : <?php echo $data["nama_pelamar"]; ?> </b> </div><br>
                                    <div align="left"><b>Score : <?php echo $data["score"];?></b></div><br>
                                     <div align="left"><b>Soal : <?php echo $data["level"];?></b></div>
<br>
                                     <?php
                                    $total_nilai = $data["score"];

                                    if($total_nilai > 100){
                                        echo "Selamat Anda Lulus";
                                    }
                                    else{
                                      echo " Anda Tidak Lulus";
                                    }
                                    
                                    ?>

                                    </div>
                                      </div>
									</div>
                                  
								</div>
								
							</div>
						</div>
                        
                          <!-- <img src="ggs.png" width="100%" height="5" /><br /> -->

                        
                    </div>
                    </div>
  <?php }?>
          

 
<?php //include"footer.php";?>
 <!-- Memanggil file JS -->
   <br />
<script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
  <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
  <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js" ></script>
  <script src="assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
  <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="js/jquery-jvectormap-world-mill-en.js"></script>
  <script src="js/xcharts.min.js"></script>
  <script src="js/jquery.autosize.min.js"></script>
  <script src="js/jquery.placeholder.min.js"></script>
  <script src="js/gdp-d.js"></script>  
  <script src="js/morris.min.js"></script>
  <script src="js/sparklines.js"></script>  
  <script src="js/charts.js"></script>
  <script src="js/jquery.slimscroll.min.js"></script>
  
 
  
  </body>
</html>
