<!-- Begin Page Content -->

<div class="container-fluid">

  <!-- Page Heading -->
  <ol class="breadcrumb breadcrumb-col-blue">
    <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
    </li>
    <li class="active"> Reports</li>
  </ol>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Reports List </h6>
    </div>
    <div class="card-body">
      <span><p>Coming Soon</p></span>
    </div>
    <div class="col-offset-1 col-lg-10">
      <div class="input-group">
        <ul class="pagination pull-right" style="margin:0px;">
          <?php 
            // echo $this->pagination->create_links(); ?>
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
      var id = $(this).data('attr');
      var toggleVal = 'Y';
      if($(this).prop('checked')){
        toggleVal = 'Y';
      }else{
        toggleVal = 'N';
      }
      $.ajax({
				  type: 'POST',
				  url:"<?php echo base_url(); ?>admin/reports/changeStatus",
				  data: {'id':id,'status':toggleVal},
				  success: function(resultData) { 
				    //window.location.href = "<?php echo base_url(); ?>admin/reports";
					  //$("#myModals").html(resultData);
				  }
			});
    });
    // $('.toggle-demo').change(function(this) {
    //   alert('Toggle: ' )
    // })
  })

  function myFunction(id) {
    var x;
    if (confirm("Are you sure you want to delete this music?") == true) {
        x = "Are you sure you want to delete this music?";
			$.ajax({
				  type: 'POST',
				  url:"<?php echo base_url(); ?>admin/reports/deleteUser",
				  data: {'id':id},
				  success: function(resultData) { 
				    window.location.href = "<?php echo base_url(); ?>admin/reports";
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

