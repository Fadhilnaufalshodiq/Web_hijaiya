<?php
/*
$mysqli->query('$sql')
$query->num_rows
$data=$query->fetch_array()
$data=$sqlu->fetch_row()
$sql->free_result();

*/
/* ================================== START REGISTRASI MEMBER ============================*/
	function insert($table,$fields="",$values="") { 
	 global $mysqli; 
			$sql_stat="insert into $table ";  
			  
			if (is_array($fields)) $theFields=implode(",",$fields); else $theFields=$fields;  
			if (is_array($values)) $theValues="'".implode("','",$values)."'"; else $theValues=$values;  
			  
			$theValues=str_replace("'now()'","now()",$theValues);  
			  
			if (!empty($theFields)) $sql_stat.="($theFields) ";  
			$sql_stat.="values ($theValues)";  
			  
			$mysqli->query($sql_stat);  
			return $sql_stat;
	}  
  
	function update($table,$newvals,$where="") {  
		 global $mysqli; 

			if (is_array($newvals)) $theValues=implode(",",$newvals); else $theValues=$newvals;  
			  
			$sql_stat="update $table set $theValues";  
			  
			if (!empty($where)) $sql_stat.=" where $where";  
			$mysqli->query($sql_stat);  
		}  
	function select($fields,$tables,$where="",$order_by="",$group_by="",$having="",$limit="") {  
			  global $mysqli;
			$sql_stat=" select $fields from $tables ";  
			  
			if (!empty($where)) $sql_stat.="where $where ";  
			if (!empty($group_by)) $sql_stat.="group by $group_by ";  
			if (!empty($order_by)) $sql_stat.="order by $order_by ";  
			if (!empty($having)) $sql_stat.="having $having ";  
			if (!empty($limit)) $sql_stat.="limit $limit ";  
			
			  
			return $mysqli->query($sql_stat);  
		} 
		
	function result($sql,$field) {  
		global $mysqli;
			$query=$mysqli->query($sql);
			if($query->num_rows > 0) {
				$data=$query->fetch_array();
				return $data[$field];
				
			}	
		} 
	function dataku($field, $username) {
		global $mysqli;
				$sql=$mysqli->query("select $field from member where username='$username'");
					$dt = $sql->fetch_row(); 
			return $dt[0];
		}	
		
	function config($field) {
		global $mysqli;
			$sql=$mysqli->query("select $field from configuration where id=1");
			$row=$sql->fetch_row();
			$kat = $row[0];
			return $kat;
		}
	function dataupline($field, $username) {
		global $mysqli;
			$dup = "";
			$sql=$mysqli->query("select $field from upline where username='$username'");
				$dt = $sql->fetch_row(); 
			$dup = $dt[0];
			return $dup;
		}
