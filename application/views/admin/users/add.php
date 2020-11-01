

  <div class="container">

  <ol class="breadcrumb breadcrumb-col-blue">
    <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
    </li>
    <li><a href="<?php echo base_url();?>admin/users"> Users</a> <i class="fas fa-chevron-right"></i>&nbsp;
    </li>
    <li class="active"> <?php if(!isset($details['user_id'])){ echo "Add new User";} else { echo "Details";} ?></li>
  </ol>

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="">
                <h1 class="h4 text-gray-900 mb-4">User Details</h1>
              </div>
              <form class="user" role="form" id="userForm" action="<?php echo ADMIN_URL; ?>users/add" method="post">

              <input type="hidden"  value="<?php if(isset($details['user_id'])){ echo $details['user_id']; }?>" id="user_id" name="user_id"/>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">First Name</label>
                    <input type="text" class="form-control form-control-user rmerror" id="first_name" name="first_name" placeholder="First Name" value="<?php if(isset($details['first_name'])){ echo $details['first_name']; }?>">
                  </div>
                  <div class="col-sm-6">
                    <label for="exampleInputPassword1">Last Name</label>
                    <input type="text" class="form-control form-control-user rmerror" id="last_name" name="last_name" placeholder="Last Name" value="<?php if(isset($details['last_name'])){ echo $details['last_name']; }?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="text" class="form-control form-control-user rmerror"  id="email" name="email" placeholder="Email" value="<?php if(isset($details['email'])){ echo $details['email']; }?>">
                  </div>
                  <div class="col-sm-6">
                    <label for="exampleInputPassword1">Country</label>
                    <input type="text" class="form-control form-control-user rmerror" id="country" name="country" placeholder="Country" value="<?php if(isset($details['country'])){ echo $details['country']; }?> ">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">City</label>
                    <input type="text" class="form-control form-control-user rmerror" id="city" name="city" placeholder="City" value="<?php if(isset($details['city'])){ echo $details['city']; }?> ">
                  </div>
                  <div class="col-sm-6">
                    <label for="exampleInputPassword1">Zipcode</label>
                    <input type="text" class="form-control form-control-user rmerror" id="zipcode" name="zipcode" placeholder="Zipcode" value="<?php if(isset($details['zipcode'])){ echo $details['zipcode']; }?> ">
                  </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-6">
                    <label for="exampleInputPassword1">Date Of Birth</label>
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" class="form-control form-control-user datetimepicker-input rmerror" data-target="#datetimepicker1" value="<?php if(isset($details['dob'])){ echo $details['dob']; }?>" id="dob" name="dob"/>
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>

                    <!-- <input type="text" class="form-control form-control-user" id="dob" name="dob" placeholder="Date Of Birth" value="<?php echo $details['dob'];?>"> -->
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Gender</label>
                    <select name="gender" id="gender" style="width: 100%;" class="form-control" tabindex="-1" 
          aria-hidden="true">
                      <option selected="selected" value="">Select Gender</option>
                      <option <?php if(isset($details['gender']) && $details['gender']=='male'){ ?>selected="selected"<?php }  ?>>Male</option>
                      <option <?php if(isset($details['gender']) && $details['gender']=='female'){ ?>selected="selected"<?php }  ?>>Female</option>
                      
                    </select>
                  </div>
                  
                </div>

               
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Address</label>
                    <textarea class="form-control form-control-user" name="address" > <?php if(isset($details['address'])){ echo $details['address']; }?> </textarea>
                  </div>
                </div>
              

               <?php if(!isset($details['user_id'])){ 
                  ?>

                 <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="text" class="form-control form-control-user rmerror" id="password" name="password" placeholder="Password" value="<?php if(isset($details['password'])){ echo $details['password']; }?> ">
                  </div>                 
                </div>
                <?php }?>
                <button type="button" id="saveBtn" style="font-size: 1rem;" class="float-right btn btn-primary btn-user" onclick="validate()">Save Details</button>
                
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


    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();


    if(first_name==''){
      $('.rmerror').removeClass('errorborder')
      $('#first_name').addClass('errorborder');
    }else if(last_name==''){
      $('.rmerror').removeClass('errorborder')
      $('#last_name').addClass('errorborder');
    }else{
      $('.rmerror').removeClass('errorborder')
      $("#userForm").submit();
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