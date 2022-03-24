<?php session_start();         
require("../include/notice.php"); 
require("../include/koneksi.php"); 
require("../include/fungsi.php"); 
$param=$_GET["param"];
switch($param){
	
	case 'getBagiemail':
	$id_pelamar = $_POST['id_pelamar'];
$query = mysqli_query($mysqli, "select * from tb_pelamar where id_pelamar='$id_pelamar'");
$x = mysqli_fetch_array($query);
$data = array(
            'email'      =>  $x['email'],
             'nama_pelamar'      =>  $x['nama_pelamar']
          );
 echo json_encode($data);
	
	break;
}