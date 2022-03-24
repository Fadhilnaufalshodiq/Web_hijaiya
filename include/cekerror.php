<table width="98%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td style="color:#FF0000">
<?php
	 echo '<b>Anda tidak melengkapi isian formulir dengan lengkap! </b><br />'; 
    if(!$nama){ 
        echo "<span class='ceksalah'>- <b>Silahkan isi nama Anda dengan benar.</b></span><br />"; 
    } 
   
	if(!$alamat){ 
        echo "- Tulis alamat lengkap Anda.<br />"; 
    } 
	if(!$kota){ 
        echo "- Tulis kota Anda.<br />"; 
    } 
   // if(!$email){ 
    //    echo "- Silahkan tulis alamat email Anda dengan benar.<br />"; 
   // } 
	//if($setuju < 1){ 
     //   echo "Anda harus menyetujui peraturan ProgramPuss.com.<br />"; 
   // } 
	if(!$telepon){ 
        echo "- Silahkan tulis nomor telepon Anda dengan benar. Jika tidak punya ketik 0.<br />"; 
    } 
	if(!$hp){ 
        echo "- Silahkan tulis nomor HP Anda dengan benar. Jika tidak punya ketik 0.<br />"; 
    } 
    if(!$username){ 
        echo "- Masukkan user ID Anda minimal 4 huruf terdiri dari a-z, A-Z, 0-9 dan _ (underscore).<br />"; 
    } 
	if(!$password2){ 
        echo "- Masukkan password Anda minimal 6 huruf/karakter.<br />"; 
    } 
	if (!preg_match('/^[a-zA-Z0-9_]+$/', $username))    {
		echo "- Username hanya boleh terdiri dari a-z, A-Z, 0-9 dan _ (underscore).<br>";
		}
	if (strlen($username) < 4 ) {
		echo "- Username minimal 4 huruf.<br>";
		 } 
if  (!preg_match('/^[a-zA-Z0-9_]+$/', $password2))   {
		echo "- Password hanya boleh terdiri dari a-z, A-Z, 0-9<br>"; 
		} 
		if(strlen($password2) <  6)   {
			echo "- Password minimal 6 huruf/angka<br>";
			} 
	if($password1 <> $password2){ 
        echo "- Password tidak sama!<br>"; 
    } 
//    exit(); // if the error checking has failed, we'll exit the script! 
	
	?>
	&nbsp;</td>
  </tr><tr><td><?php
  if($referer == "admin") {
		$sp=$sponsore;
		$up = $upline;
	}
    echo"<meta http-equiv=\"refresh\" content=\"5; url=?m=registrasi.pec\">";
	exit;
 // header("location=?m=join&page=step2");
  ?>
      <p align="center"><strong>Klik tombol BACK pada browser untuk mengulang. </strong></p></td>
  </tr>
</table>
