
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
     <link rel="shortcut icon" href="assets/dist/img/favicon.ico">

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/login-style.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/plugins/validasi/dist/css/bootstrapValidator.css"/>

  </head>
  <body>
  <div class="container">

</div>
<br>
<br>
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="form-body">
   Masukkan Username
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
        <div class="innter-form">
         <?php
    /* handle error */
    if (isset($_GET['error'])) : ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Warning!</strong> <?=base64_decode($_GET['error']);?>
        </div>
    <?php endif;?>
             <form action="check-login.php" class="sa-innate-form" method="post" id="formLogin">
            <label>Username</label>
            <input type="text" name="username">
            <label>Password</label>
            <input type="password" name="password">
            <button type="submit">Sign In</button>
            </form>
            </div>
            <div class="social-login">
           
            </div>
            <div class="clearfix"></div>
        </div>
       
    </div>
    </div>
    </div>
    </div>
    </div>

  

<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
           <!-- Validasi -->
    <script type="text/javascript" src="assets/plugins/validasi/dist/js/bootstrapValidator.js"></script>
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
            username: {
                group: '.col-lg-12',
                validators: {
                    notEmpty: {
                        message: 'Username tidak boleh kosong'
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

  </body>
</html>