

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div> -->

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User Management</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counts['usercount'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="<?php echo ADMIN_URL;?>users">
                    <span class="pull-xs-left">View Details</span>
                    <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                  </a>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Agent Management</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counts['agentcount'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer card-default">
                    <a href="<?php echo ADMIN_URL;?>agents">
                        <span class="pull-xs-left">View Details</span>
                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </a>
                </div>
              </div>
            </div> -->


            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Lesson Management</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counts['lessoncount'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer card-default">
                    <a href="<?php echo ADMIN_URL;?>lessons">
                        <span class="pull-xs-left">View Details</span>
                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </a>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Videos Management</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counts['videocount'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-video fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer card-default">
                    <a href="<?php echo ADMIN_URL;?>videos">
                        <span class="pull-xs-left">View Details</span>
                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </a>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Music Management</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counts['musiccount'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-music fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer card-default">
                    <a href="<?php echo ADMIN_URL;?>musics">
                        <span class="pull-xs-left">View Details</span>
                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </a>
                </div>
              </div>
            </div>

            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Report Management</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counts['musiccount'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer card-default">
                    <a href="<?php echo ADMIN_URL;?>reports">
                        <span class="pull-xs-left">View Details</span>
                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </a>
                </div>
              </div>
            </div> -->

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Questions Management</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counts['questioncount'];?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer card-default">
                    <a href="<?php echo ADMIN_URL;?>questions">
                      <span class="pull-xs-left">View Details</span>
                      <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                    </a>
                </div>
              </div>
            </div>

           
          </div>

          <!-- Content Row -->

         
        

        </div>
        <!-- /.container-fluid -->

     