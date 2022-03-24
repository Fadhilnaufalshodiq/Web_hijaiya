<?php
function rupiah($angka) {
	$rupiah="";
	$rp=strlen($angka);
	while ($rp>3) {
		$rupiah = ".". substr($angka,-3). $rupiah;
		$s		= strlen($angka) - 3;
		$angka	= substr($angka,0,$s);
		$rp		= strlen($angka);
	}
	$rupiah = "Rp." . $angka . $rupiah . ",00-";
	return $rupiah;
}

function angka($angka) {
	$rupiah="";
	$rp=strlen($angka);
	while ($rp>3) {
		$rupiah = ".". substr($angka,-3). $rupiah;
		$s		= strlen($angka) - 3;
		$angka	= substr($angka,0,$s);
		$rp		= strlen($angka);
	}
	$rupiah = $angka . $rupiah;
	return $rupiah;
}
function hilangtitik($angka){
	return $data= str_replace(".", "", $angka);
}
function WKT($sekarang){
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,0,4);

$judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");
$wk=$tanggal." ".$judul_bln[(int)$bulan]." ".$tahun;
return $wk;
}
?>
<?php
function BAL($tanggal){
    $arr=split(" ",$tanggal);
    if($arr[1]=="Januari"){$bul="01";}
    else if($arr[1]=="Februari"){$bul="02";}
    else if($arr[1]=="Maret"){$bul="03";}
    else if($arr[1]=="April"){$bul="04";}
    else if($arr[1]=="Mei"){$bul="05";}
    else if($arr[1]=="Juni"){$bul="06";}
    else if($arr[1]=="Juli"){$bul="07";}
    else if($arr[1]=="Agustus"){$bul="08";}
    else if($arr[1]=="September"){$bul="09";}
    else if($arr[1]=="Oktober"){$bul="10";}
    else if($arr[1]=="November"){$bul="11";}
    else if($arr[1]=="Nopember"){$bul="11";}
    else if($arr[1]=="Desember"){$bul="12";}
return "$arr[2]-$bul-$arr[0]";  
}
function getName($tb,$primary,$parameter,$field){
	global $mysqli;
	$selectArg="select * from `".$tb."` where `".$primary."`='$parameter'";
	$selectDB=mysqli_query($mysqli,$selectArg);
			$d=mysqli_fetch_assoc($selectDB);
 $d[$field];
return $d[$field];
}
function getCodes(){
		global $mysqli;
$query="SELECT * FROM codes WHERE `aktif`= 'ya' order by codes asc";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
			 return $codes = $data['codes'];
}
		//$id_anggota = kode('tb_anggota',5,'id_anggota','ANG'); //penggunaannya
function getKode($table, $param, $kode,$a1,$a2) {
@$today = date("Ymd");

global $mysqli;
	$qri = "SELECT MAX($param) AS last FROM $table where $param like '%$today%'";
	$hsl = $mysqli->query($qri);
	$row = $hsl->fetch_array();
$lastNo = $row["last"];
$custom_code =$kode;
$code=$kode.$today;
// baca nomor urut Pengajuan dari id Pengajuan terakhir
//SM-20170517 002 (11,3)
$lastNoUrut = substr($lastNo, $a1, $a2); 

// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;

// membuat format nomor Pengajuan berikutnya
$no_nota = $code.sprintf('%0'.$a2.'s', $nextNoUrut);
		return $no_nota;
	}