/* PERHITUNGAN BONUS */		
/* 1. BONUS AKTIVASI */
	function aktivasi($username) {
				global $mysqli;

			//$clientdate    = (date ("Y-m-d H:i:s")); //--tgl skr
			$tgl_skr = (date("Y-m-d"));
			$dtfrom = "$tgl_skr 00:00:00";
			$dtto = "$tgl_skr 23:59:59";
			$jam = date("H:i:s");
			$clientdate    = dataku("tgl", $username)." ".$jam;
			$sponsore = dataku("sponsor", $username);
			//--insert ke topsp--
			insert("topsponsor", "", "'', '$username', '$clientdate', 0");	
			insert("jaringan", "", "'', '$username', 0, 0, 0");
			//---update status mbr----
			update("member", "status=1, tglaktif='$clientdate'", "username='$username'");
			updatejaringan($username);
			$sql=select("username", "komisi", "dari='$username'");
			//$query=$mysqli->query($sql);
			if($sql->num_rows== 0) {
				//---input komisi sponsor----
				
				//------
				$k_spon = explode("|", config("komisi_sponsor"));
				//$k_gen = 
				//--kom generasi--
				$k_gen = explode("|", config("komgenerasi"));
				if($sponsore) {
					//$this->insert("komisi", "", "'', '$sponsore', '$k_spon[0]', '$clientdate', '0', '', 'komsponsor', '$username'");
					//--
					$jsp=jumlahsp($sponsore);
					update("upline", "sp='$jsp'", "username='$sponsore'");
					update("topsponsor", "sp='$jsp'", "username='$sponsore'");
					//$sponsoreup = dataku("sponsor", $upli);
					$sponsor1 = dataku("sponsor", $sponsore);
					$sponsor2 = dataku("sponsor", $sponsor1);
					$sponsor3 = dataku("sponsor", $sponsor2);
					
			
				}
				//----komisi pasangan---
				$level = dataupline("level", $username);
				$k_pas = config("kompasangan");
				
				$fo = config("flushout"); //----max flushout
				for($i=0;$i<$level;$i++) {
					$upli = dataupline("upline$i", $username);
					updatejaringan($upli);
					
					$matchnow=match($upli);
					//$match=$this->dataupline("kp", $upli);
					//--cek jml kompas--
					$uql = $mysqli->query("select username from komisi where jenis='kompasangan' and username='$upli'"); 
					$match = $uql->num_rows; 
					
					$usp = explode("-", $upli);
					
					$sql_fo = $mysqli->query("select username from komisi where jenis='kompasangan' and username='$usp[0]' and (tglbayar between '$dtfrom' and '$dtto')");
					$ada_fo = $sql_fo->num_rows; //---flush out hari ini
					//mysqli_free_result ($sql_fo);
					
				//echo "matchnow=$matchnow<br>$match for $upli[$i]<br>";
					if($matchnow == $match + 1) {
						if($ada_fo < $fo) {
					
					
						} else {
							
							if($ada_fo == $fo) {
								insert("prestasi", "", "'', '$usp[0]', 1, '$clientdate'");
							}	
						}	
						
					} //--end if match
					//---------update jml downline aktif------------
					$jdl =jumlahdl($upli, "1");
					
					update("upline", "dl='$jdl'", "username='$upli'");
					
				}	

				//---komisi level---
				$tkt = config("kedalaman");
				$kolev =config("komlev");
				for($i=0;$i<$level;$i++) {
					$j = $i + 1;
					$komlev = explode("|", $kolev);
					$upli = dataupline("upline$i", $username);
					if($upli) {
						//$this->insert("komisi", "", "'', '$upli', '$komlev[$i]', '$clientdate', '0', '', 'komlev$j', '$username'");
					}
				}
				
				
			}		
			//--kom roy stok aktivasi--
			$sponstok =dataku("sponsor", $sponsore);
			$kos = explode("|", config("royalti_stockist"));
			if($sponstok) {
				//$this->insert("stockist_komisi", "","'', '$sponstok', '$kos[0]', '$clientdate', '$sponsore', 0");
			}	
			
			//--bonus presenter---
			$bpres = config("pensiun");
			$presenter = dataku("norek", $username); 
			if($presenter) {
				//$this->insert("komisi", "", "'', '$presenter', '$bpres', '$clientdate', '0', '', 'bonus presenter', '$username'");
			}
			
		}	
		
/* 1. Bonus SPONSOR */
function insertSP($data,$parent,$tingkatmember,$bonus_sponsor,$komlev,$username){
						static $i = 0;
				    	  if(isset($data[$parent])){ 
						 
							foreach($data[$parent] as $value){
						 								
							$sponsor=$value->id;
							$paketSP = dataku("paket", $sponsor);
							$tingkatSP=getName("paket","id",$paketSP,"tingkat");
							if($tingkatSP<=$tingkatmember && $tingkatSP>0){
								$tj = ($komlev[$i] * $bonus_sponsor)/100;
								//	echo "<br> Yang Dapat Bonus ".$sponsor." sebesar ".$tj." Ke-".$i;
								if($tj>0){
								insert("komisi", "", "'', '$sponsor', '$tj', now(), '0', '', 'komsponsor', '$username','',''");
								}
								$i++;
							}
							  $child = insertSP($data,$value->id,$tingkatmember,$bonus_sponsor,$komlev,$username); 
							}
							//$str .= '</ul>';
							return true;
						  }else return false;	  
						}
