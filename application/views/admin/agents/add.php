

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="">
                <h1 class="h4 text-gray-900 mb-4">Agent Details</h1>
              </div>
              <form class="user" role="form" id="userForm" action="<?php echo base_url(); ?>admin/agents/add" method="post">

              
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" class="form-control form-control-user rmerror" id="name" name="name" placeholder="Name" 
                    value="<?php if(isset($details['name'])){ echo $details['name']; }?>">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control form-control-user rmerror" id="email" name="email" placeholder="Email" 
                    value="<?php if(isset($details['email'])){ echo $details['email']; }?>">
                  </div>
                </div>
                <div class="form-group row">
                  
                  <div class="col-sm-6">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control form-control-user rmerror" id="password" name="password" placeholder="Password" 
                    value="">
                  </div>
                </div>
               
               
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="exampleInputPassword1">Address</label>
                    <textarea class="form-control form-control-user" name="address rmerror" ><?php if(isset($details['address'])){ echo $details['address']; }?></textarea>
                  </div>
                </div>
                <button type="button" id="saveBtn" style="font-size: 1rem;" class="float-right btn btn-primary btn-user" onclick="validate()">Save Details</button>
                
                <br>

                <input type="hidden" id="agent_id" name="agent_id" value="<?php if(isset($details['agent_id'])){ echo $details['agent_id']; }?>">

               
              </form>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
<script>
  function validate(){
    var agent_id = $('#agent_id').val();

    var name = $('#name').val();
    var email = $('#email').val();
    var password = $('#password').val();

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if(name==''){
      $('.rmerror').removeClass('errorborder')
      $('#name').addClass('errorborder');
    }else if(email==''){
      $('.rmerror').removeClass('errorborder')
      $('#email').addClass('errorborder');
    }else if(!email.match(mailformat)){
      $('.rmerror').removeClass('errorborder')
      $('#email').addClass('errorborder');
    }else{
      if(agent_id == ''){
        if(password==''){
          $('.rmerror').removeClass('errorborder')
          $('#password').addClass('errorborder');
        }else{
          $('.rmerror').removeClass('errorborder')
          $("#userForm").submit();
        }
      }else{
        $('.rmerror').removeClass('errorborder')
        $("#userForm").submit();
      }
     
    }
    //applnForm
}
  </script>