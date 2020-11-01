<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Role Model</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>assets/css/sb-admin-2.css" rel="stylesheet">
  <link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="<?=base_url()?>/favicon.ico" type="image/x-icon"/>
  <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>/favicon-32x32.png"> 
  <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>/favicon-96x96.png"> 
  <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>/favicon-16x16.png"> 

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-6 col-md-5">

        <div class="card o-hidden border-0 shadow-lg my-5" style="top: 28%;">
          <div class="card-header p-2">
            <div class="text-center">
              <h1 class="text-gray-900"><img src="<?php echo base_url();?>assets/img/logo.png" style="height:110px;"></h1>
            </div>
          </div>
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg-12">
                <div class="p-5">
                  <form id="myform1" action="<?php echo site_url('admin/login/ajax_login');?>" method="post">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <!-- <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label> -->
                      </div>
                    </div>
                    
                    <input type="button" id="submitbut" class="btn btn-primary btn-user btn-block" value="Login" />              
                    
                   
                  </form>
                 
                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url();?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>
<script>
$("#submitbut").click(function(){
	
  var email=$("#email").val();
  var password=$("#password").val();
      if(email=='') {
        if(password =='') {
            $("#email").addClass("errorborder");		
            $("#password").addClass("errorborder");
            return false;
          }else{
            $("#email").addClass("errorborder");
            $("#password").removeClass("errorborder");
            return false;
          }
      } else if(password =='') {
        $("#email").removeClass("errorborder");
        $("#password").addClass("errorborder");
        return false;
      }else{
      
        $.ajax({	
              url:"<?php echo base_url()?>admin/login/check_login",
              type:"POST",
              data:{'email' : email ,
                  'password' : password ,
                },
              success:function (result)
              {	
                var result = $.parseJSON(result);
              
                if(result.status)
                {
                  window.location.href="<?php echo ADMIN_URL;?>dashboard";
                }
                else
                {	
                  $("#username").css("border-color", "#FF0000");
                  $("#password").css("border-color", "#FF0000");
                }
              }																					
        });
  }
});
</script>