

  <div class="container">

<ol class="breadcrumb breadcrumb-col-blue">
  <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
  </li>
  <!-- <li><a href="<?php echo base_url();?>admin/settings/password"> Settings</a> <i class="fas fa-chevron-right"></i>&nbsp;
  </li> -->
  <li class="active">Change Password</li>
</ol>

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-12">
          <div class="p-5">
            <div class="">
              <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
            </div>
            <form class="user" role="form" id="userForm" action="<?php echo ADMIN_URL; ?>settings/changepassword" method="post">

             
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="exampleInputPassword1">Current Password</label>&nbsp;<span id="password_error" style="color:#FF0000;"></span>
                  <input type="password" class="form-control form-control-user rmerror" id="cur_password" name="cur_password" placeholder="Current Password" value="">
                </div>
               
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" class="form-control form-control-user rmerror" id="new_password" name="new_password" placeholder="New Password" value="">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" class="form-control form-control-user rmerror" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="">
                </div>
            </div>
            
            <br>
            <button type="button" id="saveBtn" style="font-size: 1rem;" class="float-right btn btn-primary btn-user" onclick="validate()">Save</button>
              
            <br>
           
            

             
            </form>
           
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<script>
function validate(){


  var cur_password = $('#cur_password').val();
  var new_password = $('#new_password').val();
  var confirm_password = $('#confirm_password').val();


  if(cur_password==''){
    $('.rmerror').removeClass('errorborder')
    $('#cur_password').addClass('errorborder');
  }else if(new_password==''){
    $('.rmerror').removeClass('errorborder')
    $('#new_password').addClass('errorborder');
  }else if(confirm_password==''){
    $('.rmerror').removeClass('errorborder')
    $('#confirm_password').addClass('errorborder');
  }else if(new_password != confirm_password ){
    $('#confirm_password').addClass('errorborder');
  }else{
    //alert("here");
    $('.rmerror').removeClass('errorborder')
    $.ajax({
				  type: 'POST',
				  url:"<?php echo base_url(); ?>admin/settings/change",
				  data: {'cur_password':cur_password},
				  success: function(resultData) { 
            resultData = JSON.parse(resultData);
            if(resultData.status){
              $('#password_error').text("")
              $("#userForm").submit();
            }else{
              $('#cur_password').addClass('errorborder');
              
              $('#password_error').text(resultData.message)
              //$("#userForm").submit();
            }
				    //$("#userForm").submit();
				  }
			});
    
    
  }
  //applnForm
}
</script>  

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker(
          {
              format: 'YYYY-MM-DD',
              date: "<?php if(isset($details['dob'])){ echo $details['dob']; }?>",
              maxDate: Date()
          }
        );
    });
</script>