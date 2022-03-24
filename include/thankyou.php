<?php

//---aktivasi mbr--
		//if($paket > 1) {
			
	$kode=$_REQUEST["kode"];
	$username=$_REQUEST["username"];
	$rpadmin=$_REQUEST["rpadmin"];
	$clientdate=$_REQUEST["clientdate"];
	$idreg=$_REQUEST["idreg"];
			
				$sponsore = dataku("sponsor", $username);
				$k_spon = config("komisi_sponsor");
				$k_pas = config("kompasangan");
				for($i=0;$i<$paket;$i++) {
					if($i == 0) {
						aktivasi($username);
						
					} else {
						if($i <= 9) {
							$d = "0$i";
						} else {
							$d = $i;
						}
						aktivasi("$username"."-"."$d");
						
					}
						
				} //--end for
				$tingkatmember=getName("paket","id",$paket,"tingkat");
					$clientdate    = (date ("Y-m-d H:i:s"));
					if($tingkatmember!=0){//5 id join normal
					insertkomsponsor($username,$paket);
			
				
				}//if != join normal
		
			//---end aktivasi
			$jml_poin=getPVPaket($paket);
		$jml_voucer=getName("paket","id",$paket,"jml_voucer");
$mysqli->query("INSERT INTO member_poin (`id`,`username`,`tgl`,`jml_poin`,`sumber`) VALUES ('$id','$username','$clientdate','$jml_poin','daftar')");
$mysqli->query("INSERT INTO member_voucer (`id`,`username`,`tgl`,`jml_voucer`,`sumber`) VALUES ('$id','$username','$clientdate','$jml_voucer','daftar')");
insert("transaksi", "", "'', '$kode', '$username', '$rpadmin', '$clientdate', 'Aktivasi Member: $username', 1");	
// isi pesan dibuat kosong dulu
$isipesan[3]="--- Terimakasih Pendaftaran Member Telah Berhasil !!! ---<br/>--------- Silahkan Cek Jaringan ----------";


//template pesan error
$tampilpesanerroratas=" <div class=\"col-md-4\"></div><div class=\"col-md-4\"><center>

 <div class='callout callout-danger'>
 <span class='glyphicon glyphicon-warning-sign'></span>
                    <h4>Peringatan!</h4>
                    <p></p>
                 
";
		
$tampilpesanerrorbawah="<br><p></p></center><br/>";	


	$textpesan=$isipesan[3];
	echo "$tampilpesanerroratas";
	echo "$textpesan";
	echo "$tampilpesanerrorbawah";
	echo"$pageregistrasiawal";
?>

	