function insertkomsponsor($username,$paket){
				global $mysqli;
$kolev = config("komlev");
$komlev = explode("|", $kolev);
$tingkatmember=getName("paket","id",$paket,"tingkat");
$bonus_sponsor=getName("paket","id",$paket,"bonus_sponsor");
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
						 insertSP($data,$parent,$tingkatmember,$bonus_sponsor,$komlev,$username); // lakukan looping menu utama
						 
}
/* 2. BONUS RO*/
//---input komjual--
		function insertkomjual($username, $harga,$idtransaksi) {
			global $mysqli;
		
			$clientdate    = (date ("Y-m-d H:i:s"));
			$tkt = config("kedalaman");
			$level = dataupline("level", $username);
			$kdlm = explode("|", $tkt);
			$sql=$mysqli->query("select tgl from member where username='$username'");
			$data=$sql->fetch_assoc();
			$tgl_awal=$data["tgl"];
			$tgl_akhir=date("Y-m-d");
						
			$selisihnya = SelisihTgl($tgl_awal ,$tgl_akhir);
			
			$kd = $kdlm[1];
			
			$kolev = config("komjual");
				for($i=0;$i<$level;$i++) {
					//if($level <= $kd) { //---sesuai database
						$j = $i + 1;
						$komlev = explode("|", $kolev);
						$upli = dataupline("upline$i", $username);
						$tj = ($komlev[$i] * $harga)/100;
						if($upli && $tj>0) {
						$mysqli->query("INSERT INTO komisi (`id`,`username`,`bayar`,`tglbayar`,`status`,`jenis`,`dari`,`idtransaksi`) VALUES ('$id','$upli','$tj','$clientdate','0','komjual','$username','$idtransaksi')");
						}
					//} //--end if level	
				}
			}		
		//--------jumlah downline 
	function jumlahdl($username, $status) {
			global $mysqli;
			$lev = $mysqli->query("select level from upline order by level desc");
			$lv = $lev->fetch_row();
				$jmlev = $lv[0];
			for($i=0;$i<$jmlev;$i++) {
				$sql=$mysqli->query("SELECT a.username, b.status FROM upline as a INNER JOIN member as b on a.username=b.username WHERE a.upline$i='$username' AND b.status='$status'");
				$ada = $sql->num_rows;
				$td = $td + $ada;
			}
			$jdl = $td;
			return $jdl;
		}
		
		//---jlm yg disponsori
		function jumlahsp($username) {
			global $mysqli;
			$j=0;
			$sql=$mysqli->query("select username from member where sponsor='$username' and status=1");
			$j=$sql->num_rows;
			return $j;
		}	

		//--updatejer---
		function updatejaringan($username) {
			global $mysqli;
			$upline = dataku("upline", $username);
			$posisi =dataupline("posisi", $username);
			$sql=$mysqli->query("select kiri, kanan from jaringan where username='$upline'");
			$data=$sql->fetch_row();
			
			if($posisi == "KIRI") {
				$nk = $data[0] + 1;
				$pos = "kiri";
			} else {
				$nk = $data[1] + 1;
				$pos = "kanan";
			}
			update("jaringan", "$pos='$nk'", "username='$upline'");		
		}
		
		function match($username) {
			global $mysqli;
				$mt="";	
				$sql=$mysqli->query("select kiri, kanan from jaringan where username='$username'");
				$data=$sql->fetch_row();
				if($data[0] > $data[1]) {
					$match = $data[1];
				} else {
					$match = $data[0];
				}
				$mt= $match;
			return $mt;
		}
		
