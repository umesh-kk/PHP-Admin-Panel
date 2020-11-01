
 </div>
      <!-- End of Main Content -->

 
 
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Your Website 2019</span>
      </div>
    </div>
  </footer>

      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

 
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url();?>admin/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

</body>



  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url();?>assets/js/sb-admin-2.min.js"></script>

  <!-- <script src="<?php echo base_url();?>assets/vendor/chart.js/Chart.min.js"></script>

  <script src="<?php echo base_url();?>assets/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url();?>assets/js/demo/chart-pie-demo.js"></script> -->

  <!-- Page level plugins -->
  <script src="<?php echo base_url();?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url();?>assets/js/demo/datatables-demo.js"></script>
  <script src="<?php echo base_url();?>assets/js/moment.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap-notify/bootstrap-notify.js"></script>


  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

  <script>
    $(document).ready(function () {
        <?php if($this->session->flashdata('message')!=''){ ?>                
                $.notify({message:'<?php echo $this->session->flashdata('message'); ?>'}, {type: 'success'});
        <?php    $this->session->set_flashdata('message', ''); } ?>
        <?php if($this->session->flashdata('error_message')!=''){ ?>                
                $.notify({message:'<?php echo $this->session->flashdata('error_message'); ?>'}, {type: 'danger'});
        <?php    $this->session->set_flashdata('error_message', '');} ?>
    })
  </script>

</html>
