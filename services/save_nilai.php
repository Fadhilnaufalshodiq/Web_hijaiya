<?php

	
	include "koneksi.php";
	include "notice.php";

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 		
		
		 $email = $_POST['email'];
		 $score = $_POST['score'];
         $level = $_POST['status'];     
                  
		$querySQL = "INSERT INTO tb_hasil ( `email`, `score`, `level`) VALUES ('$email', '$score', '$level')";
		
				if(mysqli_query($conn,$querySQL)){
			echo 'Berhasil Menyimpan Score';
		}else{
			echo 'Gagal Menyimpan Score';
		}
		
		mysqli_close($conn);
	
	}
?>