/* ================================ FUNCTION LAIN====================*/
function getPVPaket($paket){
global $mysqli;
		$total=0;
		$query="SELECT * FROM paket_setting WHERE `kode_paket`= '$paket'";
		$result= $mysqli->query($query);
		while($data=$result->fetch_assoc()){
			 $queryx="SELECT * FROM product WHERE `id`= '$data[kode_produk]'";
			 $resultx= $mysqli->query($queryx);
			 $datax=$resultx->fetch_assoc();
			 $jml=$data['jml_produk'];
			 $pv=$datax['PV'];
			 $jml_poin=$jml*$pv;
			 $total=$total+$jml_poin+0;
		}
	return $total;
}
//----jml member kiri-----------
function memberkiri($username, $dtgl) {
global $mysqli;
	$ki="";
	//-----------cari level tertinggi-------------
	$sqlu = $mysqli->query("select level from upline where username='$username'");
	$ups = $sqlu->fetch_row();
	$mylev = $ups[0];;
	$slv="select * from upline order by level desc";
	$rlv=$mysqli->query($slv);
	$slev=$rlv->fetch_array();
//	if($slev["level"] <= 20) {
		$jmlev=$slev["level"] - $mylev;
	//} else {
		//$jmlev = 20;
	//}
	//------------------- kiri -----------------
	if($dtgl == "") {
		$sqlki="select a.username, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kiri'";
	} else {
		$sqlki="select a.username, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kiri' $dtgl";
	}
	$rki=$mysqli->query($sqlki);

	$kir=$rki->fetch_array();
	$adaki=$rki->num_rows;
	$user=$kir[0];
	$upliki=$kir["upline0"];
		$rki->free_result();
	
	if ($adaki > 0)
	{

		for($i=0;$i<$jmlev;$i++)
		{
			if($dtgl == "") {
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$i='$user'";
			} else {
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$i='$user' $dtgl";
			}
			$res=$mysqli->query($sql2);
	
			$jml=array();
	
			$jml[$i]=$res->num_rows;
			$tot=$tot+$jml[$i];
			$lv=2 + $i;
			$tal=0;
	
			$tal=$tal+$tot;
		$res->free_result();

	
		}
		//if($dtgl == "") {
			$totki=$tot+1;
		//} else {
		//	$totki = $tot;
		//}
		
	
	} else {
		$totki=0;
	}
	//echo $totki;
	$ki=$totki;
	return $ki;
}
//----jml member kanan-----------
function memberkanan($username, $dtgl) {
global $mysqli;
	$ka="";
	//-----------cari level tertinggi-------------
	$sqlu = $mysqli->query("select level from upline where username='$username'");
	$ups = $sqlu->fetch_row();
	$mylev = $ups[0];;
	$slv="select * from upline order by level desc";
	$rlv=$mysqli->query($slv);
	$slev=$rlv->fetch_array();
//	if($slev["level"] <= 20) {
		$jmlev=$slev["level"] - $mylev;
	//} else {
		//$jmlev = 20;
	//}
	//---------------kanan-----------
	if($dtgl == "") {
		$sqlka="select a.username, b.tglaktif, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kanan'";
	} else {
		$sqlka="select a.username, b.tglaktif, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kanan' $dtgl";
	}
	
	
	$rka=$mysqli->query($sqlka);
	$kan=$rka->fetch_row();
	$adaka=$rka->num_rows;
	$user2=$kan[0];
//$jmlev=18;
	$tot2=0;
		$rka->free_result();
	if ($adaka > 0)
	{
		for($j=0;$j<$jmlev;$j++)
		{
		//	if($dtgl == "") {
		//	$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$j='$user2' and b.status=1";
		//	} else {
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$j='$user2' $dtgl";
		//	}
			//$sql2="select * from upline where upline$j='$user2'";
	
			$res=$mysqli->query($sql2);
			$jml=array();
			$jml[$j]=$res->num_rows;
		$res->free_result();

			$tot2=$tot2+$jml[$j];
			$lv2=2 + $j;
			$tal=0;
			$tal=$tal+$tot;
		

		}
	
	//echo $lv2;
		//if($dtgl == "") {
		//	$totka=$tot2+1;
		//} else {
			$totka = $tot2 + 1;
		//}
	} else {
		$totka=0;
	}
	//echo $totka;
	$ka=$totka;
	return $ka;
}

//--kanan-------------

