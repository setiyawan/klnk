<body class="">
  <div class="wrapper ">
    
    <?php $this->view('navbar/left_navbar', $active_menu); ?>
    
    <div class="main-panel">
      
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <h3>Dashboard</h3>
          </div>

          <div class="collapse navbar-collapse justify-content-end">
            <span class="bmd-form-group">
              <div class="input-group no-border">
                <label style="text-align: right; margin-top: 25px; margin-right: 10px;"> <i> Selamat Datang </i><br><strong> <h4> <?= $user_full_name ?> </h4> </strong></label>
              </div>
            </span>
          </div>

          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
        </div>
      </nav>
    <!-- End Navbar -->

      <div class="content" style="margin-top: 70px">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                  <p class="card-category">Jumlah Pasien Terdaftar</p>
                  <h3 class="card-title"> <strong><?= $patient_count ?></strong> </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">link</i>
                    <a href="<?= base_url()?>pasien">Ke Halaman Pasien</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">content_paste</i>
                  </div>
                  <p class="card-category">Jumlah Rekam Medis</p>
                  <h3 class="card-title"><strong><?= $medical_record_count?></strong></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">link</i>
                    <a href="<?= base_url()?>rekammedis">Ke Halaman Rekam Medis</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">local_hospital</i>
                  </div>
                  <p class="card-category">Pasien Terlayani dalam 1 Minggu</p>
                  <h3 class="card-title"><strong><?= $medical_record_count_7_days ?></strong></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> 7 hari terakhir
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->view('navbar/buttom_navbar'); ?>
    </div>
  </div>
</body>