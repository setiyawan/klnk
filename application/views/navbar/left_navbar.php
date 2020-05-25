<div class="sidebar" data-color="azure" data-background-color="white" data-image="<?php echo base_url() ?>asset/img/sidebar-3.jpg">
  <div class="logo"><a href="<?= base_url() ?>" class="simple-text logo-normal">
      e-Klinik
    </a></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item <?= $active_left_navbar == 'dashboard' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo base_url() ?>dashboard">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item <?= $active_left_navbar == 'patient' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo base_url() ?>pasien">
          <i class="material-icons">person</i>
          <p>Pasien</p>
        </a>
      </li>
      <li class="nav-item <?= $active_left_navbar == 'medical_record' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo base_url() ?>rekammedis">
          <i class="material-icons">content_paste</i>
          <p>Rekam Medis</p>
        </a>
      </li>
      <li class="nav-item <?= $active_left_navbar == 'medicine' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo base_url() ?>obat">
          <i class="material-icons">library_books</i>
          <p>Daftar Obat</p>
        </a>
      </li>
      <li class="nav-item <?= $active_left_navbar == 'change_password' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo base_url() ?>user/ganti_password">
          <i class="material-icons">lock_open</i>
          <p>Ganti Password</p>
        </a>
      </li>
      <li class="nav-item <?= $active_left_navbar == 'logout' ? 'active' : ''?>">
        <a class="nav-link" href="<?php echo base_url() ?>user/logout">
          <i class="material-icons">exit_to_app</i>
          <p>Keluar</p>
        </a>
      </li>
    </ul>
  </div>
</div>