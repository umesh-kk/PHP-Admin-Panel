<!-- Begin Page Content -->

<div class="container-fluid">

  <!-- Page Heading -->
  <ol class="breadcrumb breadcrumb-col-blue">
    <li><a href="<?php echo base_url();?>admin"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
    </li>
    <li class="active"> Users</li>
  </ol>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
    </div>
    <div class="card-body">
      <form name="userMasterForm" id="userMasterForm" method="post" action="<?php echo ADMIN_URL;?>users">
        <div class="form-group row">
          <div class="col-sm-4 mb-4 mb-sm-0">
            <input type="text" name="key" class="form-control form-control-user" id="exampleFirstName" placeholder="Search"
              value="<?php if($key != ''){ echo $key;}else{ echo '';}?>">
          </div>
          <div class="col-sm-4 mb-4 mb-sm-0">
            <button class="btn btn-primary btn-user ">
              Search
            </button>
          </div>
          <div class="col-sm-2 mb-2 mb-sm-0 float-right">
            <a class="btn btn-primary btn-user" href="<?php echo base_url();?>admin/users/add">
              ADD
            </a>
          </div>
          <!-- <div class="col-sm-3">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                  </div> -->
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
          <thead>
            <tr>
              <!-- <th>No</th> -->
              <th>Name</th>
              <th>Email</th>
              <th>Address</th>
              <th>Usage Time</th>
              <th>View</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php 
                  foreach($users as $key=>$val){ ?>
            <tr>
              <!-- <td>
                <?php echo ++$key;?>
              </td> -->
              <td>
                <?php echo $val['first_name'].' '.$val['last_name'];?>
              </td>
              <td>
                <?php echo $val['email'];?>
              </td>
              <td>
                <?php echo $val['address'];?>
              </td>
              <td>
                <div class="row">
                    <div class="col-md-8"><?php echo $val['total'];?></div>
                  
                  </div>  
                  </td>
                <td>
              <div class="row">
                  <div class="col-md-4"> 
                  <span class="actions" style="font-size:1.35rem;color:#f55050;padding:5px;">
                    <a href="<?php echo ADMIN_URL;?>users/logs/<?php echo $val['user_id']; ?>" >
                      <i class="fas fa-eye"></i>
                    </a>
                  </span>
                  </div>
                </div>  
              </td>
             
              <td>
                <span class="actions" style="font-size:1.35rem;color:#f55050;padding:5px;">
                  <a href="<?php echo ADMIN_URL;?>users/add/<?php echo $val['user_id']; ?>" >
                    <i class="fas fa-edit"></i>
                  </a>
                </span>
                
                <span style="font-size:1.35rem;padding:5px;">
                  <input type="checkbox" class="toggle-demo" data-on="Block" data-off="Unblock"  data-onstyle="danger" data-offstyle="primary"  <?php if($val['active']=='Y'){ ?> checked <?php }  ?>  data-toggle="toggle" data-size="small"  data-style="ios" data-attr="<?php echo $val['user_id']; ?>">
                </span>
                <span onclick="myFunction(<?php echo $val['user_id'];?>)" style="font-size:1.35rem;color:#e6463a;padding:5px;">
                  <i class="fas fa-trash"></i>
                </span>
               
              </td>
            </tr>
            <?php 
                  }
            if(count($users) == 0){ ?>
              <tr>
              <td colspan=4 >No Users Found!
              </td>
              </tr>
              <?php 
              }
            ?>


          </tbody>
        </table>
      </div>
    </div>
    <div class="col-offset-1 col-lg-10">
      <div class="input-group">
        <ul class="pagination pull-right" style="margin:0px;">
          <?php 
             echo $this->pagination->create_links(); ?>
        </ul>
      </div>
    </div>


  </div>

</div>
<!-- /.container-fluid -->

<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>
<script>
  $(function() {
    $('.toggle-demo').bootstrapToggle().change(function() {
      var user_id = $(this).data('attr');
      var toggleVal = 'Y';
      if($(this).prop('checked')){
        toggleVal = 'Y';
      }else{
        toggleVal = 'N';
      }
      $.ajax({
				  type: 'POST',
				  url:"<?php echo ADMIN_URL; ?>users/changeStatus",
				  data: {'user_id':user_id,'status':toggleVal},
				  success: function(resultData) { 
				    //window.location.href = "<?php echo base_url(); ?>admin/users";
					  //$("#myModals").html(resultData);
				  }
			});
    });
    // $('.toggle-demo').change(function(this) {
    //   alert('Toggle: ' )
    // })
  })

  function myFunction(user_id) {
    var x;
    if (confirm("Do you want to delete User?") == true) {
        x = "Do you want to delete User?";
			$.ajax({
				  type: 'POST',
				  url:"<?php echo ADMIN_URL; ?>users/deleteUser",
				  data: {'user_id':user_id},
				  success: function(resultData) { 
				    window.location.href = "<?php echo ADMIN_URL; ?>users";
					//$("#myModals").html(resultData);
				  }
			});
    } else {
        x = "You pressed Cancel!";
    }
	//alert(parent_id);
    //document.getElementById("demo").innerHTML = x;
}
</script>

