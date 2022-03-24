<?php
session_start();
if ( isset($_SESSION['ses_level']) && $_SESSION['ses_level'] != '' ) {
require("../include/notice.php"); 
require("../include/koneksi.php"); 
//require("../include/config.php"); 
require("../include/fungsi.php"); 
//require("../include/function.php"); 
require("template_header.php"); 
require("template_sidebar.php"); 
require("template_content.php"); 
require("template_footer.php"); 
}else{
header('location:../login');
    exit();
}
?>