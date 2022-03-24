<?php session_start();         
require("../include/notice.php"); 
require("../include/koneksi.php"); 
require("../include/fungsi.php");
$param=$_GET["param"];
switch($param){

	case 'global':
		
        $tabel    = $_POST['tabel'];
        $key    = $_POST['key'];
        $param    = $_POST['param'];
		$val    = $_POST['val'];

		 $query="SELECT * FROM ".$tabel."";
		$result= $mysqli->query($query);
		
		 $data = "<option value=''> - Pilih - </option>";
		    while ($value=$result->fetch_assoc()) {
				if($val==$value["$key"]){$select="selected";}else{$select="";}
		        $data .= "<option value='".$value["$key"]."' $select>".$value["$param"]."</option>";
		    }
		    echo $data;

	break;
	case 'kabupaten':
		$val     = $_GET['val'];
		$kab     = $_POST['kabupaten'];
        $query="SELECT * FROM wilayah_kabupaten where provinsi_id='".$val."'";
		$result= $mysqli->query($query);
		
		 $data = "<option value=''> - Pilih Kabupaten - </option>";
		    while ($value=$result->fetch_assoc()) {
				if($kab==$value["id"]){$select="selected";}else{$select="";}
		        $data .= "<option value='".$value["id"]."' $select>".$value["nama"]."</option>";
		    }
		    echo $data;

	break;
	case 'kecamatan':
		$val     = $_GET['val'];
		$kec=$_POST["kecamatan"];
        $query="SELECT * FROM wilayah_kecamatan where kabupaten_id='".$val."'";
		$result= $mysqli->query($query);
		
		 $data = "<option value=''> - Pilih Kecamatan - </option>";
		    while ($value=$result->fetch_assoc()) {
				if($kec==$value["id"]){$select="selected";}else{$select="";}
		        $data .= "<option value='".$value["id"]."' $select>".$value["nama"]."</option>";
		    }
		    echo $data;

	break;
	case 'kelurahan':
		$val     = $_GET['val'];
		$kel     = $_POST['kelurahan'];
        $query="SELECT * FROM m_nama_kelurahan where id_kecamatan='".$val."'";
		$result= $mysqli->query($query);
		
		 $data = "<option value=''> - Pilih Kelurahan - </option>";
		    while ($value=$result->fetch_assoc()) {
				if($kel==$value["id_kelurahan"]){$select="selected";}else{$select="";}
		        $data .= "<option value='".$value["id_kelurahan"]."' $select>".$value["nama_kelurahan"]."</option>";
		    }
		    echo $data;

	break;
	
	case 'kabupatenedit':
		$val     = $_GET['val'];
		$kab     = $_GET['kabupaten'];
        $query="SELECT * FROM m_nama_kota where id_provinsi='".$val."'";
		$result= $mysqli->query($query);
		
		 $data = "<option value=''> - Pilih Kabupaten - </option>";
		    while ($value=$result->fetch_assoc()) {
				if($kab==$value["id_kota"]){$select="selected";}else{$select="";}
		        $data .= "<option value='".$value["id_kota"]."' $select>".$value["nama_kota"]."</option>";
		    }
		    echo $data;

	break;
	case 'kecamatanedit':
		$val     = $_GET['val'];
		$kec=$_GET["kecamatan"];
        $query="SELECT * FROM m_nama_kecamatan where id_kota='".$val."'";
		$result= $mysqli->query($query);
		
		 $data = "<option value=''> - Pilih Kecamatan - </option>";
		    while ($value=$result->fetch_assoc()) {
				if($kec==$value["id_kecamatan"]){$select="selected";}else{$select="";}
		        $data .= "<option value='".$value["id_kecamatan"]."' $select>".$value["nama_kecamatan"]."</option>";
		    }
		    echo $data;

	break;
	case 'kelurahanedit':
		$val     = $_GET['val'];
		$kel     = $_GET['kelurahan'];
        $query="SELECT * FROM m_nama_kelurahan where id_kecamatan='".$val."'";
		$result= $mysqli->query($query);
		
		 $data = "<option value=''> - Pilih Kelurahan - </option>";
		    while ($value=$result->fetch_assoc()) {
				if($kel==$value["id_kelurahan"]){$select="selected";}else{$select="";}
		        $data .= "<option value='".$value["id_kelurahan"]."' $select>".$value["nama_kelurahan"]."</option>";
		    }
		    echo $data;

	break;
		case 'getData':
		
        $kd    = $_POST['val'];
		$id     = $_POST['cid'];
        $nm_tabel= $_POST['cnmtabel'];
        $key    = $_POST['ckeytabel'];
		 $query="SELECT * FROM ".$nm_tabel." WHERE `".$key."`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		echo json_encode($data);

	break;
	case 'getJarakTempuh':
		
        $kd    = $_POST['val'];
        $kd_parq    = $_POST['val2'];
		
		$kd_jemaah=getName("parq","kd_parq",$kd_parq,"kd_jemaah");
		$tgl_lahir=getName("jemaah","kd_jemaah",$kd_jemaah,"tgl_lahir");
		$jk=getName("jemaah","kd_jemaah",$kd_jemaah,"jenis_kelamin");
	 	 $usia=hitung_usia($tgl_lahir);
			$hasil=getWalkingTest($jk,$usia,$kd);
			 echo json_encode(array("hasil" => $hasil));

	break;
}
?>