function cmb_dinamis($name,$table,$field,$pk,$selected,$option=NULL){
    global $mysqli;
    $cmb = "<select name='$name' class='form-control' id='$name'>";
	if($option!=""){ $cmb .="<option value=''>-- $option --</option>";}
	 $query="SELECT * FROM $table";
		$result= $mysqli->query($query);
    while($d=$result->fetch_assoc()){
        $cmb .="<option value='".$d["$pk"]."'";
        $cmb .= $selected==$d["$pk"]?" selected='selected'":'';
        $cmb .=">".  strtoupper($d["$field"])."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}
function statusPIN($stt){
	switch ($stt)
        {
            case 0:
                return "<span class=\"btn btn-success btn-xs purple\" data-toggle=\"tooltip\" title=\"Belum Digunakan\">Aktif</span>";
                break;
            case 1:
                return "<span class=\"btn btn-danger btn-xs purple\" data-toggle=\"tooltip\" title=\"Sudah Digunakan\">Tidak Aktif</span>";
                break;
          
        }
}
function statusBayar($stt){
	switch ($stt)
        {
            case 0:
                return "<span class=\"btn btn-success btn-xs purple\" data-toggle=\"tooltip\" title=\"Belum dibayarkan\">Belum dibayar</span>";
                break;
            case 1:
                return "<span class=\"btn btn-danger btn-xs purple\" data-toggle=\"tooltip\" title=\"Sudah dibayarkan\">Sudah dibayar</span>";
                break;
          
        }
}
function yatidak($stt){
	switch ($stt)
        {
            case 1:
                return "ya";
                break;
            case 2:
                return "tidak";
                break;
          
        }
}
function jenkel($stt){
	switch ($stt)
        {
            case 1:
                return "laki-laki";
                break;
            case 2:
                return "perempuan";
                break;
          
        }
}
function pendidikan($stt){
	switch ($stt)
        {
            case 1:
                return "SD/MI/sederajat";
                break;
            case 2:
                return "SMP/MTS/sederajat";
                break;
			case 3:
                return "AMA/MA/sederajat";
                break;
           case 4:
                return "Diplomat/Universitas";
                break;
        }
}
function pembantu($stt){
	switch ($stt)
        {
            case 1:
                return "Perorangan";
                break;
            case 2:
                return "PT(Perusahaan)";
                break;
			case 3:
                return "Tidak tahu";
                break;
           
        }
}
function hubKeluarga($stt){
	switch ($stt)
        {
            case 1:
                return "Melalui HP";
                break;
            case 2:
                return "Melalui Media Sosial";
                break;
			case 3:
                return "Melalui Surat";
                break;
				case 4:
                return "Melalui E-mail (Surat Elektronik)";
                break;
				case 5:
                return "Tidak Pernah Menghubungi";
                break;
           
        }
}
function medsos($stt){
	switch ($stt)
        {
            case 1:
                return "Facebook";
                break;
            case 2:
                return "Instagram";
                break;
			case 3:
                return "Twitter";
                break;
				case 4:
                return "Path";
                break;
				case 5:
                return "Tidak ada";
                break;
           
        }
}
function kirimuang($stt){
	switch ($stt)
        {
            case 1:
                return "Melalui Bank";
                break;
            case 2:
                return "Melalui Western Union";
                break;
			case 3:
                return "Melalui Perorangan";
                break;
				case 4:
                return "Dibawa sendiri";
                break;
				case 5:
                return "Dititipkan ke teman/keluarga TKI yang Pulang";
                break;
				case 6:
                return "Tidak Pernah mengirim Uang";
                break;
           
        }
}
function kegiatansaatini($stt){
	switch ($stt)
        {
            case 1:
                return "Berwirausaha";
                break;
            case 2:
                return "Bekerja";
                break;
			case 3:
                return "Sekolah/Kursus";
                break;
				case 4:
                return "Mengurus Rumah Tangga";
                break;
				case 5:
                return "Menganggur";
                break;
				
           
        }
}
function tertarikwirausaha($stt){
	switch ($stt)
        {
            case 1:
                return "ya";
                break;
            case 2:
                return "Ragu-ragu";
                break;
			case 3:
                return "Tidak";
                break;
			
				
           
        }
}

function getNoTransaksi($table,$param){
		global $mysqli;

	$today = date("Ymd");
// cari id transaksi terakhir yang berawalan tanggal hari ini
$query = "SELECT max($param) AS last FROM $table WHERE $param LIKE '$today%'";
$hasil = $mysqli->query($query);
$data  = $hasil->fetch_array();
$lastNoTransaksi = $data['last'];

// baca nomor urut transaksi dari id transaksi terakhir
$lastNoUrut = substr($lastNoTransaksi, 8, 4); 

// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;

// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);

return $nextNoTransaksi;
}

function SelisihTgl($tanggal,$tanggal2){
list($thn,$bln,$tgl) = explode("-",$tanggal);
list($thn2,$bln2,$tgl2) = explode("-",$tanggal2);

$jd = gregoriantojd($bln,$tgl,$thn);
$jd2 = gregoriantojd($bln2,$tgl2,$thn2);
$selisih = $jd2-$jd;
return($selisih);
}


# Fungsi untuk membalik tanggal dari format Indo (d-m-Y) -> English (Y-m-d)
function InggrisTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$tanggal="$thn-$bln-$tgl";
	return $tanggal;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl-$bln-$thn";
	return $tanggal;
}

function IndonesiaTgl2($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl/$bln/$thn";
	return $tanggal;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function Indonesia3Tgl($tanggal){
	$namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
					 "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
					 
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal ="$tgl ".$namaBln[$bln]." $thn";
	return $tanggal;
}


?>