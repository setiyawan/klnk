<body class="">
  <div class="wrapper ">

    <?php $this->view('navbar/left_navbar', $active_menu); ?>
    
    <div class="main-panel">
      
      <?php $this->view('navbar/top_navbar'); ?>
      
      <div class="content">
        <div class="container-fluid">
           <!-- SEARCH -->
        <form onsubmit="return verify_search()">
          <input type="hidden" name="q" value="search">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="bmd-label-floating">No. Rekam Medis</label>
                <input type="text" id="nomor_rekam_medis" name="nomor_rekam_medis" class="form-control" value="<?= isset($filter['medical_record_number']) ? $filter['medical_record_number'] : ""  ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="bmd-label-floating">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?= isset($filter['patient_name']) ? $filter['patient_name'] : ""  ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="bmd-label-floating">Tgl kunjungan</label>
                <input class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?= isset($filter['visit_date']) ? $filter['visit_date'] : ""  ?>" />
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
                      <h4 class="card-title ">Data Rekam Medis</h4>
                    </div>
                    <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                    <div class="col-md-6 col-6">
                      <?php 
                        if (!empty($medical_record) > 0) { 
                          $default_patient_id = $medical_record[0]['patient_id'];
                        }

                        if ($default_patient_id != "") {
                      ?>
                      <button class="btn btn-add btn-sm pull-right" data-toggle="tooltip" title="Tambah Rekam Medis Pasien" onClick="document.location.href='<?=base_url()?>rekammedis/tambah?idpasien=<?= $default_patient_id ?>'">
                        <span _ngcontent-usr-c19="" class="material-icons icon-image-preview">add</span> Tambah
                      </button>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Tgl Kunjungan
                        </th>
                        <th>
                          Nama
                        </th>
                        <th>
                          Gejala
                        </th>
                        <th>
                          Diagnosa
                        </th>
                        <th>
                          Terapi
                        </th>
                        <th width="90px">
                          Opsi
                        </th>
                      </thead>
                      <tbody>
                        <?php if (empty($medical_record)) { ?>
                        <tr>
                          <td colspan="6" align="center">
                            <?php if ($default_patient_id != "") { ?>
                              Pasien tersebut belum mempunyai rekam medis.
                            <?php } else { ?>
                              Data rekam medis tidak ditemukan. Gunakan filter untuk pencarian data.
                            <?php } ?>
                          </td>
                        </tr>
                        <?php } ?>

                        <?php foreach($medical_record as $key) { ?>
                         <tr>
                          <td>
                            <?= $this->Converter->to_indonesia_timestamp($key['visit_date_time']) ?>
                          </td>
                          <td>
                            <?= $key['medical_record_number'] . ' - ' .$key['patient_name'] ?>
                          </td>
                          <td>
                            <?= $key['symptom'] ?>
                          </td>
                          <td>
                            <?= $key['diagnosis'] ?>
                          </td>
                          <td>
                            <?= $key['therapy'] ?>
                          </td>
                          <td class="text-primary">
                            <button type="button" data-toggle="tooltip" title="Edit Rekam Medis Pasien" class="btn btn-warning" onClick="document.location.href='<?= base_url() ?>rekammedis/detail?id=<?= $key['medical_record_id'] ?>'">
                              <span _ngcontent-jkp-c19="" class="material-icons icon-image-preview">edit</span>
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
      <script>
        function verify_search() {
          if ($('#nomor_rekam_medis')[0].value  == '' && $('#nama')[0].value == '' && $('#tgl_kunjungan')[0].value == '') {
            alert('Gunakan Minimal 1 Filter Untuk Pencarian Data Rekam Medis' + $('#tgl_kunjungan')[0].value);
            $($('#nomor_rekam_medis')).focus();

            return false;
          }

          return true;
        }
      </script>
      <?php $this->view('navbar/buttom_navbar'); ?>
    </div>
  </div>
</body>