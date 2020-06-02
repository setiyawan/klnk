<body class="">
  <div class="wrapper ">
    
    <?php $this->view('navbar/left_navbar', $active_menu); ?>

    <?php
      $blood_group = "-";
      if (isset($patient[0]) && $patient[0]['blood_group'] != "") {
        $blood_group = $patient[0]['blood_group'];
      }

      $gender = "";
      if (isset($patient[0]) && $patient[0]['gender'] != "") {
        $gender = $patient[0]['gender'];
      }

      $medical_record_number = "";
      if (isset($patient[0]) && $patient[0]['medical_record_number'] != "") {
        $medical_record_number = $patient[0]['medical_record_number'];
      }
    ?>

    <div class="main-panel">

      <?php $this->view('navbar/top_navbar'); ?>
      
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-md-6 col-6">
                      <h4 class="card-title "><?= $table_label ?></h4>
                    </div>
                    <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                    <?php if ($action == "update") {?>
                    <div class="col-md-6 col-6">
                      <button class="btn btn-success btn-sm pull-right" data-toggle="tooltip" title="Lihat Rekam Medis Pasien" onClick="document.location.href='<?=base_url()?>rekammedis?q=search&nomor_rekam_medis=<?= $medical_record_number ?>'">
                        <span _ngcontent-usr-c19="" class="material-icons icon-image-preview">assignment</span>
                      </button>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="card-body">
                  <form action="<?= $action ?>" method="post">
                    <input type="hidden" name="patient_id" value="<?= isset($patient[0]) ? $patient[0]['patient_id'] : '' ?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Nama</label>
                          <input name="patient_name" required type="text" class="form-control" value="<?= isset($patient[0]) ? $patient[0]['patient_name'] : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Tanggal Lahir</label>
                          <input name="birth_date" required type="date" class="form-control" value="<?= isset($patient[0]) ? $patient[0]['birth_date'] : '' ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row" style="padding-top: 20px;">  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">No KTP/Identitas</label>
                          <input name="id_card_number" class="form-control" value="<?= isset($patient[0]) ? $patient[0]['id_card_number'] : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-static">Jenis Kelamin</label>
                          <select name="gender" class="form-control" data-style="btn btn-link">
                            <?php foreach ($constant_gender as $key => $value) { ?>
                            <option value="<?=$key?>" <?= $key == $gender ? 'selected' : '' ?> > <?= $value ?> </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="padding-top: 20px;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Pekerjaan</label>
                          <input name="job" type="text" class="form-control" value="<?= isset($patient[0]) ? $patient[0]['job'] : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group bmd-form-group">
                          <label class="bmd-label-static">Golongan Darah</label>
                          <select name="blood_group" class="form-control" data-style="btn btn-link">
                            <?php foreach ($constant_blood_group as $key => $value) { ?>
                            <option value="<?=$key?>" <?= $key == $blood_group ? 'selected' : '' ?> > <?= $value ?> </option>
                            <?php } ?>
                          </select>
                        </div>                       
                      </div>
                    </div>

                    <div class="row" style="padding-top: 20px;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Alamat</label>
                          <div class="form-group">
                            <textarea name="address" required class="form-control" rows="5"><?= isset($patient[0]) ? $patient[0]['address'] : '' ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    <div class="clearfix"></div>
                  </form>
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