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
					$clientdate    = (date ("Y-m-d H:i:s"));
					if($tingkatmember!=0){//5 id join normal
					$bonus_sponsor=$dp["bonus_sponsor"];
			

$tingkatmember=getName("paket","id",$paket,"tingkat");
$kolev = config("komlev");
$komlev = explode("|", $kolev);
$bonus_sponsor=getName("paket","id",$paket,"bonus_sponsor");
					function showUK($data,$parent,$tingkatmember,$bonus_sponsor,$komlev,$username){
						static $i = 0;
				    	  if(isset($data[$parent])){ 
						 
							foreach($data[$parent] as $value){
						 								
							$sponsor=$value->id;
							$paketSP = dataku("paket", $sponsor);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								$tj = ($komlev[$i] * $bonus_sponsor)/100;
									echo "<br> Yang Dapat Bonus ".$sponsor." sebesar ".$tj." Ke-".$i;
								insert("komisi", "", "'', '$sponsor', '$tj', now(), '0', '', 'komsponsor', '$username','',''");
								$i++;
							}
							  $child = showUK($data,$value->id,$tingkatmember,$bonus_sponsor,$komlev,$username); 
							}
							//$str .= '</ul>';
							return true;
						  }else return false;	  
						}
						
						
							$sql = "SELECT username FROM member where username='".$username."'";
							$result = mysqli_query($mysqli,$sql);
							while ($rowx = mysqli_fetch_object($result)) {
								$parent = $rowx->username;
							}
							
							$query = "SELECT username as parent_id, 
									sponsor as id, username as name ,paket
								FROM member where username='".$username."'
								UNION
								SELECT username as parent_id, 
									sponsor as id, username as name,paket
								FROM member
								";
						
						$result = mysqli_query($mysqli,$query);
						$data = array();
						while ($row = mysqli_fetch_object($result)) {
						  $data[$row->parent_id][] = $row; // simpan data dari databae ke dalam variable array 3 dimensi di PHP
						}
						 showUK($data,$parent,$tingkatmember,$bonus_sponsor,$komlev,$username); // lakukan looping menu utama
			
			/* sponsor */
		
			
/*
	$sponsore = dataku("sponsor", $username);
				$jsp=jumlahsp($sponsore);
				$kolev = config("komlev");
				$komlev = explode("|", $kolev);
					//$sponsoreup = $this->dataku("sponsor", $upli);
					$sponsor1 = dataku("sponsor", $username);
					if($sponsor1){
							$paketSP = dataku("paket", $sponsor1);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[0] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor1', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor2 = dataku("sponsor", $sponsor1);
						if($sponsor2){
							$paketSP = dataku("paket", $sponsor2);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[1] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor2', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor3 = dataku("sponsor", $sponsor2);
						if($sponsor3){
							$paketSP = dataku("paket", $sponsor3);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[2] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor3', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor4 = dataku("sponsor", $sponsor3);
						if($sponsor4){
							$paketSP = dataku("paket", $sponsor4);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[3] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor4', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor5 = dataku("sponsor", $sponsor4);
						if($sponsor5){
							$paketSP = dataku("paket", $sponsor5);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[4] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor5', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor6 = dataku("sponsor", $sponsor5);
						if($sponsor6){
							$paketSP = dataku("paket", $sponsor6);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[5] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor6', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor7 = dataku("sponsor", $sponsor6);
						if($sponsor7){
							$paketSP = dataku("paket", $sponsor7);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[6] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor7', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor8 = dataku("sponsor", $sponsor7);
						if($sponsor8){
							$paketSP = dataku("paket", $sponsor8);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[7] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor8', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor9 = dataku("sponsor", $sponsor8);
						if($sponsor9){
							$paketSP = dataku("paket", $sponsor9);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[8] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor9', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor10 = dataku("sponsor", $sponsor9);
						if($sponsor10){
							$paketSP = dataku("paket", $sponsor10);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[9] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor10', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor11= dataku("sponsor", $sponsor10);
						if($sponsor11){
							$paketSP = dataku("paket", $sponsor11);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[10] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor11', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					$sponsor12= dataku("sponsor", $sponsor11);
						if($sponsor12){
							$paketSP = dataku("paket", $sponsor12);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							$tj = ($komlev[11] * $bonus_sponsor)/100;
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								insert("komisi", "", "'', '$sponsor12', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
					}
					//insert("komisi", "", "'', '$upli', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
					//$this->insert("komisi", "", "'', '$sponsor1', '0', '$clientdate', '0', '', 'gensp2', '$username'");
					//$this->insert("komisi", "", "'', '$sponsor2', '0', '$clientdate', '0', '', 'gensp3', '$username'");
					//$this->insert("komisi", "", "'', '$sponsor3', '0', '$clientdate', '0', '', 'gensp4', '$username'");
			
				}
			/* kom level */
			$level = dataupline("level", $username);
			$kolev = config("komlev");
					$ii=0;
				for($i=0;$i<$level;$i++) {
					//if($level <= $kd) { //---sesuai database
						$j = $i + 1;
						$komlev = explode("|", $kolev);
						$upli = dataupline("upline$i", $username);
						
						if($upli) {
							$paketupli = dataku("paket", $upli);
							$tingkatupli=getName("paket","id",$paketupli,"tingkat");
							if($tingkatupli<=$tingkatmember && $tingkatupli>0){
								$ii++;
								$tj = ($komlev[$ii] * $bonus_sponsor)/100;
							//insert("komisi", "", "'', '$upli', '$tj', '$clientdate', '0', '', 'komsponsor', '$username','',''");
							}
						}
					//} //--end if level	
					
				}//for
				
				
				}//if != join normal
		
			//---end aktivasi
			$jml_poin=getPVPaket($paket);
		
$query=$mysqli->query("INSERT INTO member_poin (`id`,`username`,`tgl`,`jml_poin`,`sumber`) VALUES ('$id','$username','$clientdate','$jml_poin','daftar')");
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

	