//----jml member kiri-----------
function daftarmemberkiri($username, $dtgl) {
global $mysqli;
	$ki="";
	//-----------cari level tertinggi-------------
	$sqlu = $mysqli->query("select level from upline where username='$username'");
	$ups = $sqlu->fetch_row();
	$mylev = $ups[0];;
	$slv="select * from upline order by level desc";
	$rlv=$mysqli->query($slv);
	$slev=$rlv->fetch_array();
		$jmlev=$slev["level"] - $mylev;
	if($dtgl == "") {
		$sqlki="select a.username, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kiri'";
	} else {
		$sqlki="select a.username, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kiri' $dtgl";
	}
	$rki=$mysqli->query($sqlki);

	$kir=$rki->fetch_array();
	$adaki=$rki->num_rows;
	$user=$kir[0];
	echo '1. '.$user.'<br>';
	$upliki=$kir["upline0"];
		$rki->free_result();
	
	if ($adaki > 0)
	{

		for($i=0;$i<$jmlev;$i++)
		{
			if($dtgl == "") {
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$i='$user'";
			} else {
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$i='$user' $dtgl";
			}
			$res=$mysqli->query($sql2);
	
			$jml=array();
			$no=$i-1;
			$jml[$i]=$res->num_rows;
			$dataka=$res->fetch_array();
			echo $no.'. '.$dataka['username']."<br>";
			$tot=$tot+$jml[$i];
			$lv=2 + $i;
			$tal=0;
	
			$tal=$tal+$tot;
			$res->free_result();

	
		}
		//if($dtgl == "") {
			$totki=$tot+1;
		//} else {
		//	$totki = $tot;
		//}
		
	
	} else {
		$totki=0;
	}
	//echo $totki;
	 $ki=$totki;
	//return $ki;
}
//----jml member kanan-----------
function daftarmemberkanan($username, $dtgl) {
global $mysqli;
	$ka="";
	//-----------cari level tertinggi-------------
	$sqlu = $mysqli->query("select level from upline where username='$username'");
	$ups = $sqlu->fetch_row();
	$mylev = $ups[0];;
	$slv="select * from upline order by level desc";
	$rlv=$mysqli->query($slv);
	$slev=$rlv->fetch_array();
		$jmlev=$slev["level"] - $mylev;
	//---------------kanan-----------
	if($dtgl == "") {
		$sqlka="select a.username, b.tglaktif, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kanan'";
	} else {
		$sqlka="select a.username, b.tglaktif, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kanan' $dtgl";
	}
	
	
	$rka=$mysqli->query($sqlka);
	$kan=$rka->fetch_row();
	$adaka=$rka->num_rows;
	$user2=$kan[0];
	echo '1. '.$user2.'<br>';
	$tot2=0;
		$rka->free_result();
	if ($adaka > 0)
	{
		for($j=0;$j<$jmlev;$j++)
		{
		//	if($dtgl == "") {
		//	$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$j='$user2' and b.status=1";
		//	} else {
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$j='$user2' $dtgl";
		//	}
			//$sql2="select * from upline where upline$j='$user2'";
	
			$res=$mysqli->query($sql2);
			$no=$i-1;
			$jml=array();
			$jml[$j]=$res->num_rows;
			$dataka=$res->fetch_row();
			echo $no.'. '.$dataka[0]."<br>";
		    $res->free_result();

			$tot2=$tot2+$jml[$j];
			$lv2=2 + $j;
			$tal=0;
			$tal=$tal+$tot;
		

		}
	
			$totka = $tot2 + 1;
		//}
	} else {
		$totka=0;
	}
	//echo $totka;
	 $ka=$totka;
	//return $ka;
}

//--kanan-------------

function is_odd ($n) {
	return ($n & 1);
}	

//--
function category_name($id) {
	$number = trim(strip_tags($id));
    $id = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
	$sql = $mysqli->query("select title from categories where id='$id'") or die;
	$kat = $sql->fetch_row();
	$cat = $kat[0];
	return $cat;
		$sql->free_result();
}	

