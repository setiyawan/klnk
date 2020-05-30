<body class="">
  <div class="wrapper ">
    
    <?php $this->view('navbar/left_navbar', $active_menu); ?>

    <div class="main-panel">

      <?php $this->view('navbar/top_navbar'); ?>

      <div class="content">
        <div class="container-fluid">
           <!-- SEARCH -->
        <form>
          <input name="q" type="hidden" value="search">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="bmd-label-floating">No. Rekam Medis</label>
                <input name="nomor_rekam_medis" type="text" class="form-control" value="<?= isset($filter['medical_record_number']) ? $filter['medical_record_number'] : ""  ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="bmd-label-floating">Nama</label>
                <input name="nama" type="text" class="form-control" value="<?= isset($filter['patient_name']) ? $filter['patient_name'] : ""  ?>" >
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="bmd-label-floating">No KTP/Identitas</label>
                <input name="nomor_identitas" type="text" class="form-control" value="<?= isset($filter['id_card_number']) ? $filter['id_card_number'] : ""  ?>">
              </div>
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-white btn-round pull-right">
                <i class="material-icons">search</i>
                Cari
              </button>
            </div>
          </div>
        </form>


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-md-6 col-6">
                      <h4 class="card-title ">Data Pasien</h4>
                    </div>
                    <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                    <div class="col-md-6 col-6">
                      <button class="btn btn-add btn-sm pull-right" data-toggle="tooltip" title="Tambah Pasien Baru" onClick="document.location.href='pasien/tambah'">
                        <span _ngcontent-usr-c19="" class="material-icons icon-image-preview">add</span> Tambah
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          No. Rekam Medis
                        </th>
                        <th>
                          Nama
                        </th>
                        <th>
                          Umur
                        </th>
                        <th>
                          No. KTP/Identitas
                        </th>
                        <th>
                          Alamat
                        </th>
                        <th width="180px">
                          Opsi
                        </th>
                      </thead>
                      <tbody>
                        <?php if (empty($patient)) { ?>
                        <tr>
                          <td colspan="5" align="center">
                            Data Tidak ditemukan. Gunakan filter untuk pencarian data.
                          </td>
                        </tr>
                        <?php } ?>

                        <?php foreach($patient as $key) { ?>
                         <tr>
                          <td>
                            <?= $key['medical_record_number'] ?>
                          </td>
                          <td>
                            <?= $key['patient_name'] ?>
                          </td>
                          <td>
                            <?= $this->Converter->birth_date_to_age($key['birth_date']) ?>
                          </td>
                           <td>
                            <?= $key['id_card_number'] ?>
                          </td>
                          <td>
                            <?= $key['address'] ?>
                          </td>
                          <td class="text-primary">
                            <button type="button" class="btn btn-warning" data-toggle="tooltip" title="Edit Data Pasien" onClick="document.location.href='<?= base_url()?>pasien/detail?id=<?= $key['patient_id'] ?>'">
                              <span _ngcontent-jkp-c19="" class="material-icons icon-image-preview">edit</span>
                            </button>
                            <button type="button" class="btn btn-success" data-toggle="tooltip" title="Lihat Rekam Medis Pasien" onClick="document.location.href='<?= base_url()?>rekammedis?q=search&nomor_rekam_medis=<?= $key['medical_record_number'] ?>'">
                              <span _ngcontent-usr-c19="" class="material-icons icon-image-preview">assignment</span>
                            </button>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
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