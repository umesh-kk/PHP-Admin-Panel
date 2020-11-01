<!-- Begin Page Content -->

<div class="container-fluid">

  <!-- Page Heading -->
  <ol class="breadcrumb breadcrumb-col-blue">
    <li><a href="<?php echo base_url();?>admin"><i class="fas fa-fw fa-table"></i> Home</a> <i class="fas fa-chevron-right"></i>&nbsp;
    </li>
    <li><a href="<?php echo base_url();?>admin/users"> Users</a> <i class="fas fa-chevron-right"></i>&nbsp;
        <li> Usage Time </li>
    </ol>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Usage Time</h6>
    </div>
    <div class="card-body"> 
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
          <thead>
            <tr>
              <!-- <th>No</th> -->
              <th>Name</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Time</th>
            </tr>
          </thead>

          <tbody>
            <?php 
                  foreach($logs as $log){ ?>
            <tr>
              <!-- <td>
                <?php echo ++$key;?>
              </td> -->
              <td>
                <?php echo $log['name'];?>
              </td>
              <td>
                <?php echo $log['start_time'];?>
              </td>
              <td>
                <?php echo $log['end_time'];?>
              </td>
              <td>
              <?php echo $log['total'];?>
              </td>
            </tr>
            <?php 
                  }
            if(count($logs) == 0){ ?>
              <tr>
              <td class="text-center" colspan= 4>No Details!
              </td>
              </tr>
              <?php 
              }
            ?>


          </tbody>
        </table>
      </div>
    </div>
    


  </div>

</div>
<!-- /.container-fluid -->