function menu_show($pos, $catid, $m) {
	$sql = $mysqli->query("select id, name, link from menu where published=1 order by ordering") or die;
	
	echo "<div id=$pos><ul id=saturday>";
	while($row = $sql->fetch_row()) {
		if($row[2] == "?m=home" or $row[2] == "") {
			$link = "./";
		} else {
			$link = $row[2];
		}
		//---url---
		$ul0 = array();
		$ul = explode("=", $row[2]);
		$ul0[2] = $ul[2]; //----m=content
		$ul0[1] = $ul[1];
		$ur = explode("&", $ul0[1]);
		$ur0 = $ur[0];
		
		//$catid=$_REQUEST["catid"];
		
		if($catid == $ul0[2] && $m == $ur0 or $m == "" && $ur0 == "home") {
			$class = "class=current";
		} else {
			$class = "";
		}		
		$sql->free_result();	
		echo "<li><a href='$link' $class>$row[1]</a></li>";
	}
	echo "</ul></div>";
}			

//--make random password-----------
function makeRandomPassword() { 
          $salt = "abchefghjkmnpqrstuvwxyz0123456789"; 
          srand((double)microtime()*1000000);  
          $i = 0; 
          while ($i <= 7) { 
                $num = rand() % 33; 
                $tmp = substr($salt, $num, 1); 
                $pass = $pass . $tmp; 
                $i++; 
          } 
          return $pass; 
}


//------------upline spillover-----------
function spillover($field, $username) {
	$sql="SELECT kiri, kanan FROM upline WHERE username='$username'";
	$mq=$mysqli->query($sql);
	$cek=$mq->num_rows;
	$ada=$mq->fetch_row();
	if($ada[0] == "" or $ada[1] == "") {
		if($ada[0] == "") {
			$posisi = "KIRI";
		} else {
			$posisi = "KANAN";
		}
		//echo "upline = $username<br>Posisi : $posisi<br>";
		//echo "kiri : $ada[0]<br>kanan : $ada[1]<br>";
		if($field == "random") {
			$nm="";
			$nm=$username;
			return $nm;
		}
		if($field == "pos") {
			$ps="";
	 		$ps=$posisi;
			return $ps;
		}
	} else {
		$upli=array();
		$pos=array();
		for($i=0;$i<12;$i++) {
		$sql="SELECT username, kiri, kanan FROM upline WHERE upline$i='$username'";
		$mq=$mysqli->query($sql);
		$cek=$mq->num_rows();
		while($ada=$mq->fetch_row()) {
			if($ada[1] == "" or $ada[2] == "") {
			if($ada[1] == "") {
				$posisi = "KIRI";
			} else {
				$posisi = "KANAN";
			}
	//echo "upline$i = $ada[0]<br>Posisi : $posisi<br>";
	//echo "kiri : $ada[1]<br>kanan : $ada[2]<br>";
			$upli[]=$ada[0];	
			$pos[]=$posisi;
		}
	}
	//echo "upline$i = $ada[0]<br>Posisi : $posisi<br>";

	}
	if($field == "random") {
		$nm="";
		$nm=$upli[0];
		return $nm;
	}
	if($field == "pos") {
		$ps="";
	 	$ps=$pos[0];
		return $ps;
	}
	}
		$mq->free_result();
}
//---------tgl expire----------
function formatgl($tgaktif) {
	$tg = "";
	//$tgaktif = date("Y-m-d"); 
	$hari=array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
	$bulane = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$expire = date("w, d m Y",strtotime($tgaktif)); 
//$showexp = date("w n d Y",time() + (7776000/3)); 
	$day = substr($expire, 0, 1);
	$tgle = substr($expire, 3,2);
	$blne = substr($expire, 6,2);
	$thne = substr($expire, 9,4);
	if($blne < 10 ) {
		$blne0 = substr($blne, 1,1) - 1;
	} else {
		$blne0 = $blne - 1;
	}
	$tg =  "$hari[$day], $tgle $bulane[$blne0] $thne";
	return $tg;
}

