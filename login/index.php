<?php session_start();
if ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != '' ) {
        header('location:../');
        exit();
}
ob_start();
require("../include/notice.php"); 
require("../include/koneksi.php"); 
require("../include/fungsi.php"); 
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Login - Area</title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: MAIN CSS -->
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="assets/css/login.css">

        <link rel="stylesheet" href="assets/css/main-responsive.css">



        <link rel="stylesheet" href="assets/css/theme_light.css" type="text/css" id="skin_color">

<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700);
body {
   /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#9dd53a+0,a1d54f+50,80c217+51,7cbc0a+100;Green+Gloss+%231 */
background: #9dd53a; /* Old browsers */
background: -moz-linear-gradient(top,  #9dd53a 0%, #a1d54f 50%, #80c217 51%, #7cbc0a 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9dd53a', endColorstr='#7cbc0a',GradientType=0 ); /* IE6-9 */

    font-family: 'Open Sans', sans-serif!important;
}
</style>
    </head>

    <!-- end: HEAD -->
    <!-- start: BODY -->

    <body class="login">

        <div class="main-login col-sm-4 col-sm-offset-4">

            <div class="logo">
           <img src="assets/img/lgo.png" width="150" height="150"/> 

                <br>
                BACKEND ADMINSTRATOR</b>
                
    </div>

                    <!-- start: LOGIN BOX -->
 <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
            <div class="box-login">

                

                <p>
                  <?php
    /* handle error */
    if (isset($_GET['error'])) : ?>
        <div class="alert alert-warning alert-dismissible" status="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Warning!</strong> <?=base64_decode($_GET['error']);?>
        </div>
    <?php endif;?>
                </p>

                <form class="inner-login form-horizontal"  action="" method="post" id="formLogin">
                    
                    <fieldset>

                        <div class="form-group">
 <div class="col-lg-12">
                            <span class="input-icon">
<div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" name="user_name" placeholder="User Name">
</div>
                                <i class="fa fa-user"></i> </span>

                        </div>
                        </div>

                        <div class="form-group">
<div class="col-lg-12">
                            <span class="input-icon">
    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" name="password" placeholder="Password">
</div>
                                <i class="fa fa-lock"></i>
</span>
                        </div>
                        </div>
                       
                       
<!--  <div class="form-group">
                   <label class="col-lg-4 control-label" id="captchaOperation"></label>
                    <div class="col-lg-6">
                                <input type="text" class="form-control" name="captcha" />
                            </div>
                </div> -->
              
                        <div class="form-actions">


                            <button type="submit" class="btn btn-success pull-right">

                                Login <i class="fa fa-arrow-circle-right"></i>

                            </button>

                        </div>

                        <!-- <div class="new-account">

                            Don't have an account yet?

                            <a href="#" class="register">

                                Create an account

                            </a>

                        </div> -->

                    </fieldset>

                </form>

            </div>

            <!-- end: LOGIN BOX -->

            
            <!-- end: REGISTER BOX
            <!-- start: COPYRIGHT -->

            <div class="copyright">

                 

            </div>

            <!-- end: COPYRIGHT -->

        </div>


        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

        <script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../assets/plugins/validasi/dist/js/bootstrapValidator.js"></script>
        <!-- validasi form-->
<script type="text/javascript">
$(document).ready(function() {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    //$('#nama').value([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));
    $('#captchaOperation').html([randomNumber(1, 9), '+', randomNumber(1, 9), '='].join(' '));

    $('#formLogin').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        
        
        fields: {
            user_name: {
                group: '.col-lg-12',
                validators: {
                    notEmpty: {
                        message: 'user_name tidak boleh kosong'
                    }
                }
            },
            password: {
                group: '.col-lg-12',
                validators: {
                    notEmpty: {
                        message: 'Password tidak boleh kosong'
                    }
                }
            },
            
            
            captcha: {
                validators: {
                    callback: {
                        message: 'Jawabannya Kurang Tepat',
                        callback: function(value, validator) {
                            var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
                    }
                }
            }
        }
        
    })
 .on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            document.getElementById("formLogin").submit();
        });
        
   
    
    
});

</script>
    <?php 
if($_POST["user_name"] && $_POST["password"]){


$user_name = $_POST['user_name'];
$pass     = $_POST['password'];

    $sql_check = "SELECT id_admin,
                         user_name, 
                         status 
                  FROM tb_admin 
                  WHERE 
                       user_name=? 
                       AND 
                       password=? 
                  LIMIT 1";

    $check_log = $mysqli->prepare($sql_check);
    $check_log->bind_param('ss', $user_name, $password);

    $user_name = $_POST['user_name'];
    $password =  $_POST['password'] ;

    $check_log->execute();

    $check_log->store_result();

    if ( $check_log->num_rows == 1 ) {
        $check_log->bind_result($id_admin, $user_name, $status);

            $check_log->fetch();
            if($status=="admin"){
        $query="SELECT * FROM tb_admin WHERE `id_admin`= '$id_admin'";
        $result= $mysqli->query($query);
        $data=$result->fetch_assoc();
        $nama_user=$data["nama_user"];
            }
            $_SESSION['ses_id_admin'] = $id_admin;
            $_SESSION['namalengkap']    = $nama_user;
            $_SESSION['ses_level']       = $status;
            

        $check_log->close();
if($status=="dapur"){
    $_SESSION['user_login']='apps';
        header('location:../apps');
}else{
    $_SESSION['user_login']='apps';
        header('location:../apps');
}
        exit();

    } else {
        header('location: ?error='.base64_encode('user_name dan Password Invalid!!!'));
        exit();
    }
   
} 

                            
                            ?>