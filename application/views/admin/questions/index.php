<!-- Begin Page Content -->

<div class="container-fluid">

  <!-- Page Heading -->
  <ol class="breadcrumb breadcrumb-col-blue">
    <li><a href="<?php echo base_url();?>admin"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
    </li>
    <li class="active"> Questions</li>
  </ol>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Questions List</h6>
    </div>
    <div class="card-body">
      <form name="userForm" id="userForm" method="post" action="<?php echo ADMIN_URL;?>questions">
        <div class="form-group row">
          <div class="col-sm-4 mb-4 mb-sm-0">
            <select name="lesson" id="lesson" style="width: 100%;" class="form-control" tabindex="-1" aria-hidden="true">
              <option selected="selected" value="">Select Lesson</option>
              <?php
              foreach($lessons as $val){ ?>
                <option <?php if(isset($_POST['lesson']) && $_POST['lesson'] == $val['lesson_id']){ ?>selected="selected"<?php }  ?> 
                value="<?php if(isset($val['lesson_id'])){ echo $val['lesson_id']; }?>" ><?php echo $val['title'];?></option>
              <?php 
              }
              ?>
            </select>

            <!-- <input type="text" name="key" class="form-control form-control-user" id="exampleFirstName" placeholder="Search"
              value="<?php if($key != ''){ echo $key;}else{ echo '';}?>"> -->
          </div>
          <div class="col-sm-4 mb-4 mb-sm-0">
            <!-- <button class="btn btn-primary btn-user ">
              Search
            </button> -->
          </div>
          <div class="col-sm-2 mb-2 mb-sm-0 float-right">
            <a class="btn btn-primary btn-user" href="<?php echo base_url();?>admin/questions/add">
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
              <th>Question</th>
              <th>Lesson</th>
              <th>Type</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php 
                  foreach($questions as $key=>$val){ ?>
            <tr>
              <!-- <td>
                <?php echo ++$key;?>
              </td> -->
              <td>
                <?php echo $val['question'];?>
              </td>
              <td>
                <?php echo $val['title'];?>
              </td>
              <td>
                <?php echo $val['answer_type'];?>
              </td>
              
              <td>
                <span class="actions" style="font-size:1.35rem;color:#f55050;padding:5px;">
                  <a href="<?php echo ADMIN_URL;?>questions/add/<?php echo $val['question_id']; ?>" >
                    <i class="fas fa-edit"></i>
                  </a>
                </span>
                
                
                <span onclick="myFunction(<?php echo $val['question_id'];?>)" style="font-size:1.35rem;color:#e6463a;padding:5px;">
                  <i class="fas fa-trash"></i>
                </span>
               
              </td>
            </tr>
            <?php 
                  }
            if(count($questions) == 0){ ?>
              <tr>
              <td colspan=4 >No Questions Found!
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


  $("#lesson").change(function(){
    $("#userForm").submit();
    //alert("The text has been changed.");
  });

  function myFunction(question_id) {
    var x;
    if (confirm("Do you want to delete User?") == true) {
        x = "Do you want to delete User?";
			$.ajax({
				  type: 'POST',
				  url:"<?php echo ADMIN_URL; ?>questions/deleteUser",
				  data: {'question_id':question_id},
				  success: function(resultData) { 
				    window.location.href = "<?php echo ADMIN_URL; ?>questions";
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