/*---jml member per level-
function jmlmember($username, $dtgl) {
	$jm = 0;
	$jm = memberkiri($username, $dtgl) + memberkiri($username, $dtgl);
	return $jm;
}	*/
function jmlmember($username, $field) {
	global $mysqli;
			$jm = 0;

			$sql = $mysqli->query("select a.username, a.status, a.blokir, b.sponsor from member as a inner join upline as b on a.username=b.username where $field");
	$jm=$sql->num_rows;
	
			return $jm;
		}		

function warning($text) {
	echo "<div id='warning'><p align=center>$text</p></div>";
}	
function kwitansi() {
	global $mysqli;
	$ko = 0;
	$sql = $mysqli->query("select kode from kwitansi order by kode desc");
	if($sql->num_rows == 0) {
		$sql->free_result();
		$ko = 100123;
	} else {	
		$data = $sql->fetch_row();
		$ko = $data[0] + 1;
		$sql->free_result();
	}	
	return $ko;
}	
function free($query){
	
	$ko = 0;
	$sql = $mysqli->query($query);
$sql->free_result();
}

//--mbr ki ka
function jaringanmember($username, $posisi) {
global $mysqli;
	$ka=0;
	$sql = $mysqli->query("select $posisi from jaringan where username='$username'");
	$data = $sql->fetch_row();
	$ka = $data[0];
	return $ka;
}	

