
<body class="">
  <div class="wrapper ">
    <div class="row justify-content-md-center col align-self-center">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title" style="text-align: center;">User Login</h4>
                  <!-- <p class="card-category">Complete your profile</p> -->
                </div>
                <div class="card-body">
                  <form action="<?= base_url()?>user/do_login" method="post">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Username</label>
                          <input type="text" required name="username" class="form-control" >
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Password</label>
                          <input type="password" required name="password" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Login</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url() ?>asset/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>asset/js/core/popper.min.js"></script>
  <script src="<?php echo base_url() ?>asset/js/core/bootstrap-material-design.min.js"></script>
  <script src="<?php echo base_url() ?>asset/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?php echo base_url() ?>asset/js/plugins/bootstrap-notify.js"></script>
  <script src="<?php echo base_url() ?>asset/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script> 
  <script type="text/javascript">
    <?php 
      $alert = $this->session->flashdata('alert');
      if (!empty($alert)) { 
    ?>
      md.showNotificationModification('top','center', '<?= $alert['type'] ?>' , '<?= $alert['error_message'] ?>');
    <?php } ?>
  </script>
</body>

</html>