# New Genealogy 
	//---menunggu2--
		function Menunggu2($username, $posisi, $dtgl) {
			$n=0;	
			$kiri = kirikanan2($username, "kiri", "1", $dtgl);
			$kanan = kirikanan2($username, "kanan", "1", $dtgl);
			if($kiri >= $kanan && $posisi == "kiri") {
				$mp = $kiri - $kanan;
			} else if($kiri >= $kanan && $posisi == "kanan") {
				$mp = 0;
			} else if($kiri < $kanan && $posisi == "kanan") {
				$mp = $kanan - $kiri;
			} else {	
			
				$mp = 0;
			}
			$n = $mp;
			return $n;
		}	
		//---new mbr2
		function kirikanan2($username, $posisi, $status, $dtgl) {
			$n=0;
			$rep=str_replace("tglbayar", "b.tglaktif", $dtgl);
			$level = dataupline("level", $username);
			//$user = $this->dataupline($posisi, $username);
			/*if($user && $this->dataku("status", $user) == $status) {
				$tm = 1;
			} else {
				$tm = 0;
			}	
			*/	
			global $mysqli;
	$ko = 0;
			$sqlu = $mysqli->query("select a.$posisi, b.tgl from upline as a inner join member as b on a.username=b.username where  a.username='$username' and b.status='$status' and plan='B'");
			$data=$sqlu->fetch_row();
			
			
			//if($posisi == "kiri") {
				$user = $data[0];
			//} else {
				//$user = $data[1];
			//}		
			if($user) $t = 1;
			$sql_lev = $mysqli->query("select level from upline order by level desc");
			$rowlev = $sql_lev->fetch_row();
			$loop = $rowlev[0] - $level;
			for($i=0;$i<$loop;$i++) {
				if($i == 0) {
					$sql=$mysqli->query("select a.username, b.tgl from upline as a inner join member as b on a.username=b.username where  a.upline$i='$username' and a.posisi='$posisi' and b.status='$status' and plan='B' $rep");
					$ada0 = $sql->num_rows;
				} else {
					$o = $i-1;
					$sql=$mysqli->query("select a.username, b.tgl from upline as a inner join member as b on a.username=b.username where  a.upline$i='$username' and a.upline$o='$user' and b.status='$status' and plan='B' $rep");
				}
				$ada = $sql->num_rows;
				$n0 = $n0 + $ada;
			}
				$n = $n0;
			return $n;
		}	
	function getPoinKiri($username){
		global $mysqli;
$ki="";
	//-----------cari level tertinggi-------------
	$sqlu = $mysqli->query("select level from upline where username='$username'");
	$ups = $sqlu->fetch_row();
	$mylev = $ups[0];;
	$slv="select * from upline order by level desc";
	$rlv=$mysqli->query($slv);
	
	$slev=$rlv->fetch_array();
		$jmlev=$slev["level"] - $mylev;
	if($dtgl == "") {
		$sqlki="select a.username, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kiri'";
	} else {
		$sqlki="select a.username, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kiri' $dtgl";
	}
	$rki=$mysqli->query($sqlki);
$adaki=$rki->num_rows;
	if ($adaki > 0)
	{
	$kir=$rki->fetch_array();
	$user=$kir[0];
	$sqlkiP="select sum(jml_poin)as jml1 from member_poin where username='$user'";
	$rkiP=$mysqli->query($sqlkiP);
	$kirP=$rkiP->fetch_array();
	$jml_poink1=$kirP['jml1'];
	$upliki=$kir["upline0"];
	$rki->free_result();

		for($i=0;$i<$jmlev;$i++)
		{
			if($dtgl == "") {
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$i='$user'";
			} else {
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$i='$user' $dtgl";
			}
			$res=$mysqli->query($sql2);
				$jml_dataki=$res->num_rows;
			if($jml_dataki>0){

			$no=$i+2;
			$dataka=$res->fetch_array();
				$sqlkaP="select sum(jml_poin)as jmlPoin from member_poin where username='".$dataka['username']."'";
				$rkaP=$mysqli->query($sqlkaP);
				$kiaP=$rkaP->fetch_array();
	
				$tot=$tot+$jml[$i];
				$subjml_poinki=$subjml_poinki+$kiaP['jmlPoin'];
			}
			$res->free_result();

	
		}
	}
	 $total_poinki=$subjml_poinki+$jml_poink1;
	 return $total_poinki;
	}
	
		function getPoinKanan($username){
global $mysqli;
$ka="";
	//-----------cari level tertinggi-------------
	$sqlu = $mysqli->query("select level from upline where username='$username'");
	$ups = $sqlu->fetch_row();
	$mylev = $ups[0];;
	$slv="select * from upline order by level desc";
	$rlv=$mysqli->query($slv);
	$slev=$rlv->fetch_array();
		$jmlev=$slev["level"] - $mylev;
	//---------------kanan-----------
	if($dtgl == "") {
		$sqlka="select a.username, b.tglaktif, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kanan'";
	} else {
		$sqlka="select a.username, b.tglaktif, b.status from upline as a inner join member as b on a.username=b.username where a.upline0='$username' and a.posisi='kanan' $dtgl";
	}
	
	
	$rka=$mysqli->query($sqlka);
	$adaka=$rka->num_rows;
	if ($adaka > 0)
	{
	$kan=$rka->fetch_row();
	$user2=$kan[0];
	$sqlkiP="select sum(jml_poin)as jml1 from member_poin where username='$user2'";
	$rkiP=$mysqli->query($sqlkiP);
	$kirP=$rkiP->fetch_array();
	$jml_poinka=$kirP['jml1'];
		$rka->free_result();
	
		for($j=0;$j<$jmlev;$j++)
		{
			$sql2="select a.username, b.tglaktif from upline as a inner join member as b on a.username=b.username where a.upline$j='$user2' $dtgl";
			$res=$mysqli->query($sql2);
			$jml_dataka=$res->num_rows;
			if($jml_dataka>0){
			$nox=$j+2;
			$dataka=$res->fetch_row();
			
				$sqlkaP="select sum(jml_poin)as jmlPoin from member_poin where username='".$dataka[0]."'";
				$rkaP=$mysqli->query($sqlkaP);
				$kiaP=$rkaP->fetch_array();
				$subjml_poinka=$subjml_poinka+$kiaP['jmlPoin'];
			}
		    $res->free_result();
		}
	
	}
 $total_poinka=$subjml_poinka+$jml_poinka;
return $total_poinka;
		}
		
		function getPoinCair($username,$posisi){
			global $mysqli;
	$sqlkiP="select sum(jml_poin)as jml1 from member_tarikpoin where username='$username' and sumber='$posisi'";
	$rkiP=$mysqli->query($sqlkiP);
	$kirP=$rkiP->fetch_array();
	return $jml_poinka=$kirP['jml1'];
			
		}
?>